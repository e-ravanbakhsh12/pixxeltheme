<?php

namespace PixxelTheme\templates\blog;

use WP_Query;

wp_enqueue_style('pixxel-icon', PIXXEL_URL . '/assets/css/pixxelicon.css');
wp_enqueue_style('splide', PIXXEL_URL . '/assets/css/splide-core.min.css', [], '4.1.2');
wp_enqueue_script('splide', PIXXEL_URL . '/assets/js/splide.min.js', [], '4.1.2', true);
wp_enqueue_script('pixxel-blog', PIXXEL_URL . '/assets/js/blog.js', ['jquery', 'splide'], PIXXEL_VERSION, true);

$class = $args['_this'];
foreach (get_the_category() as $category) {
    $cat_id[] = $category->term_id;
}
$relatedBlogArgs = [
    'post_type' => 'post',
    'posts_per_page' => 8,
    'post__not_in' => [get_the_ID()],
    'tax_query'          => [
        [
            'taxonomy'         => 'category', // taxonomy slug
            'terms'            => $cat_id, // term ids
            'field'            => 'term_id', // Also support: slug, name, term_taxonomy_id
            'operator'         => 'IN', // Also support: AND, NOT IN, EXISTS, NOT EXISTS
            'include_children' => true,
        ],
    ],
];
$relatedBlog = new WP_Query($relatedBlogArgs);
?>
<div class="blog-container bg-white relative">
    <div class="container xl:max-w-screen-xl px-6 md:px-0 pt-2">
        <div class="breadcrumb-list regular-12 text-midnight-700 flex items-center gap-1">
            <a href="<?= home_url() ?>" class="">خانه</a>
            <i class="pixxelicon-arrow-right-2 rotate-180 text-[.5rem]"></i>
            <a href="<?= get_permaLink($productPageId[0]) ?>" class="">محصولات</a>
            <i class="pixxelicon-arrow-right-2 rotate-180 text-[.5rem]"></i>
            <div class=""><?= get_the_title() ?></div>
        </div>
    </div>
    <section class="py-10 ">
        <div class="container xl:max-w-[50.5rem] px-6 md:px-0 ">
            <?= get_the_post_thumbnail(get_the_ID(), 'full', ['class' => 'w-full object-contain rounded-2xl']) ?>
            <h1 class="semibold-28 md:semibold-36 py-8 border-b border-midnight-50"><?= get_the_title() ?></h1>
            <div class="pixxel-post-content pb-8 border-b border-midnight-50">
                <?= get_the_content() ?>
            </div>
        </div>
    </section>

    <?php
    if ($relatedBlog->have_posts()) :
    ?>
        <section class="container xl:max-w-screen-xl py-10 md:py-32 flex flex-col md:items-center">
                <h2 class="semibold-28 md:semibold-36 ">
                    مقالات مشابه
                </h2>
                <div id="related-blog-gallery" class="splide splide-related-blog relative w-full pt-6 md:pt-14" aria-label="Related Blog Gallery">
                    <div class="splide__track">
                        <div class="splide__list">
                            <?php foreach ($relatedBlog->posts as $blog) :
                            ?>
                                <li class="splide__slide ">
                                    <div class="flex flex-col gap-2 md:gap-8 w-[16.25rem] md:w-[19.25rem]">
                                        <?= get_the_post_thumbnail($blog->ID, 'full', ['class' => 'w-full h-[10.5rem] md:h-[12rem] object-cover rounded-2xl']) ?>
                                        <div class="">
                                            <a href="<?= get_permalink($blog->ID) ?>" class="semibold-16 min-h-12">
                                                <h3 class="line-clamp-2"><?= $blog->post_title ?></h3>
                                            </a>
                                            <p class="regular-14 line-clamp-2 mt-4"><?= getFirstParagraph($blog->post_content) ?></p>
                                        </div>

                                    </div>

                                </li>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
        </section>
    <?php endif ?>

</div>
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol role="status" id="loading-spinner" viewBox="0 0 100 101" fill="" xmlns="http://www.w3.org/2000/svg">
        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB" />
        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="" />
    </symbol>
</svg>