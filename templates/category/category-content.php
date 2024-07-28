<?php

namespace PixxelTheme\templates\category;

use WP_Query;

$class = $args['class'];
$currentCategory = get_queried_object();
$paged = max(1, get_query_var('page'));
$args = array(
    'cat' => $currentCategory->term_id,
    'posts_per_page' => 4,
    'paged' => $paged,
);

$categoryQuery = new WP_Query($args);
$currentPageLink = get_category_link($currentCategory->term_id);
?>
<div class="main-container bg-cream-02 relative">
    <section class="py-10 md:py-16">
        <div class="container xl:max-w-screen-xl px-3 md:px-0 ">
            <h1 class="text-xl semibold-28 md:semibold-36" data-anim="title" data-delay="0.2" data-split="lines">
            <?= the_archive_title() ?>
            </h1>
            <div class="category-list grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 w-full pt-8 md:pt-6 gap-2 md:gap-4">
                <?php if ($categoryQuery->have_posts()) foreach ($categoryQuery->posts as $post) : ?>
                    <a href="<?= get_permalink($post->ID) ?>" class="w-full flex flex-col items-center p-3 md:pb-6 bg-white rounded-2xl group-1" data-anim="up" data-y="40" data-delay="0.2">
                        <?= get_the_post_thumbnail($post->ID, 'full', ['class' => 'w-full aspect-square object-contain rounded-xl', 'loading' => "lazy", 'data-item' => 0]) ?>
                        <h3 class="regular-16 md:regular-18 w-full text-right transition-all group-1-hover:text-blue-main pt-3 md:pt-4"><?= $post->post_title ?></h3>
                        <p class="regular-12 md:regular-14 text-midnight-700 w-full text-right pt-2 line-clamp-2"><?= $post->post_excerpt ?></p>
                    </a>
                <?php endforeach ?>
                <?php wp_reset_postdata(); ?>
            </div>
            <div class="pagination">
                <?php
                if ($categoryQuery->max_num_pages > 1) {
                    echo $class->displayPagination($paged, $categoryQuery->max_num_pages, $currentPageLink);
                }
                ?>
            </div>
        </div>
    </section>
</div>