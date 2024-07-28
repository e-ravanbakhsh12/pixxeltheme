<?php

namespace PixxelTheme\templates\product;

use WP_Query;

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

    public function ajaxActions()
    {
        if ($this->query == 'filter') {
            $data =  sanitizeNestedObject(json_decode(stripslashes($_POST['data'])));
            $page = intval($data['page']);
            // $order = $data['order'];
            // $search = $data['search'];
            $url = $data['url'];
            $args = [
                'post_type'         => 'product',
                'posts_per_page'    => 8,
                'paged'             => $page,
                'post_status'       => 'publish',
                'orderby'           => 'date',
                'order'             => 'DESC',
            ];
            $queryString = [];
            if ($page > 1) $queryString[] = 'pg=' . $page;
            // if ($order != 'date') $queryString[] = 'order=' . $order;
            // if ($search) {
            //     $args['search_title'] = $search;
            //     $queryString[] = 'search=' . $search;
            // }
            $filerList = new WP_Query($args);
            $list = $this->displayList($filerList);
            $pagination = $this->displayPagination($page, $filerList->max_num_pages);
            $newUrl = explode('?', $url)[0] . '?' . implode('&', $queryString);
            ajaxResponse(true, '', ['list' => $list, 'pagination' => $pagination, 'url' => $newUrl]);
        }
    }

    public function displayList($products)
    {
        ob_start();
        get_template_part('templates/product/productList', 'list', ['_this' => $this,'products'=>$products]);
        return  ob_get_clean();
    }

    public function displayPagination($page_query = '', $max_num_pages, $pagination_offset = 3)
    {
        ob_start();
        get_template_part('templates/product/productList', 'pagination', ['class' => $this, 'page_query' => $page_query, 'pagination_offset' => $pagination_offset, 'max_num_pages' => $max_num_pages]);
        return  ob_get_clean();
    }

    public function displayContent()
    {
        get_template_part('templates/product/productList', 'content', ['_this' => $this]);
    }
}
