<?php
namespace PixxelTheme\templates\blog;

class BlogList
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

    public function displayPagination($page_query = '',$max_num_pages,$url, $pagination_offset = 3)
    {
        ob_start();
        get_template_part('templates/blog/blogList', 'pagination', ['class' => $this, 'page_query' => $page_query,'pagination_offset'=>$pagination_offset,'max_num_pages'=>$max_num_pages,'url'=>$url]);
        return  ob_get_clean();
        
    }

    public function displayContent()
    {
        get_template_part('templates/blog/blogList', 'content', ['_this' => $this]);
    }
}
