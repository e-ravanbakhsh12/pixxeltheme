<?php

namespace PixxelTheme\includes;

use PixxelTheme\PixxelTheme;

if (!defined('ABSPATH')) {
    exit;
}

class Enqueue extends PixxelTheme
{
    function __construct()
    {
    }

    public static function enqueueScripts()
    {

        // Register theme stylesheet.
        wp_enqueue_style('pixxel-icon', PIXXEL_URL . '/assets/pixxelicon/style.css', [], PIXXEL_VERSION);
        // wp_enqueue_style('pixxel-iransans', PIXXEL_URL . '/assets/css/iransans.css', [], 1.1);
        wp_register_style('pixxel-style', PIXXEL_URL . '/assets/css/main-style.css', [], PIXXEL_VERSION);
        wp_enqueue_style('pixxel-style');

        // js files
        if (!isGoogleBot()) {
            wp_enqueue_script('gsap', PIXXEL_URL . '/assets/js/gsap.min.js', '3.12.5', true);
            wp_enqueue_script('gsap-st', PIXXEL_URL . '/assets/js/scrollTrigger.min.js', ['gsap'], '3.12.5', true);
            wp_enqueue_script('gsap-stp', PIXXEL_URL . '/assets/js/scrollToPlugin.min.js', ['gsap', 'gsap-st'], '3.12.5', true);
            wp_enqueue_script('gsap-ss', PIXXEL_URL . '/assets/js/scrollSmoother.min.js', ['gsap', 'gsap-st', 'gsap-stp'], PIXXEL_VERSION, true);
            wp_enqueue_script('gsap-text', PIXXEL_URL . '/assets/js/splitText.min.js', ['gsap'], PIXXEL_VERSION, true);
            wp_enqueue_script('pixxel-animation', PIXXEL_URL . '/assets/js/animation.js', ['jquery', 'gsap', 'gsap-st', 'gsap-stp', 'gsap-ss', 'gsap-text'], PIXXEL_VERSION, true);
        }
        wp_enqueue_script('pixxel-global-js', PIXXEL_URL . '/assets/js/global.js', ['jquery'], PIXXEL_VERSION, true);
        wp_localize_script('pixxel-global-js', 'pixxelArr', backEndData());


        wp_dequeue_style('wp-block-library');   
        wp_dequeue_style('wp-block-library-rtl-css');
        wp_dequeue_style('wp-block-library-theme');
    }

    public static function adminEnqueueScripts()
    {
        wp_enqueue_media();
        wp_enqueue_script('pixxel-admin-js', get_template_directory_uri() . '/assets/js/pixxel-admin.js', array('jquery'), PIXXEL_VERSION, true);

        wp_enqueue_script('wp-color-picker-alpha', get_template_directory_uri() . '/assets/js/wp-color-picker-alpha.min.js', array('wp-color-picker'), PIXXEL_VERSION, true);
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_style('pixxel-css', get_template_directory_uri() . '/assets/css/pixxel-admin.css');
    }

    public  function removeJQueryMigrate($scripts)
    {
        if (!is_admin() && isset($scripts->registered['jquery'])) {
            $script = $scripts->registered['jquery'];
            if ($script->deps) {
                // Check whether the script has any dependencies

                $script->deps = array_diff($script->deps, array('jquery-migrate'));
            }
        }
    }

    public function addAdminMenu()
    {
        add_menu_page(
            esc_html__('تنظیمات پوسته', 'pixxel'),
            esc_html__('تنظیمات پوسته', 'pixxel'),
            'manage_options',
            'pixxel-forum',
            [$this, 'dashboardMenuContent'],

        );

        add_submenu_page(
            'pixxel-forum',
            esc_html__('پیشخوان', 'pixxel'),
            esc_html__('پیشخوان', 'pixxel'),
            'manage_options',
            'pixxel-forum-dashboard',
            [$this, 'dashboardMenuContent'],
        );
    }

    public function dashboardMenuContent()
    {
        // require_once get_template_directory() . '/includes//admin/dashboard.php';
    }
}
