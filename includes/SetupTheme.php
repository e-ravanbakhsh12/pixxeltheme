<?php

namespace PixxelTheme\includes;

if (!defined('ABSPATH')) {
    exit;
}

class SetupTheme
{
    function __construct()
    {
    }

    public function init()
    {
        /**
         * Add support for automatic feed links
         */
        add_theme_support('automatic-feed-links');

        /**
         * Add support for post thumbnails
         */
        add_theme_support('post-thumbnails');

        /**
         * Add support for post title tag
         */
        // add_theme_support("title-tag");
        add_theme_support('html5', [('comment-form')]);
        register_nav_menu('main-menu', __('Main Menu'));
        add_image_size('front-blog', 247, 165, true);

        /**
         * Add labell shortcode
         */
            
    }

    public function textdomainHandler()
    {
        load_theme_textdomain('labell', PIXXEL_DIR . '/languages/');
    }
    
    
}
