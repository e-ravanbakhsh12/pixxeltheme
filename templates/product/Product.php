<?php
namespace PixxelTheme\templates\product;

class Product
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
        get_template_part('templates/product/product', 'content', ['class' => $this]);
    }
}
