<?php
namespace PixxelTheme\includes\comment;


if (!defined('ABSPATH')) {
    exit;
}
class Comment
{
    protected $query;

    function __construct()
    {
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
            $data = json_decode(stripslashes($_POST['data']));

            $datetime  = current_time('Y-m-d\ H:i:s');

            $approved  = 0;
            if (is_user_logged_in()) {
                $user = get_user_by('id', get_current_user_id());
                $user_id = get_current_user_id();
                $approved  = 1;
                $comment_args = [
                    'comment_post_ID' => sanitize_text_field($data->postId),
                    'comment_author' => $user->display_name,
                    'comment_author_email' => $user->user_email,
                    'comment_author_IP' => getUserIp(),
                    'comment_date' => $datetime,
                    'comment_content' => sanitize_textarea_field($data->content),
                    'comment_approved' => $approved,
                    'comment_parent' => intval($data->parentId),
                    'user_id' => get_current_user_id(),
                    'comment_meta' => [
                        'labell_user_id' => get_current_user_id(),
                        'labell_type' => 'admin',
                    ]
                ];
            } else {
                $user_id = session_id();
                $comment_args = [
                    'comment_post_ID' => sanitize_text_field($data->postId),
                    'comment_author' => sanitize_text_field($data->name),
                    'comment_author_IP' => getUserIp(),
                    'comment_date' => $datetime,
                    'comment_content' => sanitize_textarea_field($data->content),
                    'comment_approved' => $approved,
                    'comment_parent' => intval($data->parentId),
                    'comment_meta' => [
                        'labell_user_id' => $user_id,
                        'labell_mobile' => sanitize_text_field($data->mobile),
                        'labell_type' => 'anonymous',
                    ]
                ];
            }

            $is_first_level = false;
            if (intval($data->parentId) == 0) {
                $is_first_level = true;
            }
            $comment_id = wp_insert_comment($comment_args);
            $load_comment_id = $is_first_level ? $comment_id : intval($data->firstLevelId);
            $comment_objs = get_comments(['comment__in' => [$load_comment_id]]);

            // $directory = labell_get_domain_directory();
            // $url = get_permalink(sanitize_text_field($data->postId));
            // labell_remove_custom_dir_cash('/cache/wp-rocket/'.$directory.'/forum/question/'.utf8_encode($question_obj->slug),$url);

            ob_start();
            $this->generateCommentItem($comment_objs[0], 0, $approved, $user_id, 0);
            $comment_content = ob_get_clean();


            ajaxResponse(true, 'دیدگاه با موفقیت ثبت گردید', [
                'commentId' => $comment_id,
                'isFirstLevel' => $is_first_level,
                'commentHtml' => $comment_content,
            ]);
        }
    }

    public function generateCustomComment($post_id)
    {
        $is_login = 0;
        $user_id = session_id();
        if (is_user_logged_in()) {
            $is_login = 1;
            $user_id = get_current_user_id();
        }
        // enqueue js file
        wp_enqueue_script('labell-comment', PIXXEL_URL . '/assets/js/comment.js', ['jquery'], PIXXEL_VERSION, true);
        wp_localize_script('labell-comment', 'commentData', ['isLogin' => $is_login, 'postId' => $post_id]);

        $comment_list = get_comments(['post_id' => $post_id, 'status' => 'approve', 'parent__in' => [0]]);
?>
        <div class="flex flex-col justify-between">
            <div class="flex justify-between">
                <h3 class="text-xl md:text-2xl font-bold flex items-baseline  gap-2 mb-4">
                    <i class="pixxelicon-shape text-base text-magenta"></i>
                    شما هم نظر خود را برای ما بنویسید
                </h3>
                <button class="flex items-center h-fit gap-2 md:hidden text-sm-bold text-magenta labell-add-comment shrink-0">
                    <i class="text-base pixxelicon-add"></i>
                    افزودن نظر
                </button>
            </div>
            <div class="flex flex-col gap-4 mt-2 labell-comment-container md:mt-6">
                <?php if (is_array($comment_list)) foreach ($comment_list as $i => $comment) : ?>
                    <?php echo $this->generateCommentItem($comment, $i, 1, $user_id, 0); ?>
                <?php endforeach ?>
            </div>
            <form class="labell-comment-popup p-6 md:p-0 bg-white md:bg-transparent  fixed md:relative left-0 z-[60] -bottom-[130%] md:bottom-auto md:left-auto  duration-500 transition-all md: flex flex-col w-full labell-comment-form md:mt-0">
                <i class="p-3 text-lg text-black pixxelicon-cross md:hidden"></i>
                <div class="flex flex-col md:flex-row mt-7 gap-5">
                    <?php if (!$is_login) : ?>
                        <div class="flex flex-col gap-5 mb-5 md:flex-row w-full">
                            <div class="md:flex-1 flex flex-col gap-1">
                                <label for="labell-comment-name" class="text-medium text-xs md:text-sm">نام و نام خانوادگی</label>
                                <input type="text" name="labell-comment-name" id="labell-comment-name" class="h-12 px-4 bg-white border outline-none border-neutrals-300 " placeholder="نام و نام خانوادگی خود را وارد کنید">
                            </div>
                            <div class="md:flex-1 flex flex-col gap-1">
                                <label for="labell-comment-mobile" class="text-medium text-xs md:text-sm">شماره موبایل</label>
                                <input type="text" name="labell-comment-mobile" id="labell-comment-mobile" class=" h-12 px-4 bg-white border outline-none border-neutrals-300 " placeholder="شماره موبایل خود را وارد کنید">
                            </div>
                        </div>
                    <?php endif ?>
                    <div class=" flex flex-col w-full">
                        <div class="flex flex-col gap-1">
                            <label for="labell-comment-content" class="text-medium text-xs md:text-sm">پیام</label>
                            <textarea name="labell-comment-content" id="labell-comment-content" class="w-full p-4 outline-none resize-none h-52 md:h-40 border border-mid-50  " placeholder="پیام خود را بنویسید"></textarea>
                        </div>
                        <button type="submit" class="h-10 font-bold text-lg border w-full md:w-fit md:mr-auto  text-white bg-magenta px-4 flex justify-center items-center gap-2 mt-8">
                            ارسال پیام
                            <svg class="hidden w-6 h-6 animate-spin fill-magenta">
                                <use href="#loading-spinner"></use>
                            </svg>
                        </button>
                    </div>

                </div>
                <div class="comment-response-box">
                    <div class="hidden w-full px-4 py-1 border success-message text-sm-bold md:text-md-bold border-green-400 bg-green-100 text-green-800  mt-5"></div>
                    <div class="hidden w-full px-4 py-1 border error-message text-sm-bold md:text-md-bold border-green-400 bg-red-100 text-red-800  mt-5"></div>
                </div>
            </form>

            <button class="comment-show-more w-full md:w-fit h-12 border border-magenta px-16 text-magenta text-sm-bold <?php echo count($comment_list) > 3 ? 'flex' : 'hidden' ?> items-center justify-center gap-3 mx-auto mt-4" page="2" allPage="<?php echo  ceil(count($comment_list) / 3);  ?>">
                مشاهده نظرات بیشتر
                <i class="pixxelicon-arrow-bottom text-lg"></i>
            </button>
        </div>
        <div class="reply-container hidden">
            <div class="comment-reply-field hidden md:flex flex-col mt-4">
                <?php if (!$is_login) : ?>
                    <div class="flex flex-col gap-5 md:flex-row">
                        <input type="text" name="labell-comment-name" id="labell-reply-comment-name" class="md:flex-1  h-12 px-4 bg-white border outline-none border-neutrals-300 " placeholder="نام و نام خانوادگی">
                        <input type="text" name="labell-comment-mobile" id="labell-reply-comment-mobile" class="phone-number md:flex-1 h-12 px-4 bg-white border outline-none border-neutrals-300 " placeholder="شماره موبایل" inputmode="numeric">
                    </div>
                <?php endif ?>
                <div class="textarea-container flex w-full gap-0 items-end justify-center  mt-6 absolute md:relative transition-all">
                    <i class="pixxelicon-mouse-arrow submit-comment opacity-50 text-2xl text-neutrals-600 absolute left-3  bottom-3"></i>
                    <span class="w-full caption comment-textarea min-h-14 border border-neutrals-300 outline-none  focus:border-primary-400   text-neutrals-600 pr-4 pl-16 py-3 no-scrollbar resize-y bg-white" placeholder="پاسخ شما به این دیدگاه چیست؟" name="add-new-comment" role="textbox" parentId="" contenteditable></span>
                    <svg role="status" class="w-6 h-6 hidden  text-white animate-spin absolute left-3 fill-magenta bottom-3" id="comment-spin">
                        <use href="#loading-spinner"></use>
                    </svg>
                    <div class="textarea-placeholder text-sm-semibold absolute top-3 right-4 text-neutrals-500">پاسخ شما به این پیام چیست؟</div>
                </div>
            </div>
        </div>
        <div class="fixed top-0 bottom-0 left-0 right-0 z-50 visible hidden transition-all cursor-pointer labell-comment-popup-overlay bg-black/40"></div>

        <!-- reply comment in mobile -->
        <div class="reply-comment-modal-overlay hidden bg-black/40 fixed top-0 right-0 left-0 bottom-0 z-50 transition-all visible cursor-pointer px-6 pt-6 pb-4"></div>
        <div class="reply-comment-modal fixed -bottom-full right-0 flex-col justify-start items-start text-neutrals-900 md:text-neutrals-700  shadow-search bg-white transition-all px-6 pt-6 pb-4 duration-700 w-full z-[60]">
            <i class="pixxelicon-cross text-sm font-medium text-neutrals-900 cursor-pointer p-3"></i>
            <?php if (!$is_login) : ?>
                <div class="flex flex-col gap-5 md:flex-row mt-6">
                    <input type="text" name="labell-comment-name" id="labell-reply-comment-name-mobile" class="md:flex-1  h-12 px-4 bg-white border outline-none border-neutrals-300 " placeholder="نام و نام خانوادگی">
                    <input type="number" name="labell-comment-mobile" id="labell-reply-comment-mobile-mobile" class="phone-number md:flex-1 h-12 px-4 bg-white border outline-none border-neutrals-300 " placeholder="شماره موبایل">
                </div>
            <?php endif ?>
            <h4 class="headline4 pt-6 pb-4">پاسخ</h4>
            <textarea name="mobile-comment-textarea" class="comment-textarea body-font1 w-full h-full max-h-[180px] border border-neutrals-200 p-4 text-neutrals-600 resize-none overflow-y-auto outline-none focus:border-magenta text-justify" id="mobile-comment-textarea" cols="30" rows="10" parentId="" firstLevel="" placeholder="پاسخ شما به این پیام چیست؟" <?php echo is_user_logged_in() ? '' : 'maxlength="600"' ?>></textarea>
            <div class="submit-comment opacity-50 button-font bg-magenta w-full py-4 mt-6 flex justify-center items-center text-white">ثبت دیدگاه</div>
        </div>
    <?php
    }


    protected function addRoleForAdminCommentReplay($comment_id, $comment_object)
    {
        // Check if the comment was added by an admin
        if (is_user_logged_in()) {
            $comment_data = [
                'comment_ID' => $comment_id,
                'comment_meta' => [
                    'labell_user_id' => get_current_user_id(),
                    'labell_type' => 'admin',
                ],
            ];
        }
        wp_update_comment($comment_data);
    }

    function generateCommentItem($comment, $i = 0, $approve = 1, $user_id, $level)
    {
        $level++;
        $comment_type = get_comment_meta($comment->comment_ID, 'labell_type', true);
        $children_list = $this->commentChildren($comment->comment_ID);
        $has_children = !empty($children_list);

        global $global_first_level_comment_count;

        if ($level == 1) {
            $global_first_level_comment_count++;
        }

        // padding of content from right
        if ($has_children) {
            $comment_content_css = 'pr-2';
        } elseif ($level > 1 && !$has_children) {
            $comment_content_css = 'pr-3';
        } else {
            $comment_content_css = '';
        }
        // title border color
        if ($comment_type == 'admin') {
            $borderColor = 'border-magenta text-magenta';
        } else {
            $borderColor = 'border-mid-500';
        }

        // comment items css
        if ($level > 1) {
            $comment_css = 'px-2 md:px-4 py-2 ';
        }
        if ($comment_type == 'admin') {
            $comment_css .= " bg-purple-bg";
        } else {
            $comment_css .= " bg-white";
        }
        // nested padding 
        $nested_class = ' pr-3 md:pr-5 ';

    ?>

        <div class="comment-item   flex-col  <?php echo $comment_css ?>  mt-4 md:mt-7 relative  transition-all level-<?php echo $level ?>" commentId="<?php esc_attr_e($comment->comment_ID) ?>" parentId="<?php esc_attr_e($comment->comment_parent) ?>" id="comment-<?php esc_attr_e($comment->comment_ID) ?>">

            <h2 class="comment-author text-sm md:text-base flex items-center gap-2 h-6 border-r-2 pr-2 font-bold <?= $borderColor ?>">
                <?php if ($comment_type == 'admin') : ?>
                    <div class="">
                        تیم پشتیبانی لابل
                    </div>
                <?php else : ?>
                    <div class="">
                        <?php esc_attr_e($comment->comment_author); ?>
                    </div>
                    <i class="pixxelicon-shape text-main-gray text-[0.5rem]"></i>
                    <span class="text-main-gray">مشتری</span>
                <?php endif ?>
            </h2>
            <div class="pt-3 <?php echo ($has_children && $level < 6)  ? $nested_class : '' ?>">
                <div class="comment-content  leading-8 break-words   <?php echo  $comment_content_css ?>">
                    <?php echo $comment->comment_content  ?>
                    <?php if (!$approve) : ?>
                        <p class="  italic">(دیدگاه شما در انتظار تایید می باشد)</p>
                    <?php endif ?>
                    <div class="flex gap-3 justify-end items-center text-neutrals-500 mt-2">
                        <div class="cursor-pointer text-xs text-bold add-reply flex items-center gap-2">
                            پاسخ دهید
                            <i class="pixxelicon-redo text-xl"></i>
                        </div>
                        <div class="flex items-center gap-4 mr-auto text-neutrals-500 text-xs-semibold">
                        </div>
                    </div>
                </div>

                <?php if ($has_children) : ?>
                    <?php
                    foreach ($children_list as $child_obj) {
                        $this->generateCommentItem($child_obj, 0, 1, $user_id, $level);
                    }
                    ?>
                <?php endif ?>
            </div>
        </div>
        <?php if ($level > 1 && count($children_list) > 2) : ?>
            <div class="bg-white pt-2 -mr-6 mt-2">
                <div class="show-more-comment subtitle2 py-0 px-3 flex justify-center items-center text-neutrals-500 bg-neutrals-200 w-fit cursor-pointer" level="level-<?php echo $level ?>">نمایش بیشتر (<?php echo count($children_list) - 2 ?>)</div>
            </div>
<?php endif;
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
}
