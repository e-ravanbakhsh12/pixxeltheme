<?php

namespace PixxelTheme\templates\category;

use WP_Query;

$class = $args['class'];
$currentCategory = get_queried_object();
$paged = max(1, get_query_var('paged'));
$args = array(
    'cat' => $currentCategory->term_id,
    'posts_per_page' => 12,
    'paged' => $paged,
);

$categoryQuery = new WP_Query($args);
$currentPageLink = get_category_link($currentCategory->term_id);
?>
<?php if (0) : ?>
    <div class="main-container bg-grad relative">
        <section class="relative pt-[4.5rem] md:pt-36  w-full mx-auto pb-[4.5rem] md:pb-44">
            <div class="container xl:max-w-screen-xl bg-white p-3 md:py-4 md:px-6 ">
                <h1 class="text-xl md:text-[1.75rem] font-bold flex items-baseline  gap-2 ">
                    <i class="pixxelicon-shape text-base text-magenta"></i>
                    <?= the_archive_title() ?>
                </h1>
                <div class="blog-list grid grid-cols-2 md:grid-cols-4 w-full mt-4 md:mt-12 gap-x-2 gap-6-4 md:gap-x-5 md:gap-y-12  ">
                    <?php if ($categoryQuery->have_posts()) foreach ($categoryQuery->posts as $post) : ?>
                        <a href="<?= get_permalink($post->ID) ?>" class="flex flex-col gap-2 md:gap-8 ">
                            <div class="relative shrink-0">
                                <?= get_the_post_thumbnail($post->ID, 'full', ['class' => 'w-full object-cover object-top h-32 md:h-56']) ?>
                                <i class="pixxelicon-corner absolute -top-1 right-0 text-white text-xl rotate-180"></i>
                            </div>
                            <div class="">
                                <div class="relative group-1 line-clamp-2 min-h-10">
                                    <h3 class="text-xs md:text-sm font-medium line-clamp-2"><?= $post->post_title ?></h3>
                                </div>
                                <div class="flex items-baseline gap-2 text-[0.625rem]">
                                    <i class="pixxelicon-calendar "></i>
                                    <?= date_i18n('d  M  Y', strtotime($post->post_date)) ?>
                                </div>
                                <p class="line-clamp-2 md:line-clamp-4 text-[0.625rem] md:text-xs mt-2 md:mt-4"><?= $post->post_excerpt  ?></p>
                            </div>

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
<?php endif ?>