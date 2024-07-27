<?php

namespace PixxelTheme\templates\blog;

class Blog
{
    protected $query;
    public function __construct()
    {
    }


    public function setQuery($query)
    {
        $this->query = $query;
        $this->ajaxActions();
    }

    public function ajaxActions()
    {
        if ($this->query == 'view-post') {
            $data = json_decode(stripslashes($_POST['data']));
            $postId = sanitize_text_field($data->id);
            $count = intval( get_post_meta($postId,'view-count',true));
            update_post_meta($postId,'view-count',$count+1);
            ajaxResponse(true, 'بازدید با موفقیت ثبت گردید', [$count]);
        }
    }

    public function displayContent()
    {
        get_template_part('templates/blog/blog', 'content', ['_this' => $this]);
    }
}
