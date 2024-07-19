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
        <main class="website-wrapper flex flex-col relative">
            <?php if (!function_exists('elementor_theme_do_location') || !\elementor_theme_do_location('header')) : ?>
                <header class="Pixxel-header w-full <?= $mode == 'transparent' ? 'absolute top-0 right-0' : 'relative' ?> absolute  z-50 border-b <?= $mode == 'transparent' ? ' border-white/20 ' : 'bg-white border-midnight-50' ?>">

                    <div class="container xl:max-w-screen-xl ">
                        <div class="transition-all  px-1 flex items-center justify-between md:justify-start py-2 md:px-0 md:py-5 ">
                            <i class="pixxelicon-hamburger hamburger-menu text-base p-3 md:hidden cursor-pointer <?= $mode == 'transparent' ? 'text-white' : '' ?>"></i>
                            <img src="<?= PIXXEL_URL . '/assets/img/logo.png' ?>" class="size-10 " />
                            <div class="mobile-menu-overlay hidden fixed top-0 left-0 w-full h-full bg-black/50 "></div>
                            <div class="menu-container regular-16 md:regular-14 w-3/4 md:w-full h-svh top-0 md:top-auto md:h-auto px-5 md:px-2 fixed md:relative -right-full md:right-0 transition-all duration-200 bg-white md:bg-transparent">
                                <div class="flex justify-between gap-2 mt-6  md:hidden">
                                    <i class="pixxelicon-close menu-close p-3"></i>
                                </div>
                                <?php echo
                                wp_nav_menu(
                                    array(
                                        'theme_location' => 'main-menu',
                                        'container' => 'nav',
                                        'container_class' => 'w-full flex items-center',
                                        'menu_class' => 'flex flex-col w-full md:items-center md:flex-row md:relative',
                                        'add_drop_class' => 'drop',
                                        'add_mega_class' => 'w-full',
                                        'walker' => new NavWalker($mode),
                                    )
                                );
                                ?>
                                <div class="flex items-center gap-4 md:hidden text-base md:text-xl pt-6">
                                    <i class="pixxelicon-instagram "></i>
                                    <i class="pixxelicon-telegram "></i>
                                </div>
                            </div>


                            <div class="search-icon-container border-none md:border-b <?= $mode == 'transparent' ? 'border-white/20 text-white ' : '' ?> flex justify-between items-center md:gap-24 md:mr-auto">
                                <span class="hidden md:block">جستجو</span>
                                <i class="pixxelicon-search text-base p-3"></i>
                            </div>
                        </div>
                    </div>
                    <div class="search-overlay hidden fixed top-0 left-0 w-full h-full bg-black/50 "></div>
                    <div class="search-container fixed w-full translate-y-[-150%] transition-all duration-500 ">
                        <div class="relative flex flex-col items-center bg-white  ">
                            <div class="row-1 h-14 md:h-[5.5rem] flex items-center md:border-b border-black/10 w-full">
                                <div class="container xl:max-w-screen-xl flex items-center justify-between gap-2">
                                    <img src="<?= PIXXEL_URL . '/assets/img/logo.png' ?>" class="size-10 hidden md:block" />
                                    <div class="search-bar w-full max-w-[53rem] px-3 md:px-0 relative py-2 flex items-center">
                                        <input type="text" id="main-search" class="w-full border-b border-b-black px-10 h-10  outline-none">
                                        <i class="pixxelicon-search absolute right-2 hidden md:block"></i>
                                        <i class="pixxelicon-trash hidden absolute left-2 cursor-pointer text-black/80"></i>
                                        <svg class="fill-blue-main size-6 hidden absolute left-2">
                                            <use href="#loading-spinner" />
                                        </svg>
                                    </div>
                                    <div class="close-search flex-center regular-14 bg-white/80 rounded-full py-1 px-4 absolute -bottom-12 md:relative md:bottom-auto gap-2 right-1/2 translate-x-1/2 md:right-auto md:translate-x-0 cursor-pointer">
                                        بستن
                                        <i class="pixxelicon-close"></i>

                                    </div>
                                </div>
                            </div>
                            <div class="result-row min-h-[20.75rem] max-h-[70svh] overflow-y-auto">
                                <div class="container xl:max-w-screen-xl flex justify-between gap-2">
                                    <div class="main-search-result-content w-full grid grid-cols-2 md:grid-cols-4 gap-4 py-6 md:py-6">

                                    </div>
                                    <div class="empty-result-container w-full hidden">
                                        <div class="flex-center flex-col gap-4 py-6">
                                            <i class="pixxelicon-search-not-found text-4xl text-midnight-200"></i>
                                            <p class="regular-14 md:regular-16">محصولی یافت نشد</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </header>
            <?php endif ?>
            <div class="main-page-wrapper">
            <?php endif ?>