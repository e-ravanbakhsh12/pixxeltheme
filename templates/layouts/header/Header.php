<?php
namespace PixxelTheme\templates\layouts\header;

class Header
{
    protected $query;
    public $mode;
    public $type;
    public function __construct($mode='light',$type='normal')
    {
        $this->mode =$mode;
        $this->type =$type;
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
        get_template_part('templates/layouts/header/header', 'content', ['_this' => $this]);
    }
}
