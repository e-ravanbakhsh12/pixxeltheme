<?php

namespace PixxelTheme\includes;

use PixxelTheme\templates\representation\Representation;
use PixxelTheme\includes\comment\Comment;
use PixxelTheme\includes\Form;

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
        $vars[] = 'representation';

        return $vars;
    }

    public  function addRewriteRules()
    {

        # ======================================================
        #  AJAX rewrite Rule ===================================
        # ======================================================
        add_rewrite_tag('%labellSearch%', '([^&/]+)');
        add_rewrite_rule('wp-ajax/search/([^/]+)/?', 'index.php?labellSearch=$matches[1]', 'top');

        add_rewrite_tag('%representation%', '([^&/]+)');
        add_rewrite_rule('wp-ajax/representation/([^/]+)/?', 'index.php?representation=$matches[1]', 'top');


        add_rewrite_tag('%labellComment%', '([^&/]+)');
        add_rewrite_rule('wp-ajax/comment/([^/]+)/?', 'index.php?labellComment=$matches[1]', 'top');

        add_rewrite_tag('%labellForm%', '([^&/]+)');
        add_rewrite_rule('wp-ajax/form/([^/]+)/?', 'index.php?labellForm=$matches[1]', 'top');

        // flush_rewrite_rules();
    }

    public  function templateRedirectHandler()
    {
        $expanded_url = explodeUrlWithQuery()['main-url'];
        if ($expanded_url[1] == 'wp-ajax') {
            define('WP_AJAX', true);
            global $wp_query;

            $commentQuery = $wp_query->get('labellComment');
            if (!empty($commentQuery)) {
                $commentTemplate = new Comment();
                $commentTemplate->setQuery($commentQuery);
                return;
            }
            $representationQuery = $wp_query->get('representation');
            if (!empty($representationQuery)) {
                $representationPageTemplate = new Representation();
                $representationPageTemplate->setQuery($representationQuery);
                return;
            }

            $formQuery = $wp_query->get('labellForm');
            if (!empty($formQuery)) {
                $form = new Form();
                $form->setQuery($formQuery);
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
