<?php

namespace PixxelTheme\templates\contactUs;

class ContactUs
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
    }

    public function displayContent()
    {
        get_template_part('templates/contactUs/contactUs', 'content', ['class' => $this]);
    }
}
