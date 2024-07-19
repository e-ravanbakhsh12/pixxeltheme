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
            <h1 class="text-xl semibold-28 md:semibold-36">
                محصولات
            </h1>
            <div class="products-list grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 w-full pt-8 md:pt-6 gap-2 md:gap-4">
                <?php if ($products->have_posts()) foreach ($products->posts as $product) :
                    $color = get_field('color', $product->ID);
                    $properties = get_field('properties', $product->ID);

                ?>
                    <a href="<?= get_permalink($product->ID) ?>" class="w-full flex flex-col items-center p-3 md:pb-6 bg-white rounded-2xl group-1">
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
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol role="status" id="loading-spinner" viewBox="0 0 100 101" fill="" xmlns="http://www.w3.org/2000/svg">
        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB" />
        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="" />
    </symbol>
</svg>