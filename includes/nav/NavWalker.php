<?php

namespace PixxelTheme\includes\nav;

use Walker_Nav_Menu;

class NavWalker extends Walker_Nav_Menu
{

    public function __construct($mode)
    {
        $this->mode = $mode;
    }
    private $mode;
    private $current_item;
    private $second_current_item;
    function start_lvl(&$output, $depth = 0, $args = null)
    {

        $indent = str_repeat("\t", $depth);
        if ($depth == 0) {
            $this->second_current_item = $this->current_item;
            if (get_post_meta($this->current_item->ID, '_pixxel_is_mega', true)) {

                $output .= $indent . '<div class="pixxel-sub-menu main-mega-menu  md:top-11 text-black md:absolute md:bg-white md:right-0 w-full stretch-megamenu md:pointer-events-none  hidden md:flex md:opacity-0 md:group-1-hover:opacity-100 md:group-1-hover:pointer-events-auto  flex-row  z-[60] md:shadow-lg md:duration-300 ">
                <ul class=" mega-items-container w-full flex flex-col md:flex-row md:relative md:gap-4 ">';
            } else {
                $output .= '<ul class="pixxel-sub-menu md:absolute md:right-0 md:top-11 text-black w-full hidden md:flex md:opacity-0 md:group-1-hover:opacity-100 md:group-1-hover:pointer-events-auto md:w-56 md:pointer-events-none transition-all md:duration-300 flex-col md:bg-white md:shadow-lg">';
            }
        } elseif ($depth == 1 && $args->walker->has_children) {
            if (get_post_meta($this->current_item->menu_item_parent, '_pixxel_is_mega', true)) {
                $output .= $indent . '
                <div class="mega-submenu-container w-full hidden md:block grow pixxel-sub-menu">
                <ul class="pixxel-sub-menu mega-submenu  w-full pr-3 pl-2 md:pr-0 md:pl-0 flex py-4 flex-col ">';
            } else {
                $output .= $indent . '
                <ul class="pixxel-sub-menu md:absolute md:right-full  w-full hidden md:opacity-0 md:flex flex-col md:group-2-hover:opacity-100 md:bg-white md:group-2-hover:pointer-events-auto md:pointer-events-none">';
            }
        } else {
            $output .= $indent . '
            <ul class="pixxel-sub-menu md:absolute md:right-full w-full hidden md:opacity-0 md:flex flex-col md:group-2-hover:opacity-100 md:bg-white md:group-2-hover:pointer-events-auto md:pointer-events-none">';
        }
    }
    function start_el(&$output, $item, $depth = 0, $args = null, $current_object_id = 0)
    {
        $this->current_item = $item;
        $is_mega = get_post_meta($this->current_item->ID, '_pixxel_is_mega', true);
        $parent_is_mega = get_post_meta($this->current_item->menu_item_parent, '_pixxel_is_mega', true);
        $css_class = 'has-mega-menu';
        // $locations = get_nav_menu_locations();
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $classes[] = 'cursor-pointer transition-all duration-100 px-4';

        if ($depth == 0) {
            $classes[] = $this->mode === 'transparent' ? 'md:hover:bg-white md:hover:text-black md:text-white' : 'md:hover:bg-blue-main md:hover:text-white';
            $classes[] = 'group-1 level-1 py-1 md:py-0 rounded-xl';
            if ($args->walker->has_children) {
                if (!$is_mega) {
                    $classes[] = 'md:relative ';
                }
                $classes[] = 'flex flex-wrap justify-between items-center gap-2 bg-black-50';
            } else {
                $classes[] = '';
            }
        }
        if ($depth == 1) {
            $classes[] = 'group-2 level-2 flex flex-col transition-all ';
            if ($parent_is_mega) {
                $classes[] = ' w-full ';
            }
        }
        if ($depth == 2) {
            $classes[] = 'group-3 level-3';
            $classes[] = 'md:-mr-4';
        }
        if ($depth > 0) {
            $classes[] = 'py-1 md:py-2';
        }



        $args = apply_filters('nav_menu_item_args', $args, $item, $depth);

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        $hover_color = get_post_meta($this->current_item->ID, '_pixxel_hover_color', true);
        $icon_bg = get_post_meta($this->current_item->ID, '_pixxel_menu_icon_bg', true);
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        $style  = !empty($hover_color) ? ' hover="' . $hover_color . '" ' : '';
        $style .= !empty($hover_color) ? ' icon-bg="' . $icon_bg . '" ' : '';
        $output .= $indent . '<li' . $id . $class_names . $style . ' >';

        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target)     ? $item->target     : '';
        $atts['rel']    = !empty($item->xfn)        ? $item->xfn        : '';
        $atts['href']   = !empty($item->url)        ? $item->url        : '';



        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        if ($depth == 1) {
            $icon = get_post_meta($this->current_item->ID, '_pixxel_menu_icon', true);

            if ($icon) {
                $title = '<i  class="' .  $icon  . ' w-10 h-10 flex justify-center items-center  text-2xl"></i>';
            }
        }
        $title .= apply_filters('the_title', $item->title, $item->ID);



        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);
        $item_output = $args->before;


        if ($depth == 0 && $args->walker->has_children) {
            $first_level_text = '';
            if (get_post_meta($this->current_item->ID, '_pixxel_is_mega', true)) {
                $first_level_text = 'first-level-text';
            }
            $item_output .= '<div class="flex flex-col items-center justify-between ' . $first_level_text . '  relative w-full mobile-menu-item">';
            $item_output .= '<div class="flex flex-row justify-between items-center w-full md:gap-2">';
        } elseif ($depth == 1 && get_post_meta($this->current_item->menu_item_parent, '_pixxel_is_mega', true)) {
            $item_output .= '<div class="flex flex-row items-center justify-between  relative w-full mobile-menu-item  md:border-b md:border-b-mid-50 h-fit">';
        } else {
            $item_output .= '<div class="flex flex-row items-center justify-between  relative w-full mobile-menu-item ">';
        }

        if ($depth == 0) {
            $item_output .= '<a class=" flex items-center transition-all py-1 md:py-3"' . $attributes . '>';
        } elseif ($depth == 1) {
            $item_output .= '<a class="flex justify-start gap-2 transition-all items-center py-1 md:py-2 h-fit md:hover:text-blue-main"' . $attributes . '>';
        } elseif ($depth == 2) {
            $item_output .= '<a class="transition-all py-1 md:hover:text-blue-main"' . $attributes . '>';
        } else {
            $item_output .= '<a class="transition-all py-1 px-4 md:hover:text-blue-main"' . $attributes . '>';
        }

        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';

        $item_output .= $args->after;

        if ($depth == 0 && $args->walker->has_children) {
            $badge = get_post_meta($this->current_item->ID, '_pixxel_menu_badge', true);
            if ($badge) {
                $item_output .= '<span class="text-2xs-bold h-4 md:h-3 bg-error-500 md:absolute top-12 right-0 mr-auto px-2 flex justify-center items-center text-white ml-2 md:ml-auto">' . $badge . '</span>';
            }
            $item_output .= '<i class="pixxelicon-chevron-down text-[0.5rem] transition-all"></i>';
            $item_output .= '</div>';
            $item_output .= '<i class="first-menu-arrow absolute top-9 hidden md:group-1-hover:block transition-all mx-auto z-50"></i>';
        }
        if ($depth == 1 && $args->walker->has_children) {
            $item_output .= '<i class="pixxelicon-chevron-down text-[0.5rem] md:hidden"></i>';
        }
        if ($depth > 1 && $args->walker->has_children) {
            $item_output .= '<i class="pixxelicon-chevron-down text-[0.5rem]"></i>';
        }
        $item_output .= '</div>';
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    public function end_el(&$output, $item, $depth = 0, $args = array())
    {

        $output .= "</li>\n";
    }
    function end_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        // $output .= "$indent</ul></div>\n";
        if (get_post_meta($this->second_current_item->ID, '_pixxel_is_mega', true) && ($depth == 0 || $depth == 1)) {

            $output .= "$indent</ul>\n";
            // $output .= '<div class="bg-background w-auto min-w-[100px] min-h-[300px]">

            // </div>';
            $output .= "</div>";
        } else {
            $output .= "$indent</ul>\n";
        }
    }
}
