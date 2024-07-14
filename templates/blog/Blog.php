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
        if ($this->query == 'get-sub-category') {
            
        }
    }

    public function displayContent()
    {
        get_template_part('templates/blog/blog', 'content', ['class' => $this]);
    }
}
