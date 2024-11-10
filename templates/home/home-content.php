<?php

namespace PixxelTheme\templates\home;

use WP_Query;

wp_enqueue_style('splide', PIXXEL_URL . '/assets/css/splide-core.min.css', [], '4.1.2');
wp_enqueue_script('splide', PIXXEL_URL . '/assets/js/splide.min.js', [], '4.1.2', true);
$jsDependency = ['jquery', 'splide'];
if (!isGoogleBot()) {
    wp_enqueue_script('pixxel-audio-player', PIXXEL_URL . '/assets/js/audio-player.js', [], PIXXEL_VERSION, true);
    wp_enqueue_script('pixxel-glightbox', PIXXEL_URL . '/assets/js/glightbox.min.js', [], PIXXEL_VERSION, true);
    wp_enqueue_style('pixxel-glightbox', PIXXEL_URL . '/assets/css/glightbox.min.css', [], PIXXEL_VERSION);
    $jsDependency[] = 'pixxel-glightbox';
    $jsDependency[] = 'pixxel-audio-player';
}
wp_enqueue_script('pixxel-home', PIXXEL_URL . '/assets/js/home.js', $jsDependency, PIXXEL_VERSION, true);

$_this = $args['_this'];
$section1 = get_field('section_1');
$section2 = get_field('section_2');
$section3 = get_field('section_3');
$section4 = get_field('section_4');
$section5 = get_field('section_5');
$section6 = get_field('section_6');
$section7 = get_field('section_7');
$section8 = get_field('section_8');
$productPageId = getPageIdByTemplate('pages/page-product.php');
$blogListId = getPageIdByTemplate('pages/page-blog.php');
$blogArgs = array(
    'post_type'         => 'post',
    'posts_per_page'    => 4,
    'paged'             => 1,
    'post_status'       => 'publish',
    'orderby'           => 'date',
    'order'             => 'DESC',
);
$blogs = new WP_Query($blogArgs);
?>
<div class="home-container relative">
    <section class="relative pt-[4.5rem] md:pt-32 overflow-hidden " style="background-color:<?= $section1['color'] ?>;">
        <?php if ($section1['hero_img']) : ?>
            <?= wp_get_attachment_image($section1['hero_img'], 'full', false, ['class' => 'cover-down w-auto absolute bottom-0 left-0 h-[18rem] md:h-[37rem] lg:h-[42rem] object-contain ']) ?>
        <?php else : ?>
            <img class="w-full absolute h-full object-cover inset-0" src="<?= PIXXEL_URL . '/assets/img/home/hero-bg.jpg' ?>" alt="">
        <?php endif ?>

        <div class="container xl:max-w-screen-xl  text-white z-10 relative px-4 md:px-0 pt-32 pb-8 md:pt-44 md:pb-52">
            <h1 class="bold-24 md:bold-48 drop-shadow-hero" data-anim="title" data-delay="0.2" data-split="lines"><?= $section1['title'] ?></h1>
            <p class="regular-14 md:regular-18 pt-4 md:pt-6 md:max-w-[25rem] drop-shadow-hero" data-anim="up" data-y="40" data-delay=".3"><?= $section1['description'] ?></p>
            <a href="<?= $section1['button']['link']['url'] ?>" target="<?= $section1['button']['link']['target'] ?>" class="flex-center h-10 rounded-full bg-blue-main text-white gap-2 w-fit px-4 mt-4 md:mt-6" data-anim="up" data-y="40" data-delay=".4">
                <?= $section1['button']['label'] ?>
                <i class="pixxelicon-chevron-left text-[0.5rem]"></i>
            </a>
        </div>
    </section>
    <section class="py-10 md:py-[6.5rem] bg-cream-02">
        <div class="container xl:max-w-screen-xl px-6 md:px-0 overflow-hidden">
            <div class="flex flex-wrap items-center pb-8 md:pb-4 md:border-b border-white">
                <h2 class="semibold-28 md:semibold-36 md:w-full order-1" data-anim="title" data-delay="0.2" data-split="lines"><?= $section2['title'] ?></h2>
                <a href="<?= get_permaLink($productPageId[0]) ?>" class="regular-14 md:regular-16 order-2 md:order-3 mr-auto">
                    مشاهده همه
                </a>
                <p class="pt-2 w-full md:w-auto order-3 md:order-2"><?= $section2['description'] ?></p>
            </div>
            <div id="product-gallery" class="splide product-slider relative pt-6 md:pt-8" aria-label="Roof Type Gallery">
                <div class="splide__track  pb-5">
                    <div class="splide__list">
                        <?php
                        if ($section2['products']) foreach ($section2['products'] as $i => $product) :
                            $color = get_field('color', $product->ID);
                            $properties = get_field('properties', $product->ID);
                        ?>
                            <li class="splide__slide relative w-[14rem] md:w-full bg-white rounded-2xl group-1 " data-anim="horizontal" data-x="40" data-delay="<?= $i * 0.2 ?>">
                                <div class="w-full flex flex-col items-center p-3 md:pb-6">
                                    <div class="w-full flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <?php if ($color) foreach ($color as $i => $item) : ?>
                                                <span class="size-5 rounded-full border-orange-2 border-2" style="background-color:<?= $item['value'] ?>"></span>
                                            <?php endforeach ?>
                                        </div>
                                        <div class="semibold-12 md:semibold-14 px-2 py-[0.125rem] rounded-full bg-bg text-midnight-900"><?= $properties['skin_type'] ?></div>
                                    </div>
                                    <?= get_the_post_thumbnail($product->ID, 'full', ['class' => 'w-full aspect-square object-contain rounded-xl', 'loading' => "lazy"]) ?>
                                    <h3 class="regular-16 md:regular-18 w-full text-right transition-all group-1-hover:text-blue-main pt-3 md:pt-4"><?= $product->post_title ?></h3>
                                    <p class="regular-12 md:regular-14 text-midnight-700 w-full text-right pt-2 line-clamp-2"><?= $product->post_excerpt ?></p>
                                    <a href="<?= get_permalink($product->ID) ?>" class="flex-center h-10 rounded-full bg-blue-main text-white gap-2 w-fit px-4 mt-4 md:mt-6 absolute  -bottom-5 opacity-0 group-1-hover:opacity-100 transition-all">مشاهده محصول</a>
                                </div>
                            </li>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="splide__arrows items-center justify-center gap-4 mt-7 md:mt-0 text-black hidden md:flex">
                    <button class="splide__arrow splide__arrow--prev absolute -right-12 top-[calc(50%_-_1.25rem)] -translate-y-1/2 text-sm size-10 rounded-full flex-center text-dusty-gray bg-white/30  hover:bg-white transition-all z-10">
                        <i class="pixxelicon-arrow-right-2  flex-center"></i>
                    </button>
                    <button class="splide__arrow splide__arrow--next absolute -left-12 top-[calc(50%_-_1.25rem)] -translate-y-1/2 text-sm size-10 rounded-full flex-center text-dusty-gray bg-white/30  hover:bg-white transition-all z-10">
                        <i class="pixxelicon-arrow-right-2 flex-center  rotate-180"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>
    <section class="py-10 md:py-[6.5rem] overflow-hidden">
        <div class="flex-center flex-col">
            <h2 class="semibold-28 md:semibold-36 md:w-full text-center" data-anim="title" data-delay="0.2" data-split="lines"><?= $section3['title'] ?></h2>

            <div id="video-gallery" class="splide video-slider relative pt-6 md:pt-8" aria-label="video Gallery">
                <div class="splide__track ">
                    <div class="splide__list">
                        <?php
                        if ($section3['video']) foreach ($section3['video'] as $i => $video) : ?>
                            <li class="splide__slide w-[17.5rem] md:w-[53.5rem] bg-white overflow-hidden rounded-2xl group-1 " data-anim="horizontal" data-x="-40" data-delay="<?= $i * 0.2 ?>">
                                <a href="<?= $video['video'] ?>" class="w-full glightbox flex-center relative" data-gallery="videoGallery" data-zoomable="true" data-draggable="true">
                                    <?= wp_get_attachment_image($video['cover'], 'full', false, ['class' => 'w-full h-[10rem] md:h-[30rem] object-cover']) ?>
                                    <div class="cover absolute w-full h-full bg-black/20"></div>
                                    <img src="<?= PIXXEL_URL . '/assets/img/home/video-play.png' ?>" alt="" class="rounded-full size-14 md:size-24 absolute ">
                                </a>
                            </li>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="splide__arrows items-center justify-center gap-4 mt-7 md:mt-0 text-black flex">
                    <button class="splide__arrow splide__arrow--prev absolute right-4 md:right-12 top-1/2 -translate-y-1/2 text-sm size-6 md:size-10 rounded-full flex-center text-dusty-gray bg-white/30 hover:bg-white transition-all z-10">
                        <i class="pixxelicon-arrow-right-2  flex-center"></i>
                    </button>
                    <button class="splide__arrow splide__arrow--next absolute left-4 md:left-12 top-1/2 -translate-y-1/2 text-sm size-6 md:size-10 rounded-full flex-center text-dusty-gray bg-white/30 hover:bg-white transition-all z-10">
                        <i class="pixxelicon-arrow-right-2 flex-center  rotate-180"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>
    <section class="py-10 md:py-[6.5rem] bg-light-blue">
        <div class="container xl:max-w-screen-xl px-6 md:px-0 flex-center flex-col overflow-hidden">
            <h2 class="semibold-28 md:semibold-36 md:w-full text-center" data-anim="title" data-delay="0.2" data-split="lines"><?= $section4['title'] ?></h2>
            <div id="consultant-gallery" class="splide consultant-slider w-full relative pt-6 md:pt-8" aria-label="consultant Gallery">
                <div class="splide__track">
                    <div class="splide__list">
                        <?php if (count($section4['expert']))
                            foreach ($section4['expert'] as $i => $expert) : ?>
                            <li class="splide__slide bg-white overflow-hidden rounded-2xl group-1 " data-anim="horizontal" data-x="40" data-delay="<?= $i * 0.2 ?>">
                                <div class="w-[17.5rem] md:w-full flex-center flex-col relative h-full p-3 md:p-6">
                                    <?= wp_get_attachment_image($expert['img'], 'full', false, ['class' => 'size-[10rem] rounded-full object-cover', 'loading' => "lazy"]) ?>
                                    <?php if ($expert['audio']['url']) : ?>
                                        <div class="audio-player flex items-center gap-2 relative">
                                            <div class="grow">
                                                <canvas class="audioCanvas w-full -mt-8" height="60"></canvas>
                                                <input type="text" class="audioUrl hidden" value="<?= $expert['audio']['url']  ?>">
                                            </div>
                                            <div class="decorLine h-[10px] rounded-full bg-light-blue mt-3 w-[calc(100%_-1.5rem)] grow absolute left-6"></div>
                                            <i class="pixxelicon-play rotate-180 text-blue-main text-l loadAudio mt-2" data-index="<?= $i  ?>"></i>
                                        </div>
                                    <?php endif ?>
                                    <div class="flex-center flex-col mt-auto">
                                        <h3 class="semibold-16 md:semibold-22 pt-3 md:pt-4"><?= $expert['name'] ?></h3>
                                        <p class="regular-14 md:regular-16 md:pt-2"><?= $expert['level'] ?></p>
                                        <div class="w-full h-[1px] bg-midnight-50"></div>
                                        <p class="text-center  regular-12 md:regular-14"><?= $expert['description'] ?></p>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="splide__arrows items-center justify-center gap-4 mt-7 md:mt-0 text-black flex">
                    <button class="splide__arrow splide__arrow--prev absolute right-5 md:-right-10 top-1/2 -translate-y-1/2 text-sm size-6 md:size-10 rounded-full flex-center text-blue-main transition-all z-10">
                        <i class="pixxelicon-arrow-right-2  flex-center"></i>
                    </button>
                    <button class="splide__arrow splide__arrow--next absolute left-5 md:-left-10 top-1/2 -translate-y-1/2 text-sm size-6 md:size-10 rounded-full flex-center text-blue-main  transition-all z-10">
                        <i class="pixxelicon-arrow-right-2 flex-center  rotate-180"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>
    <section class="py-10 md:py-[6.5rem]">
        <div class="container xl:max-w-screen-xl px-6 md:px-0 flex-center flex-col overflow-hidden">
            <h2 class="semibold-28 md:semibold-36 md:w-full text-center" data-anim="title" data-delay="0.2" data-split="lines"><?= $section5['title'] ?></h2>
            <p class="regular-14 md:regular-16 pt-4"><?= $section5['description'] ?></p>
            <div class="w-full grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-2 pt-6 md:pt-14">
                <?php
                if (count($section5['brand'])) foreach ($section5['brand'] as $i => $brand) : ?>
                    <a href="<?= $brand['link']['url'] ?>" class="w-full h-full flex-center flex-col gap-4 md:gap-8 py-3 md:py-9 px-4 md:px-6" data-anim="horizontal" data-x="-40" data-delay="<?= $i * 0.2 ?>">
                        <?= wp_get_attachment_image($brand['img'], 'full', false, ['class' => 'size-16 md:size-[4.5rem] rounded-full object-cover', 'loading' => "lazy"]) ?>
                        <h4 class="regular-16 md:regular-18 line-clamp-1"><?= $brand['title'] ?></h4>
                    </a>
                <?php endforeach ?>
            </div>
        </div>
    </section>
    <section class="py-10 md:py-[6.5rem] bg-cream-02">
        <div class="container xl:max-w-screen-xl px-6 md:px-0 flex-center flex-col">
            <h2 class="semibold-28 md:semibold-36 md:w-full text-center" data-anim="title" data-delay="0.2" data-split="lines">مقالات پیکسل اکسپرت</h2>
            <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4 pt-6 md:pt-14">
                <?php
                foreach ($blogs->posts as $i => $blog) : ?>
                    <a href="<?= get_permalink($blog->ID) ?>" class="w-full h-full p-3 md:p-6 bg-white rounded-3xl grid grid-cols-[7.75rem_1fr] md:grid-cols-[14rem_1fr] grid-rows-[auto_auto] gap-3 md:gap-x-6 md:gap-y-4" data-anim="up" data-y="40" data-delay="<?= $i > 1 ? '0.3' : '0.2' ?>">
                        <?= get_the_post_thumbnail($blog->ID, 'full', ['class' => 'row-span-1 md:row-span-2 w-full h-20 md:h-[8.75rem] object-cover rounded-2xl', 'loading' => 'lazy']) ?>
                        <h3 class="semibold-16 md:semibold-18  w-full">
                            <p class="line-clamp-2">
                                <?= $blog->post_title ?>
                            </p>
                        </h3>
                        <div class="regular-14 md:regular-16  col-span-2 md:col-span-1">
                            <p class="line-clamp-2">
                                <?= getFirstParagraph($blog->post_content) ?>
                            </p>
                        </div>
                    </a>
                <?php endforeach ?>
            </div>
            <a href="<?= get_permalink($blogListId[0]) ?>" class="regular-16 px-6 py-3 rounded-full border border-black mt-3 md:mt-8 transition-all hover:px-10 cursor-pointer" data-anim="up" data-y="40" data-delay="0.2">مشاهده‌ی همه</a>
        </div>
    </section>
    <section class="py-10 md:py-[6.5rem]">
        <div class="container xl:max-w-screen-xl px-6 md:px-0 grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4 overflow-hidden">
            <?php
            if($section6) foreach ($section6 as $i =>$banner) : ?>
                <a href="<?= $banner['link']['url'] ?>" class="w-full relative rounded-3xl overflow-hidden h-32 md:h-60" data-anim="horizontal" data-x="40" data-delay="<?= $i * 0.2 ?>">
                <?= wp_get_attachment_image($banner['img'], 'full', false, ['class' => 'w-full h-full flex-center  rounded-3xl object-cover hover:scale-110 overflow-hidden transition-all duration-300 hover:rotate-2', 'loading' => "lazy"]) ?>
                </a>
            <?php endforeach ?>
        </div>
    </section>
    <section class="py-10 md:py-[6.5rem] bg-light-blue">
        <div class="container xl:max-w-screen-xl px-6 md:px-0 flex flex-col md:flex-row gap-6 md:gap-24">
            <h2 class="semibold-28 md:semibold-36 text-center shrink-0" data-anim="title" data-delay="0.2" data-split="lines"><?= $section7['title'] ?></h2>
            <div class="toggle-main-container grow px-4 py-4 md:px-10 divide-y divide-midnight-50 bg-white rounded-2xl">
                <?php
                if (count($section7['faq'])) foreach ($section7['faq'] as $i => $faq) : ?>
                    <div class="toggle-row py-4 md:py-6 " data-anim="up" data-y="40" data-delay="<?= $i * 0.2 ?>">
                        <div class="toggle-tab  flex justify-between items-center w-full gap-2 cursor-pointer" data-tab="<?= $i ?>">
                            <h3 class="semibold-16 md:semibold-18 grow transition-all"><?= $faq['title'] ?></h3>
                            <i class="pixxelicon-chevron-down text-[0.5rem] shrink-0 transition-all"></i>
                        </div>
                        <div class="toggle-content regular-14 md:regular-16 pt-4 md:pt-6 hidden" data-tab="<?= $i ?>">
                            <?= $faq['content'] ?>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>

        </div>
    </section>
    <section class="py-10 md:py-[6.5rem]">
        <div class="container xl:max-w-screen-xl px-6 md:px-0 flex-center flex-col overflow-hidden">
            <h2 class="semibold-28 md:semibold-36 md:w-full text-center" data-anim="up" data-y="40" data-delay="0.2"><?= $section8['title'] ?></h2>
            <div class="flex flex-col md:flex-row divide-y divide-divider md:divide-y-0 md:divide-x md:divide-x-reverse mt-6 md:mt-14">
                <?php
                if (count($section8['items'])) foreach ($section8['items'] as $i => $item) : ?>
                    <div class="w-full flex flex-col gap-3 py-4 md:py-0 md:px-10" data-anim="horizontal" data-x="-40" data-delay="<?= $i * 0.2 ?>">
                        <i class="<?= $item['icon_name'] ?> text-[1.75rem] text-orange-main"></i>
                        <h3 class="semibold-18"><?= $item['title'] ?></h3>
                        <p class="regular-14"><?= $item['description'] ?></p>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </section>
</div>