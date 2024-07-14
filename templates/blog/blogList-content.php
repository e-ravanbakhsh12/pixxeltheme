<?php

namespace PixxelTheme\templates\blog;

use WP_Query;


$class = $args['class'];
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type'         => 'post',
    'orderby'           => 'date',
    'order'             => 'DESC',
    'post_status'       => 'publish',
    'posts_per_page'    => 12,
    'paged'             => $paged,
);
$posts = new WP_Query($args);
?>
<div class="main-container bg-grad relative">
    <section class="relative pt-[4.5rem] md:pt-36  w-full mx-auto pb-[4.5rem] md:pb-44">
        <div class="container xl:max-w-screen-xl bg-white p-3 md:py-4 md:px-6 ">
            <h1 class="text-xl md:text-[1.75rem] font-bold flex items-baseline  gap-2 ">
                <i class="pixxelicon-shape text-base text-magenta"></i>
                <?= get_the_title() ?>
            </h1>
            <div class="blog-list grid grid-cols-2 md:grid-cols-4 w-full mt-4 md:mt-12 gap-x-2 gap-6-4 md:gap-x-5 md:gap-y-12  ">
                <?php if ($posts->have_posts()) foreach ($posts->posts as $post) : ?>
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
                if ($posts->max_num_pages > 1) {
                    echo $class->displayPagination($paged, $posts->max_num_pages,get_permalink(get_the_ID()));
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