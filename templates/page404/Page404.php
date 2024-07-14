<?php
namespace PixxelTheme\templates\page404;
use Collator;
class Page404
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
        get_template_part('templates/page404/page404', 'content', ['class' => $this]);
    }
}
