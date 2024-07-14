<?php

namespace PixxelTheme\templates\layouts\footer;

class Footer
{
    protected $query;
    public $mode;
    public $type;
    public function __construct($mode = 'light', $type = 'normal')
    {
        $this->mode = $mode;
        $this->type = $type;
    }

    public function setQuery($query)
    {
        $this->query = $query;
        $this->ajaxActions();
    }

    public function ajaxActions()
    {
    }

    public function getSocialList()
    {
        return [
            'pixxelicon-instagram' => home_url(),
            'pixxelicon-telegram' => home_url(),
            'pixxelicon-linkedin' => home_url(),
            'pixxelicon-youtube' => home_url(),
            'pixxelicon-aparat' => home_url(),
        ];
    }

    public function displayContent()
    {
        get_template_part('templates/layouts/footer/footer', 'content', ['_this' => $this]);
    }
}
