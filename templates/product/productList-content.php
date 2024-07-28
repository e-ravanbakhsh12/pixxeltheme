<?php

namespace PixxelTheme\templates\product;

use WP_Query;

wp_enqueue_script('pixxel-blogList', PIXXEL_URL . '/assets/js/product-list.js', ['jquery'], PIXXEL_VERSION, true);


$_this = $args['_this'];
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type'         => 'product',
    'orderby'           => 'date',
    'order'             => 'DESC',
    'post_status'       => 'publish',
    'posts_per_page'    => 8,
    'paged'             => $paged,
);
$products = new WP_Query($args);
?>
<div class="product-list-container bg-cream-02 relative">
    <div class="container xl:max-w-screen-xl px-6 md:px-0 pt-2">
        <div class="breadcrumb-list regular-12 text-midnight-700 flex items-center gap-1">
            <a href="<?= home_url() ?>" class="">خانه</a>
            <i class="pixxelicon-arrow-right-2 rotate-180 text-[.5rem]"></i>
            <div class="">محصولات</div>

        </div>
    </div>
    <section class="py-10 md:py-16">
        <div class="container xl:max-w-screen-xl px-3 md:px-0 ">
            <h1 class="text-xl semibold-28 md:semibold-36" data-anim="title" data-delay="0.2" data-split="lines">
                محصولات
            </h1>
            <div class="products-list grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 w-full pt-8 md:pt-6 gap-2 md:gap-4">
                <?= $_this->displayList($products); ?>
            </div>
            <div class="pagination">
                <?php
                if ($products->max_num_pages > 1) {
                    echo $_this->displayPagination($paged, $products->max_num_pages);
                }
                ?>
            </div>

        </div>
    </section>
</div>
