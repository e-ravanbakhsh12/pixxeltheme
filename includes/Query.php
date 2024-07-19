<?php

namespace PixxelTheme\includes;


class Query
{
    function __construct()
    {
    }

    // search Queries
    public static function getSearchProduct($string)
    {
        global $wpdb;
        $postQuery = "
             SELECT p.* FROM {$wpdb->prefix}posts as p
             WHERE p.post_title LIKE '%{$string}%'
             AND p.post_type = 'product'
             AND p.post_status = 'publish'
             GROUP BY p.ID
             ORDER BY p.post_date DESC
             ";
        return $wpdb->get_results($postQuery);
    }

}
