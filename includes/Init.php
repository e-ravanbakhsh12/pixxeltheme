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
                'name'          => esc_html__('product', 'labell'),
                'singular_name' => esc_html__('product', 'labell'),
                'search_items'  => esc_html__('Search product', 'labell'),
                'all_items'     => esc_html__('All product', 'labell'),
                'parent_item'   => esc_html__('Parent product', 'labell'),
                'add_new'   => esc_html__('Add New product', 'labell'),
                'not_found'   => esc_html__('No product Found', 'labell'),
                'archives'   => esc_html__('product Archive', 'labell'),
                'insert_into_item'   => esc_html__('Inset Lnto product', 'labell'),
                'item_link'   => esc_html__('product Link', 'labell'),
                'edit_item'     => esc_html__('Edit product', 'labell'),
                'new_item'     => esc_html__('Add New product', 'labell'),
                'add_new_item'  => esc_html__('Add New product', 'labell'),
                'view_item'     => esc_html__('View product', 'labell'),
                'view_items'     => esc_html__('View product', 'labell'),
                'item_updated'   => esc_html__('product Update', 'labell'),
                'item_trashed'   => esc_html__('product Trash', 'labell'),
                'menu_name'     => esc_html__('product', 'labell')
            );

            // Set main arguments for product post type
            $args = array(
                'labels'          => $labels,
                'singular_label'  => esc_html__('product', 'labell'),
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

             // Set labels for project post type
             $labels = array(
                'name'          => esc_html__('project', 'labell'),
                'singular_name' => esc_html__('project', 'labell'),
                'search_items'  => esc_html__('Search project', 'labell'),
                'all_items'     => esc_html__('All project', 'labell'),
                'parent_item'   => esc_html__('Parent project', 'labell'),
                'add_new'   => esc_html__('Add New project', 'labell'),
                'not_found'   => esc_html__('No project Found', 'labell'),
                'archives'   => esc_html__('project Archive', 'labell'),
                'insert_into_item'   => esc_html__('Inset Lnto project', 'labell'),
                'item_link'   => esc_html__('project Link', 'labell'),
                'edit_item'     => esc_html__('Edit project', 'labell'),
                'new_item'     => esc_html__('Add New project', 'labell'),
                'add_new_item'  => esc_html__('Add New project', 'labell'),
                'view_item'     => esc_html__('View project', 'labell'),
                'view_items'     => esc_html__('View project', 'labell'),
                'item_updated'   => esc_html__('project Update', 'labell'),
                'item_trashed'   => esc_html__('project Trash', 'labell'),
                'menu_name'     => esc_html__('project', 'labell')
            );

            // Set main arguments for project post type
            $args = array(
                'labels'          => $labels,
                'singular_label'  => esc_html__('project', 'labell'),
                'public'          => true,
                'capability_type' => 'post',
                'show_ui'         => true,
                'show_in_menu'    => true,
                'hierarchical'    => false,
                'menu_position'   => 10,
                'menu_icon'       => 'dashicons-edit',
                'supports'        => ['title', 'editor', 'comments', 'thumbnail', 'custom-fields'],
                'rewrite'         => array(
                    'slug' => 'project',
                    'with_front' => false
                ),
                'has_archive'=>'project',
            );

            // Register project post type
            register_post_type('project', $args);

            // register project category
            $cat_labels = array(
                'name'          => esc_html__('Category', 'labell'),
                'singular_name' => esc_html__('Category', 'labell'),
                'search_items'  => esc_html__('Search Category', 'labell'),
                'all_items'     => esc_html__('All Category', 'labell'),
                'parent_item'   => esc_html__('Parent Category', 'labell'),
                'no_terms'   => esc_html__('No Category', 'labell'),
                'item_link'   => esc_html__('Category Link', 'labell'),
                'edit_item'     => esc_html__('Edit Category', 'labell'),
                'view_item'     => esc_html__('View Category', 'labell'),
                'view_items'     => esc_html__('View Category', 'labell'),
                'new_item'     => esc_html__('Add New Category', 'labell'),
                'add_new_item'  => esc_html__('Add New Category', 'labell'),
                'item_updated'   => esc_html__('Update Category', 'labell'),
                'item_trashed'   => esc_html__('Trash Category', 'labell'),
                'menu_name'     => esc_html__('Category', 'labell')
            );
            $cat_args = array(
                'labels'          => $cat_labels,
                'public'          => true,
                'show_ui'         => true,
                'hierarchical'    => true,
                'show_in_quick_edit'    => true,
                'show_admin_column'    => true,
                'rewrite'         => array(
                    'slug' => 'project-category',
                    'with_front' => false,
                    'hierarchical' => true,
                ),

            );
            register_taxonomy('project-category', ['project'], $cat_args);
        }
    }
}
