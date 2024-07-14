<?php

namespace PixxelTheme\templates\layouts\header;

use PixxelTheme\includes\nav\NavWalker;

$_this = $args['_this'];
$mode = $_this->mode;
$type = $_this->type;
?>
<!DOCTYPE HTML>
<html <?php language_attributes() ?>>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport" />
    <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php do_action('wp_body_open'); ?>
    <?php if ($type != 'empty') : ?>
        <main class="website-wrapper flex flex-col">
            <?php if (!function_exists('elementor_theme_do_location') || !\elementor_theme_do_location('header')) : ?>
                <header class="Pixxel-header container xl:max-w-screen-xl  relative">
                    <div class="transition-all z-50 px-1 flex items-center justify-between md:justify-start py-2 md:p-0 absolute top-0 w-full <?= $mode == 'transparent' ? 'border-b border-white/20  text-white ' : 'bg-white' ?>">

                        <i class="pixxelicon-hamburger text-base p-3 md:hidden"></i>
                        <img src="<?= PIXXEL_URL . '/assets/img/logo.png' ?>" class="size-10 " />

                        <div class="search-icon-container border-none md:border-b <?= $mode == 'transparent' ? 'border-white/20' : '' ?> flex justify-between items-center md:gap-24 md:mr-auto">
                            <span class="hidden md:block">جستجو</span>
                            <i class="pixxelicon-search text-base p-3"></i>
                        </div>
                    </div>
                </header>
            <?php endif ?>
            <div class="main-page-wrapper">
            <?php endif ?>