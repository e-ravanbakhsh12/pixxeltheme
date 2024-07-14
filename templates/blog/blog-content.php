<?php

namespace PixxelTheme\templates\blog;

use WP_Query;

wp_enqueue_style('labell-icon', PIXXEL_URL . '/assets/css/labellicon.css');
wp_enqueue_style('splide', PIXXEL_URL . '/assets/css/splide-core.min.css', [], '4.1.2');
wp_enqueue_script('splide', PIXXEL_URL . '/assets/js/splide.min.js', [], '4.1.2', true);
wp_enqueue_script('labell-blog', PIXXEL_URL . '/assets/js/blog.js', ['jquery', 'splide'], PIXXEL_VERSION, true);

$class = $args['class'];
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
<div class="main-container bg-white relative">
    <section class="relative pt-[4.5rem] md:pt-36 bg-white w-full max-w-[53.125rem] mx-auto <?= $relatedBlog->have_posts() ? '' : 'pb-[4.5rem] md:pb-44' ?>">
        <div class="container xl:max-w-screen-xl px-3 md:px-0">
            <h1 class="text-[1.75rem] md:text-[2rem] font-black flex items-baseline  gap-2 ">
                <?= get_the_title() ?>
            </h1>
            <p class="mt-6 text-sm leading-6"><?= get_the_excerpt() ?></p>
            <?= get_the_post_thumbnail(get_the_ID(), 'full', ['class' => 'w-full object-contain py-4 md:py-6']) ?>
            <div class="flex justify-between gap-4 text-xs ">
                <?php if (0) : ?>
                    <div class="flex items-baseline gap-1 py-2 text-magenta">
                        <?php if (is_array(get_the_category())) foreach (get_the_category() as $i => $category) : ?>
                            <a href="<?php echo esc_url(get_term_link($category->term_id)) ?>" class=" " title="<?= $category->name ?>"><?= $category->name ?></a><?= $i + 1 < count(get_the_category()) ? ' ، ' : '' ?>
                        <?php endforeach ?>
                    </div>
                <?php endif ?>
                <div class=""><?= date_i18n('d  M  Y', strtotime(get_the_date('m/d/y'))) ?></div>
            </div>
            <div class="text-sm mt-6 md:mt-8 labell-post-content ">
                <?= the_content() ?>
            </div>
            <?php if (is_array(get_the_tags()) && 1==2) : ?>
                <div class="flex flex-wrap items-baseline gap-1 py-2 text-light-gray-4 text-xs">
                    <i class="pixxelicon-location text-sm"></i>
                    <?php if (count(get_the_tags())) foreach (get_the_tags() as $i => $tag) : ?>
                        <a href="<?php echo esc_url(get_term_link($tag->term_id)) ?>" class=" " title="<?= $tag->name ?>"><?= $tag->name ?></a><?= $i + 1 < count(get_the_tags()) ? ' ، ' : '' ?>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
        </div>
    </section>

    <?php
    if ($relatedBlog->have_posts()) :
    ?>
        <section class="container xl:max-w-screen-xl  mt-[4.5rem] md:mt-28 pb-[4.5rem] md:pb-44">
            <div class="mr-4 md:mr-0 relative z-10">
                <h2 class="text-[1.375rem] md:text-[1.75rem] font-bold flex items-baseline  gap-2">
                    <i class="pixxelicon-shape text-base text-magenta"></i>
                    مطالب مشابه
                </h2>
                <div id="related-blog-gallery" class="splide splide-related-blog relative mt-6" aria-label="Related Blog Gallery">
                    <div class="splide__track">
                        <div class="splide__list">
                            <?php foreach ($relatedBlog->posts as $blog) :
                            ?>
                                <li class="splide__slide ">
                                    <div class="flex flex-col gap-2 md:gap-8 ">
                                        <div class="relative shrink-0">
                                            <?= get_the_post_thumbnail($blog->ID, 'full', ['class' => 'w-full object-cover object-top h-32 md:h-56']) ?>
                                            <i class="pixxelicon-corner absolute -top-1 right-0 text-white text-xl rotate-180"></i>
                                        </div>
                                        <div class="">
                                            <a href="<?= get_permalink($blog->ID) ?>" class="relative group-1 line-clamp-2 min-h-10">
                                                <h3 class="text-xs md:text-sm font-medium line-clamp-2"><?= $blog->post_title ?></h3>
                                            </a>
                                            <div class="flex items-baseline gap-2 text-[0.625rem]">
                                                <i class="pixxelicon-calendar "></i>
                                                <?= date_i18n('d  M  Y', strtotime($blog->post_date)) ?>
                                            </div>
                                            <p class="line-clamp-2 md:line-clamp-4 text-[0.625rem] md:text-xs mt-2 md:mt-4"><?= $blog->post_excerpt  ?></p>
                                        </div>

                                    </div>

                                </li>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="splide__arrows flex items-center justify-center gap-4 mt-7 md:mt-0">
                        <button class="splide__arrow splide__arrow--prev md:absolute md:-right-5 md:top-1/2 md:-translate-y-1/2 text-sm size-9 flex-center text-dusty-gray bg-gray-1 hover:bg-magenta hover:text-white transition-all">
                            <i class="pixxelicon-Left-arrow flex-center rotate-180"></i>
                        </button>
                        <button class="splide__arrow splide__arrow--next md:absolute md:-left-5 md:top-1/2 md:-translate-y-1/2 text-sm size-9 flex-center text-dusty-gray bg-gray-1 hover:bg-magenta hover:text-white transition-all">
                            <i class="pixxelicon-Left-arrow flex-center"></i>
                        </button>
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