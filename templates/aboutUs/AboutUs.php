<?php
namespace PixxelTheme\templates\aboutUs;

class AboutUs
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

    public function ajaxActions(){

    }

    public function displayContent()
    {
        get_template_part('templates/aboutUs/aboutUs', 'content', ['_this' => $this]);
    }
}
