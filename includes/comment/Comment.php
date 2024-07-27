<?php

namespace PixxelTheme\includes\comment;


if (!defined('ABSPATH')) {
    exit;
}
class Comment
{
    protected $query;
    public $type;

    function __construct($type='blog')
    {
        $this->type=$type;
        add_action('wp_insert_comment', [$this, 'addRoleForAdminCommentReplay'], 10, 2);
    }

    public function setQuery($query)
    {
        $this->query = $query;
        $this->ajaxActions();
    }

    public function ajaxActions()
    {
        if ($this->query == 'add-comment') {
            $data =  sanitizeNestedObject(json_decode(stripslashes($_POST['data'])));
            $datetime  = current_time('Y-m-d\ H:i:s');

            $approved  = 0;
            $parentId = intval($data['parentId']);
            if (is_user_logged_in()) {
                $user = get_user_by('id', get_current_user_id());
                $user_id = get_current_user_id();
                $approved  = 1;
                $comment_args = [
                    'comment_post_ID' => sanitize_text_field($data["postId"]),
                    'comment_author' => $user->display_name,
                    'comment_author_email' => $user->user_email,
                    'comment_author_IP' => getUserIp(),
                    'comment_date' => $datetime,
                    'comment_content' => sanitize_textarea_field($data['content']),
                    'comment_approved' => $approved,
                    'comment_parent' => $parentId,
                    'user_id' => get_current_user_id(),
                    'comment_meta' => [
                        'pixxel_user_id' => get_current_user_id(),
                        'pixxel_type' => 'admin',
                        'pixxel_title' => $parentId ? '' : $data['title'],
                        'pixxel_rate' => $parentId ? '' : $data['rate'],
                        'pixxel_images' => $parentId ? '' : $data['images'],
                        'pixxel_anonyms' => intval($data['anonyms']),
                    ]
                ];
            } else {
                $user_id = session_id();
                $comment_args = [
                    'comment_post_ID' => sanitize_text_field($data['postId']),
                    'comment_author' => sanitize_text_field($data['name']),
                    'comment_author_email' =>  sanitize_text_field($data['email']),
                    'comment_author_IP' => getUserIp(),
                    'comment_date' => $datetime,
                    'comment_content' => sanitize_textarea_field($data['content']),
                    'comment_approved' => $approved,
                    'comment_parent' => intval($data['parentId']),
                    'comment_meta' => [
                        'pixxel_user_id' => $user_id,
                        'pixxel_type' => 'user',
                        'pixxel_title' => $parentId ? '' : $data['title'],
                        'pixxel_rate' => $parentId ? '' : $data['rate'],
                        'pixxel_images' => $parentId ? '' : $data['images'],
                        'pixxel_anonyms' => intval($data['anonyms']),
                    ]
                ];
            }

            $is_first_level = false;
            if (intval($data['parentId']) == 0) {
                $is_first_level = true;
            }
            $comment_id = wp_insert_comment($comment_args);
            $load_comment_id = $is_first_level ? $comment_id : intval($data['firstLevelId']);
            $comment_objs = get_comments(['comment__in' => [$load_comment_id]]);

            // $directory = pixxel_get_domain_directory();
            // $url = get_permalink(sanitize_text_field($data->postId));
            // pixxel_remove_custom_dir_cash('/cache/wp-rocket/'.$directory.'/forum/question/'.utf8_encode($question_obj->slug),$url);

            $comment_content = $this->generateCommentItem($comment_objs[0], 0, $user_id, 0);


            ajaxResponse(true, 'دیدگاه با موفقیت ثبت گردید', [
                'commentId' => $comment_id,
                'isFirstLevel' => $is_first_level,
                'commentHtml' => $comment_content,
            ]);
        } elseif ($this->query == 'upload-images') {
            if (!empty($_FILES['image-0'])) {
                require ABSPATH . 'wp-admin/includes/image.php';


                foreach ($_FILES as $key => $file) {
                    $name = $file['name']; //get the name of the file
                    $size = $file['size']; //get the size of the file

                    $file_name = $file['name'];
                    $file_temp = $file['tmp_name'];

                    $upload_dir = wp_upload_dir();
                    $file_data = file_get_contents($file_temp);
                    $filename = basename($file_name);
                    $filetype = wp_check_filetype($file_name);
                    $filename = $name . '-' . time() . '.' . $filetype['ext'];

                    if (!in_array($filetype['ext'], ['jpg', 'png', 'gif', 'jpeg'])) {
                        ajaxResponse(false, 'فرمت فایل انتخاب شده شامل موارد مجاز نمی باشد', $filetype['ext']);
                    }
                    if (wp_mkdir_p($upload_dir['path'])) {
                        $final_file = $upload_dir['path'] . '/' . $filename;
                    } else {
                        $final_file = $upload_dir['basedir'] . '/' . $filename;
                    }

                    file_put_contents($final_file, $file_data);
                    $wp_filetype = wp_check_filetype($filename, null);
                    $attachment = array(
                        'post_mime_type' => $wp_filetype['type'],
                        'post_title' => sanitize_file_name($filename),
                        'post_content' => '',
                        'post_status' => 'inherit'
                    );

                    $attach_id = wp_insert_attachment($attachment, $final_file);
                    $ids[] = $attach_id;

                    $file_attach_data = wp_generate_attachment_metadata($attach_id, $final_file);
                    wp_update_attachment_metadata($attach_id, $file_attach_data);
                    $uploadedImages[] =  $this->getUploadImages($attach_id);
                }
                ajaxResponse(true, 'تصاویر با موفقیت بارگذاری شد', ['image' => $uploadedImages, 'id' => $ids]);
            }
        }
    }




    protected function addRoleForAdminCommentReplay($comment_id, $comment_object)
    {
        // Check if the comment was added by an admin
        if (is_user_logged_in()) {
            $comment_data = [
                'comment_ID' => $comment_id,
                'comment_meta' => [
                    'pixxel_user_id' => get_current_user_id(),
                    'pixxel_type' => 'admin',
                ],
            ];
        }
        wp_update_comment($comment_data);
    }


    public  function commentChildren($comment_id)
    {
        global $wpdb;
        $comment_query = "
        SELECT * FROM {$wpdb->prefix}comments c
        WHERE
        c.comment_parent = {$comment_id}
        ORDER BY c.comment_date
        ";
        $comment_result = $wpdb->get_results($comment_query);
        return $comment_result;
    }

    public  function commentRateAverage($postId)
    {
        global $wpdb;
        $average_query = "  
        SELECT AVG(CAST(cm.meta_value AS UNSIGNED)) as average_rate, COUNT(cm.comment_id) as comment_count   
        FROM {$wpdb->prefix}comments c  
        INNER JOIN {$wpdb->prefix}commentmeta cm  
            ON c.comment_ID = cm.comment_id  
        WHERE  
            c.comment_post_ID = %d  
            AND cm.meta_key = 'pixxel_rate'  
            AND cm.meta_value > 0  
    ";

        $result = $wpdb->get_row($wpdb->prepare($average_query, $postId));
        return [
            'averageRate' => $result->average_rate ? round($result->average_rate, 2) : 0, // Return 0 if there are no ratings  
            'commentCount' => $result->comment_count ? intval($result->comment_count) : 0 // Ensure count is an integer  
        ];
    }

    function generateCommentItem($comment, $i = 0, $user_id, $level)
    {
        ob_start();
        get_template_part('includes/comment/comment', 'item', ['_this' => $this, 'comment' => $comment, 'i' => $i, 'user_id' => $user_id, 'level' => $level]);
        return ob_get_clean();
    }

    public function generateCustomComment($post_id)
    {
        ob_start();
        get_template_part('includes/comment/comment', 'custom-comment', ['_this' => $this, 'post_id' => $post_id]);
        return ob_get_clean();
    }


    public  function getUploadImages($imageId)
    {
        ob_start();
        get_template_part('includes/comment/comment', 'upload-images', ['_this' => $this, 'imageId' => $imageId]);
        return  ob_get_clean();
    }
}
