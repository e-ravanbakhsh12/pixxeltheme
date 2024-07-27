<?php

namespace PixxelTheme\templates\blog;

use WP_Query;

wp_enqueue_style('splide', PIXXEL_URL . '/assets/css/splide-core.min.css', [], '4.1.2');
wp_enqueue_script('splide', PIXXEL_URL . '/assets/js/splide.min.js', [], '4.1.2', true);
wp_enqueue_script('pixxel-blogList', PIXXEL_URL . '/assets/js/blog-list.js', ['jquery', 'splide'], PIXXEL_VERSION, true);

$_this = $args['_this'];
$paged = $_GET['pg'] ? $_GET['pg'] : 1;
$order = $_GET['order'] ? $_GET['order'] : 'date';
$search = $_GET['search'] ? $_GET['search'] : false;
$args = array(
    'post_type'         => 'post',
    'posts_per_page'    => 8,
    'paged'             => $paged,
    'post_status'       => 'publish',
    'meta_key'         => 'view-count',
    'orderby'           => $order,
    'order'             => 'DESC',
);
if($search)$args['search_title']= $search;
$blogs = new WP_Query($args);
$popularArgs = array(
    'post_type'         => 'post',
    'posts_per_page'    => 8,
    'paged'             => 1,
    'post_status'       => 'publish',
    'meta_key'         => 'view-count',
    'orderby'           => 'meta_value_num',
    'order'             => 'DESC',
);
$popularBlogs = new WP_Query($popularArgs);
$headerData = get_field('header_data');
?>
<div class="product-list-container relative">
    <div class="container xl:max-w-screen-xl px-6 md:px-0 pt-2">
        <div class="breadcrumb-list regular-12 text-midnight-700 flex items-center gap-1">
            <a href="<?= home_url() ?>" class="">خانه</a>
            <i class="pixxelicon-arrow-right-2 rotate-180 text-[.5rem]"></i>
            <div class="">بلاگ</div>

        </div>
    </div>
    <section class="py-10 md:py-16">
        <div class="container xl:max-w-screen-xl px-3 md:px-0 flex-center gap-4 flex-col ">
            <h1 class="text-xl semibold-28 md:semibold-36" data-anim="title" data-delay="0.2" data-split="lines">
                <?= $headerData['title'] ?>
            </h1>
            <p class="regular-14 md:regular-18 pt-4 text-center" data-anim="up" data-y="40" data-delay="0.3"><?= $headerData['description'] ?></p>
        </div>
    </section>
    <section class="bg-light-blue py-10 md:py-16">
        <div class="container xl:max-w-screen-xl px-3 md:px-0 flex-center gap-4 flex-col ">
            <h2 class="text-xl semibold-28 md:semibold-36" data-anim="title" data-delay="0.2" data-split="lines">
                محبوب‌ترین مقالات
            </h2>
            <div id="popular-blog-list" class="splide splide-popular-blog relative w-full pt-6 md:pt-14" aria-label="popular Blog list">
                <div class="splide__track">
                    <div class="splide__list">
                        <?php foreach ($popularBlogs->posts as $i=> $blog) :
                        ?>
                            <li class="splide__slide " data-anim="horizontal" data-x="40" data-delay="<?=  $i*0.2 ?>">
                                <a href="<?= get_permalink($blog->ID) ?>" class="grid grid-cols-[7.875rem_1fr] md:grid-cols-[14rem_1fr] grid-rows-2 w-[20rem] md:w-[39.5rem] py-3 px-2 md:p-6 bg-white rounded-2xl  md:rounded-3xl gap-3 md:gap-x-6 md:gap-y-4">
                                    <?= get_the_post_thumbnail($blog->ID, 'full', ['class' => 'w-full h-[5rem] md:h-[8.75rem] object-cover rounded-2xl md:row-span-2']) ?>
                                    <h3 class="semibold-16 md:semibold-18 ">
                                        <span class="line-clamp-2">
                                            <?= $blog->post_title ?>
                                        </span>
                                    </h3>
                                    <div class="regular-14 col-span-2 md:col-span-1">
                                        <p class="line-clamp-2 "><?= getFirstParagraph($blog->post_content) ?></p>
                                    </div>
                                </a>
                            </li>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-10 md:py-16">
        <div class="container xl:max-w-screen-xl px-3 md:px-0 ">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <h2 class="text-xl semibold-28 md:semibold-36 lg:col-span-2" data-anim="horizontal" data-x="40" data-delay="0.2">
                    همه مقالات
                </h2>
                <div class="pixxel-select group-1  relative items-center justify-between w-full " icon="text-midnight-400 text-xs " data-anim="horizontal" data-x="40" data-delay="0.4">
                    <select class="w-full rounded-2xl h-10  bg-white outline-none text-center cursor-pointer text-midnight-400 border-2 border-midnight-50 flex-center" name="display-order" id="display-order" list-class="border-2 border-midnight-50 rounded-2xl cursor-pointer" style="display: none;">
                        <Option class="px-3 py-1 " value="date" <?= $order==='date'?'selected':'' ?>>جدیدترین</Option>
                        <Option class="px-3 py-1 " value="meta_value_num" <?= $order==='meta_value_num'?'selected':'' ?>>محبوبترین</Option>
                        <Option class="px-3 py-1 " value="modified" <?= $order==='modified'?'selected':'' ?>>بروزترین</Option>
                    </select>
                </div>
                <div class="relative w-full flex col-span-2 md:col-span-1" data-anim="horizontal" data-x="40" data-delay="0.6">
                    <input type="text" name='search-blog' id="search-blog" class="w-full rounded-2xl h-10  bg-white outline-none text-midnight-400 border-2 border-midnight-50 px-3 pl-5" value="<?= $search?$search:'' ?>" />
                    <i class="pixxelicon-search text-sm absolute left-2 top-2"></i>
                </div>
            </div>
            <div class="products-list grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 w-full pt-8 md:pt-6 gap-2 md:gap-4">
                <?= $_this->displayList($blogs) ?>
            </div>
            <div class="pagination" data-anim="up" data-y="40" data-delay="0.3">
                <?php
                if ($blogs->max_num_pages > 1) {
                    echo $_this->displayPagination($paged, $blogs->max_num_pages);
                }
                ?>
            </div>

        </div>
    </section>
</div>