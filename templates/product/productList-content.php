<?php

namespace PixxelTheme\templates\product;

use WP_Query;


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
                <?php if ($products->have_posts()) foreach ($products->posts as $product) :
                    $color = get_field('color', $product->ID);
                    $properties = get_field('properties', $product->ID);

                ?>
                    <a href="<?= get_permalink($product->ID) ?>" class="w-full flex flex-col items-center p-3 md:pb-6 bg-white rounded-2xl group-1" data-anim="up" data-y="40" data-delay="0.2">
                        <div class="w-full flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <?php if ($color) foreach ($color as $i => $item) : ?>
                                    <span class="size-5 rounded-full border-orange-2 border-2" style="background-color:<?= $item['value'] ?>"></span>
                                <?php endforeach ?>
                            </div>
                            <div class="semibold-12 md:semibold-14 px-2 py-[0.125rem] rounded-full bg-bg text-midnight-900"><?= $properties['skin_type'] ?></div>
                        </div>
                        <?= get_the_post_thumbnail($product->ID, 'full', ['class' => 'w-full aspect-square object-contain', 'loading' => "lazy", 'data-item' => 0]) ?>
                        <h3 class="regular-16 md:regular-18 w-full text-right transition-all group-1-hover:text-blue-main pt-3 md:pt-4"><?= $product->post_title ?></h3>
                        <p class="regular-12 md:regular-14 text-midnight-700 w-full text-right pt-2 line-clamp-2"><?= $product->post_excerpt ?></p>
                    </a>
                <?php
                    wp_reset_postdata();
                endforeach ?>
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
