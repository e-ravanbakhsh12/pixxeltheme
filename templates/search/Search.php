<?php

namespace PixxelTheme\templates\search;

use PixxelTheme\includes\Query;

class Search
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
        $search = sanitize_text_field($this->query);
        $posts = Query::getSearchProduct($search);
        if (!empty($posts) ) {
            $result = $this->resultContent($posts);
            ajaxResponse(true, 'جستجو با موفقیت انجام شد', ['result'=>$result
            ]);
        } else {
            ajaxResponse(false, 'موردی یافت نشد', [
                'post' => 'nothing found',
                'Result' => $posts,
            ]);
        }
    }

    public function resultContent($product)
    {
        ob_start();
        get_template_part('templates/search/search', 'content', ['class' => $this,'product'=>$product]);
        return ob_get_clean();
    }
}
