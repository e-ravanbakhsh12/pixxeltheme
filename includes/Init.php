<?php

namespace PixxelTheme\includes;


if (!defined('ABSPATH')) {
    exit;
}

class Init
{
    function __construct()
    {
    }

    public static function registerSidebar()
    {
        register_sidebar(array(
            'name'          => __('blog Sidebar', 'textdomain'),
            'id'            => 'sidebar-blog',
            'description'   => __('Widgets in this area will be shown on all blog posts', 'textdomain'),
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget'  => '</li>',
            'before_title'  => '<h2 class="widgettitle">',
            'after_title'   => '</h2>',
        ));
    }

    public static function registerPostTypeAndTaxonomy()
    {
        if (!post_type_exists('product')) {

            // Set labels for product post type
            $labels = array(
                'name'          => esc_html__('product', 'pixxel'),
                'singular_name' => esc_html__('product', 'pixxel'),
                'search_items'  => esc_html__('Search product', 'pixxel'),
                'all_items'     => esc_html__('All product', 'pixxel'),
                'parent_item'   => esc_html__('Parent product', 'pixxel'),
                'add_new'   => esc_html__('Add New product', 'pixxel'),
                'not_found'   => esc_html__('No product Found', 'pixxel'),
                'archives'   => esc_html__('product Archive', 'pixxel'),
                'insert_into_item'   => esc_html__('Inset Lnto product', 'pixxel'),
                'item_link'   => esc_html__('product Link', 'pixxel'),
                'edit_item'     => esc_html__('Edit product', 'pixxel'),
                'new_item'     => esc_html__('Add New product', 'pixxel'),
                'add_new_item'  => esc_html__('Add New product', 'pixxel'),
                'view_item'     => esc_html__('View product', 'pixxel'),
                'view_items'     => esc_html__('View product', 'pixxel'),
                'item_updated'   => esc_html__('product Update', 'pixxel'),
                'item_trashed'   => esc_html__('product Trash', 'pixxel'),
                'menu_name'     => esc_html__('product', 'pixxel')
            );

            // Set main arguments for product post type
            $args = array(
                'labels'          => $labels,
                'singular_label'  => esc_html__('product', 'pixxel'),
                'public'          => true,
                'capability_type' => 'post',
                'show_ui'         => true,
                'show_in_menu'    => true,
                'hierarchical'    => false,
                'menu_position'   => 10,
                'menu_icon'       => 'dashicons-media-document',
                'supports'        => ['title', 'editor', 'comments', 'thumbnail', 'custom-fields'],
                'rewrite'         => array(
                    'slug' => 'product',
                    'with_front' => false
                ),
                'has_archive'=>'product',
            );

            // Register product post type
            register_post_type('product', $args);

            

            // register project category
            $cat_labels = array(
                'name'          => esc_html__('Category', 'pixxel'),
                'singular_name' => esc_html__('Category', 'pixxel'),
                'search_items'  => esc_html__('Search Category', 'pixxel'),
                'all_items'     => esc_html__('All Category', 'pixxel'),
                'parent_item'   => esc_html__('Parent Category', 'pixxel'),
                'no_terms'   => esc_html__('No Category', 'pixxel'),
                'item_link'   => esc_html__('Category Link', 'pixxel'),
                'edit_item'     => esc_html__('Edit Category', 'pixxel'),
                'view_item'     => esc_html__('View Category', 'pixxel'),
                'view_items'     => esc_html__('View Category', 'pixxel'),
                'new_item'     => esc_html__('Add New Category', 'pixxel'),
                'add_new_item'  => esc_html__('Add New Category', 'pixxel'),
                'item_updated'   => esc_html__('Update Category', 'pixxel'),
                'item_trashed'   => esc_html__('Trash Category', 'pixxel'),
                'menu_name'     => esc_html__('Category', 'pixxel')
            );
            $cat_args = array(
                'labels'          => $cat_labels,
                'public'          => true,
                'show_ui'         => true,
                'hierarchical'    => true,
                'show_in_quick_edit'    => true,
                'show_admin_column'    => true,
                'rewrite'         => array(
                    'slug' => 'product-category',
                    'with_front' => false,
                    'hierarchical' => true,
                ),

            );
            register_taxonomy('product-category', ['product'], $cat_args);
        }
    }
}
