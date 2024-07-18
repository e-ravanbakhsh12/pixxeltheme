<?php
namespace PixxelTheme\templates\product;

class ProductList
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

    public function displayPagination($page_query = '',$max_num_pages, $pagination_offset = 3)
    {
        ob_start();
        get_template_part('templates/product/productList', 'pagination', ['class' => $this, 'page_query' => $page_query,'pagination_offset'=>$pagination_offset,'max_num_pages'=>$max_num_pages]);
        return  ob_get_clean();
        
    }

    public function displayContent()
    {
        get_template_part('templates/product/productList', 'content', ['_this' => $this]);
    }
}
