<?php
namespace PixxelTheme\includes;



if (!defined('ABSPATH')) {
    exit;
}

class SEO
{
    function __construct()
    {
        
    }

    public function robotsHandler($string){
        if (isTopDomain()) {
            return 'noindex, nofollow';
        } 

        return $string;
    }
}
