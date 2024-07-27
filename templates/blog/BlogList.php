<?php

namespace PixxelTheme\templates\blog;

use WP_Query;

class BlogList
{
    protected $query;
    public function __construct()
    {
        add_filter('posts_where', [$this, 'addQuerySearchTitle'], 10, 2);
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
            $order = $data['order'];
            $search = $data['search'];
            $url = $data['url'];
            $args = [
                'post_type'         => 'post',
                'posts_per_page'    => 8,
                'paged'             => $page,
                'post_status'       => 'publish',
                'meta_key'         => 'view-count',
                'orderby'           => $order,
                'order'             => 'DESC',
            ];
            $queryString = [];
            if($page>1)$queryString[] ='pg='.$page;
            if($order!='date')$queryString[] ='order='.$order;
            if ($search){
                $args['search_title'] = $search;
                $queryString[] ='search='.$search;
            }
            $filerList = new WP_Query($args);
            $list = $this->displayList($filerList);
            $pagination = $this->displayPagination($page,$filerList->max_num_pages);
            $newUrl = explode('?',$url)[0] .'?'.implode('&',$queryString);
            ajaxResponse(true, '', ['list'=>$list,'pagination'=>$pagination,'url'=>$newUrl]);
        }
    }

    public   function addQuerySearchTitle($where, $wp_query)
    {
        global $wpdb;
        if ($title = $wp_query->get('search_title')) {
            $where .= " AND " . $wpdb->posts . ".post_title LIKE '%" . esc_sql($wpdb->esc_like($title)) . "%'";
        }
        return $where;
    }

    public function displayPagination($page_query = '', $max_num_pages, $pagination_offset = 3)
    {
        ob_start();
        get_template_part('templates/blog/blogList', 'pagination', ['_this' => $this, 'page_query' => $page_query, 'pagination_offset' => $pagination_offset, 'max_num_pages' => $max_num_pages]);
        return  ob_get_clean();
    }
    public function displayList($blogs)
    {
        ob_start();
        get_template_part('templates/blog/blogList', 'list', ['_this' => $this,'blogs'=>$blogs]);
        return  ob_get_clean();
    }

    public function displayContent()
    {
        get_template_part('templates/blog/blogList', 'content', ['_this' => $this]);
    }
}
