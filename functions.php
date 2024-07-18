<?php
namespace PixxelTheme;
use PixxelTheme\includes\Enqueue;
use PixxelTheme\includes\SetupTheme;
use PixxelTheme\includes\nav\Navigation;
use PixxelTheme\includes\comment\Comment;
use PixxelTheme\includes\Rewrite;
use PixxelTheme\includes\Assign;
use PixxelTheme\includes\ACF;
use PixxelTheme\includes\Activation;
use PixxelTheme\includes\SEO;

if (!defined('PIXXEL_VERSION')) {
    define('PIXXEL_VERSION', wp_get_theme()->get('Version'));
}

if (!defined('PIXXEL_DIR')) {
    define('PIXXEL_DIR', get_template_directory());
}

if (!defined('TEMPLATE_DIR')) {
    define('TEMPLATE_DIR', PIXXEL_DIR . '/templates');
}

if (!defined('PIXXEL_URL')) {
    define('PIXXEL_URL', get_template_directory_uri());
}

include_once PIXXEL_DIR . '/vendor/autoload.php';


class PixxelTheme
{
    public static $activatedPlugin;
    function __construct()
    {
        self::$activatedPlugin = get_option('active_plugins');
        $this->setHooks();
    }

    public function setHooks()
    {
        # ======================================================
        # Theme init ===========================================
        # ======================================================
        add_action('init', ['PixxelTheme\includes\Init', 'registerPostTypeAndTaxonomy']);

        
        # ======================================================
        #  SEO & Schema ========================================
        # ======================================================
        $SEO = new SEO();
        add_filter('wpseo_robots', [$SEO, 'robotsHandler'], 9999);


        # ======================================================
        # setup theme ==========================================
        # ======================================================
        $setupTheme = new SetupTheme();
        add_action('after_setup_theme', [$setupTheme, 'init']);
        add_action('after_setup_theme', [$setupTheme, 'textdomainHandler']);

        # ======================================================
        # rewrite rules ========================================
        # ======================================================
        $rewrite = new Rewrite();
        add_action('init',  [$rewrite, 'addRewriteRules']);
        add_filter('query_vars', [$rewrite, 'addQueryVars']);
        add_action('template_redirect', [$rewrite, 'templateRedirectHandler']);

        # ======================================================
        #  enqueue and dequeue css and js ======================
        # ======================================================
        $enqueue = new Enqueue();
        add_action('wp_enqueue_scripts', [$enqueue, 'enqueueScripts'], 1);
        add_action('wp_default_scripts', [$enqueue, 'removeJQueryMigrate']);
        add_action('admin_enqueue_scripts', [$enqueue, 'adminEnqueueScripts']);
        // add_action('admin_menu', [$enqueue, 'addAdminMenu']);


        # ======================================================
        #  assign to header and footer =========================
        # ======================================================
        $assign = new Assign();
        add_action('wp_head', [$assign, 'addToHeader'], 1);
        add_action('wp_footer', [$assign, 'addToFooter']);
        add_action('wp_body_open', [$assign, 'addToBody'], 1);

        # ======================================================
        #  MENU Navigation =====================================
        # ======================================================
        // if (is_admin()) {
        //     $navigation = new Navigation();
        //     add_action('wp_ajax_haal_get_menu_icon', [$navigation, 'getMenuIcon']);
        //     add_action('wp_nav_menu_item_custom_fields',  [$navigation, 'menuCustomFields'], 10, 5);
        //     add_action('wp_update_nav_menu_item',  [$navigation, 'navUpdate'], 10, 2);
        // }


        # ======================================================
        #  Custom Comment ======================================
        # ======================================================
        $comment = new Comment();
        add_action('wp_insert_comment', [$comment, 'addRoleForAdminCommentReplay'], 10, 2);
        add_action('haal_custom_comment', [$comment, 'generateCustomComment'], 10, 1);

        # =======================================================
        #  Advance Custom Field =================================
        # =======================================================
        if (class_exists('ACF')) {
            $ACF = new ACF();
        }

        # =======================================================
        #  Activation Action ====================================
        # =======================================================
        $activation = new Activation();
        add_action('after_switch_theme', [$activation, 'generateRepresentationTable']);
    }
}

$Pixxel = new PixxelTheme();
