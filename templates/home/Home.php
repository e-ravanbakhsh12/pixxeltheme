<?php
namespace PixxelTheme\templates\home;
use Collator;
class Home
{
    protected $query;
    public function __construct()
    {
    }

    public  function getBlogPosts($blogPosts, $ajax = false)
    {
        ob_start();
        get_template_part('templates/home/home', 'blog-posts', ['class' => $this]);
        return ob_get_clean();
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
    public function persianSort($a, $b) {
        $collator = new Collator('fa_IR');
        return $collator->compare($a, $b);
    }

    public function displayContent()
    {
        get_template_part('templates/home/home', 'content', ['_this' => $this]);
    }
}
