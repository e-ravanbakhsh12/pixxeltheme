<?php

namespace PixxelTheme\includes;

use PixxelTheme\templates\search\Search;
use PixxelTheme\includes\comment\Comment;
use PixxelTheme\templates\blog\Blog;
use PixxelTheme\templates\blog\BlogList;

if (!defined('ABSPATH')) {
    exit;
}

class Rewrite
{
    function __construct()
    {
    }

    public  function addQueryVars($vars)
    {
        $vars[] = 'pixxelBlog';
        $vars[] = 'pixxelBlogList';
        $vars[] = 'pixxelSearch';
        $vars[] = 'pixxelComment';

        return $vars;
    }

    public  function addRewriteRules()
    {

        # ======================================================
        #  AJAX rewrite Rule ===================================
        # ======================================================
        add_rewrite_tag('%pixxelSearch%', '([^&/]+)');
        add_rewrite_rule('wp-ajax/search/([^/]+)/?', 'index.php?pixxelSearch=$matches[1]', 'top');

        add_rewrite_tag('%pixxelBlog%', '([^&/]+)');
        add_rewrite_rule('wp-ajax/blog/([^/]+)/?', 'index.php?pixxelBlog=$matches[1]', 'top');
        
        add_rewrite_tag('%pixxelBlogList%', '([^&/]+)');
        add_rewrite_rule('wp-ajax/blog-list/([^/]+)/?', 'index.php?pixxelBlogList=$matches[1]', 'top');

        add_rewrite_tag('%pixxelComment%', '([^&/]+)');
        add_rewrite_rule('wp-ajax/comment/([^/]+)/?', 'index.php?pixxelComment=$matches[1]', 'top');
        // flush_rewrite_rules();
    }

    public  function templateRedirectHandler()
    {
        $expanded_url = explodeUrlWithQuery()['main-url'];
        if ($expanded_url[1] == 'wp-ajax') {
            define('WP_AJAX', true);
            global $wp_query;

            $commentQuery = $wp_query->get('pixxelComment');
            if (!empty($commentQuery)) {
                $commentTemplate = new Comment();
                $commentTemplate->setQuery($commentQuery);
                return;
            }
            $searchQuery = $wp_query->get('pixxelSearch');
            if (!empty($searchQuery)) {
                $search = new Search();
                $search->setQuery(urldecode($searchQuery));
                return;
            }
            $blogQuery = $wp_query->get('pixxelBlog');
            if (!empty($blogQuery)) {
                $blog = new Blog();
                $blog->setQuery($blogQuery);
                return;
            }

            $blogListQuery = $wp_query->get('pixxelBlogList');
            if (!empty($blogListQuery)) {
                $blogList = new BlogList();
                $blogList->setQuery($blogListQuery);
                return;
            }
            
        }

        // redirect conditions
        $redirectSlugs = [
            'tag',
            'articles',
            'gallery',
            'gallery2',
            'news',
            'products',
            'projects',
            'reseller',
        ];
        $blogPagination  = $expanded_url[1] === 'blog' && $expanded_url[2]==='page' && !empty($expanded_url[4]);
        $projectProductFeed  = ($expanded_url[1] === 'product' || $expanded_url[1] === 'project') && $expanded_url[3] == 'feed';
        if (in_array($expanded_url[1], $redirectSlugs) || $blogPagination || $projectProductFeed) {
            wp_redirect(home_url());
            exit();
        }
    }
}
