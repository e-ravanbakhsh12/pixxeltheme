<?php

namespace PixxelTheme\templates\product;

use PixxelTheme\includes\comment\Comment;


wp_enqueue_style('pixxel-icon', PIXXEL_URL . '/assets/css/pixxelicon.css');
wp_enqueue_style('splide', PIXXEL_URL . '/assets/css/splide-core.min.css', [], '4.1.2');
// wp_enqueue_style('pixxel-glightbox', PIXXEL_URL . '/assets/css/glightbox.min.css', [], PIXXEL_VERSION);
// wp_enqueue_script('pixxel-glightbox', PIXXEL_URL . '/assets/js/glightbox.min.js', [], PIXXEL_VERSION, true);
// wp_enqueue_script('splide-grid', PIXXEL_URL . '/assets/js/splide-grid.min.js', [], '0.4.1', true);
wp_enqueue_script('splide', PIXXEL_URL . '/assets/js/splide.min.js', [], '4.1.2', true);
wp_enqueue_script('pixxel-product', PIXXEL_URL . '/assets/js/product.js', ['jquery', 'splide' ], PIXXEL_VERSION, true);

$_this = $args['_this'];
$price = get_field('price');
$gallery = get_field('gallery');
$properties = get_field('properties');
$productDetails = get_field('product_details');
$expert = get_field('expert');
$why = get_field('why');

?>
<div class="product-container relative">
    <div class="container xl:max-w-screen-xl px-6 md:px-0 pt-2">
        <div class="breadcrumb-list regular-12 text-midnight-700 flex items-center gap-1">
            <a href="<?= home_url() ?>" class="">خانه</a>
            <i class="pixxelicon-arrow-right-2 rotate-180 text-[.5rem]"></i>
            <a href="<?= home_url() ?>" class="">محصولات</a>
            <i class="pixxelicon-arrow-right-2 rotate-180 text-[.5rem]"></i>
            <div class=""><?= get_the_title() ?></div>
        </div>
    </div>
    <section class="pt-10 pb-8 md:pb-14">
        <div class="container xl:max-w-screen-xl px-6 md:px-0">
            <div class="grid grid-cols-1 md:grid-cols-3 md:gap-4">
                <div class="product-image">
                    <div id="product-img-list" class="splide splide-product-img relative" aria-label="Product Gallery">
                        <div class="splide__track">
                            <div class="splide__list">
                                <li class="splide__slide">
                                    <?= get_the_post_thumbnail(get_the_ID(), 'full', ['class' => 'w-full md:max-w-[18.375rem] w-full max-h-[21rem] md:max-h-[26rem] object-contain']) ?>

                                </li>
                                <?php if ($gallery) foreach ($gallery as $img) : ?>
                                    <li class="splide__slide">
                                        <?= wp_get_attachment_image($img, 'full', false, ['class' => 'w-full md:max-w-[18.375rem] w-full max-h-[21rem] md:max-h-[26rem] object-contain', 'loading' => "lazy"]) ?>
                                    </li>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                    <div class="thumbnails hidden md:flex flex-row flex-wrap gap-4 pt-3 w-full">
                    <?= get_the_post_thumbnail(get_the_ID(), 'full', ['class' => 'size-20 object-contain cursor-pointer border  border-blue-main rounded-2xl aspect-square transition-all', 'loading' => "lazy", 'data-item' => 0]) ?>
                        <?php if ($gallery) foreach ($gallery as $i => $img) : ?>
                            <?= wp_get_attachment_image($img, 'thumbnail', false, ['class' => 'size-20 object-contain cursor-pointer border opacity-50 border-midnight-50 rounded-2xl aspect-square transition-all', 'loading' => "lazy", 'data-item' => $i+1]) ?>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="w-full">
                    <h1 class="semibold-18 md:bold-24 "><?= get_the_title() ?></h1>
                    <div class="divider h-[1px] w-full bg-midnight-50 my-6"></div>
                    <div class="flex items-center gap-4 regular-14 md:regular-16">
                        <div class="flex items-center gap-1">
                            <i class="pixxelicon-start"></i>
                            4.5
                        </div>
                        <div class="text-blue-main"><span>5</span>دیدگاه</div>
                    </div>
                    <div class="flex flex-col gap-3 md:gap-4 pt-6">
                        <h3 class="semibold-14 md:semibold-16">مشخصات</h3>
                        <div class="flex flex-col gap-2 regular-14 md:regular-16">
                            <div class="flex items-center gap-4">
                                <div class="w-[7.5rem] text-midnight-700">مناسب پوست</div>
                                <div class="grow"><?= $properties['skin_type'] ?></div>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="w-[7.5rem] text-midnight-700">SPF</div>
                                <div class="grow"><?= $properties['spf'] ?></div>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="w-[7.5rem] text-midnight-700">رنگ</div>
                                <div class="grow"><?= $properties['skin_color'] ?></div>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="w-[7.5rem] text-midnight-700">جنسیت</div>
                                <div class="grow"><?= $properties['gender']['label'] ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-3 md:gap-4 pt-6">
                        <h3 class="semibold-14 md:semibold-16">معرفی کوتاه</h3>
                        <p class="regular-14 md:regular-16 text-midnight-700 text-justify">کرم ضدآفتاب بدون رنگ مناسب پوست‌های خشک تا نرمال و حساس با SPF50  می‌باشد، دارای خاصیت ضدپیری پوست، حاوی اوسرین، هیالورونیک اسید، آنتی اکسیدان، ویتامین  B3، B5 می‌باشد که به حفظ </p>
                    </div>
                </div>
                <div class="pt-6 md:pt-0">
                    <div class="bg-light-blue rounded-3xl p-3 md:p-6">
                        <h3 class="semibold-14 md:semibold-16">رنگ</h3>
                        <div class="flex items-center gap-3 pt-3">
                            <div class="size-8 rounded-full bg-p-green relative flex-center">
                                <i class="pixxelicon-check hidden text-white flex-center size-3 rounded-full bg-blue-main  text-[0.25rem] "></i>
                            </div>
                            <div class="size-8 rounded-full bg-p-beige"></div>
                            <div class="size-8 rounded-full bg-p-purple"></div>
                        </div>
                        <p class="pt-6 md:pt-10">توضیحات کوتاه یا آیتم کوتاه</p>
                        <div class="price-container w-full flex items-center justify-between gap-4 semibold-14 md:semibold-16 pt-8 md:pt-11">
                            قیمت محصول
                            <div class=""><?= number_format($price, 0, '', ',') ?> <span>تومان</span></div>
                        </div>
                        <a class="flex-center w-full h-10 rounded-full bg-blue-main text-white gap-2 px-4 mt-4 md:mt-6 transition-all">افزودن به سبد خرید</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="">
        <div class="container xl:max-w-screen-xl px-6 md:px-0">
            <div class="w-full md:w-2/3 py-8 md:py-14 border-y border-midnight-50 grid grid-cols-1 md:grid-cols-2 md:gap-4">
                <h2 class="semibold-22 md:semibold-28">جزئیات محصول</h2>
                <div class="flex flex-col divide-y divide-midnight-50 regular-14 md:regular-16">
                    <?php if ($productDetails) foreach ($productDetails as $detail) : ?>
                        <div class="flex items-center gap-4 w-full py-3 md:py-4">
                            <div class="w-32 line-clamp-1 text-midnight-700"><?= $detail['title'] ?></div>
                            <div class="w-grow line-clamp-1"><?= $detail['value'] ?></div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="w-full md:w-2/3 pt-8 md:pt-14">
                <h2 class="semibold-22 md:semibold-28">معرفی محصول</h2>
                <div class="pixxel-post-content py-6 md:py-8">
                    <?= get_the_content() ?>
                </div>
            </div>
    </section>
    <section class="py-10 md:py-[6.5rem] bg-light-blue">
        <div class="container xl:max-w-screen-xl px-6 md:px-0 flex-center flex-col">
            <h2 class="semibold-28 md:semibold-36 md:w-full text-center"><?= $expert['title'] ?></h2>
            <div id="consultant-gallery" class="splide consultant-slider w-full relative pt-6 md:pt-8" aria-label="consultant Gallery">
                <div class="splide__track">
                    <div class="splide__list">
                        <?php if ($expert['expert'])
                            foreach ($expert['expert'] as $expert) : ?>
                            <li class="splide__slide bg-white overflow-hidden rounded-2xl group-1 ">
                                <div class="w-[17.5rem] md:w-full flex-center flex-col relative p-3 md:p-6">
                                    <?= wp_get_attachment_image($expert['img'], 'full', false, ['class' => 'size-[10rem] rounded-full object-cover', 'loading' => "lazy"]) ?>
                                    <h3 class="semibold-16 md:semibold-22 pt-3 md:pt-4"><?= $expert['name'] ?></h3>
                                    <p class="regular-14 md:regular-16 md:pt-2"><?= $expert['level'] ?></p>
                                    <div class="w-full h-[1px] bg-midnight-50"></div>
                                    <p class="text-center  regular-12 md:regular-14"><?= $expert['description'] ?></p>
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
        <div class="container xl:max-w-screen-xl px-6 md:px-0 flex-center flex-col">
            <h2 class="semibold-28 md:semibold-36 md:w-full text-center"><?= $why['title'] ?></h2>
            <div class="flex flex-col md:flex-row divide-y divide-divider md:divide-y-0 md:divide-x md:divide-x-reverse mt-6 md:mt-14">
                <?php
                if (count($why['items'])) foreach ($why['items'] as $item) : ?>
                    <div class="w-full flex flex-col gap-3 py-4 md:py-0 md:px-10">
                        <i class="<?= $item['icon_name'] ?> text-[1.75rem] text-orange-main"></i>
                        <h3 class="semibold-18"><?= $item['title'] ?></h3>
                        <p class="regular-14"><?= $item['description'] ?></p>
                    </div>
                <?php endforeach ?>
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