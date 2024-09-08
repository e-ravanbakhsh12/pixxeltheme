<?php

namespace PixxelTheme\templates\aboutUs;

wp_enqueue_style('pixxel-leaflet', PIXXEL_URL . '/assets/css/leaflet.css', [], '1.9.2');
wp_enqueue_script('pixxel-leaflet', PIXXEL_URL . '/assets/js/leaflet.min.js', array('jquery'), '1.9.2', true);
wp_enqueue_script('pixxel-about-us', PIXXEL_URL . '/assets/js/about-us.js', array('jquery', 'pixxel-global-js', 'pixxel-leaflet'), PIXXEL_VERSION, true);

$class = $args['_this'];
$section1 = get_field('section_1');
$section2 = get_field('section_2');
$section3 = get_field('section_3');
?>
<div class="about-us-container relative">
    <div class="container xl:max-w-screen-xl px-6 md:px-0 pt-2">
        <div class="breadcrumb-list regular-12 text-midnight-700 flex items-center gap-1">
            <a href="<?= home_url() ?>" class="">خانه</a>
            <i class="pixxelicon-arrow-right-2 rotate-180 text-[.5rem]"></i>
            <div class=""><?= get_the_title() ?></div>
        </div>
    </div>
    <section class="container xl:max-w-screen-xl py-10 md:py-16 px-6 md:px-0 flex flex-col md:flex-row items-center gap-6 md:gap-16 md:justify-between overflow-hidden">
        <div class="flex-1" data-anim="horizontal" data-x="40" data-delay="0.2">
            <h1 class="semibold-28 md:semibold-36"><?= $section1['title'] ?></h1>
            <p class="regular-14 md:regular-16 text-justify pt-6"><?= $section1['description'] ?></p>
        </div>
        <?= wp_get_attachment_image($section1['img'], 'full', false, ['class' => ' flex-1 w-full h-[22.5rem] object-cover rounded-2xl','data-anim'=>"horizontal" ,'data-x'=>"-40", 'data-delay'=>"0.2"]) ?>
    </section>
    <section class="bg-light-blue py-10 md:py-16">
        <div class="container xl:max-w-screen-xl px-6 md:px-0 flex flex-col md:flex-row items-center gap-6 md:gap-16 md:justify-between overflow-hidden">
            <div class="flex-1 md:order-2" data-anim="horizontal" data-x="-40" data-delay="0.2">
                <h2 class="semibold-28 md:semibold-36"><?= $section2['title'] ?></h2>
                <p class="regular-14 md:regular-16 text-justify pt-6"><?= $section2['description'] ?></p>
            </div>
            <?= wp_get_attachment_image($section2['img'], 'full', false, ['class' => 'md:order-1 flex-1 w-full h-[22.5rem] object-cover rounded-2xl','data-anim'=>"horizontal" ,'data-x'=>"40", 'data-delay'=>"0.2"]) ?>
        </div>
    </section>
    <section class="container xl:max-w-screen-xl py-10 md:py-16 px-6 md:px-0 flex flex-col md:flex-row gap-8 md:gap-16 md:justify-between" data-anim="up" data-y="40" data-delay="0.6">
        <div class="flex-1" >
            <h2 class="semibold-28 md:semibold-36 mb-6">ارسال پیام</h2>
            <?= do_shortcode($section3['form_shortcode']) ?>
        </div>
        <div class="flex-1" >
            <h2 class="semibold-28 md:semibold-36">راه های ارتباطی</h2>
            <div id="pixxel-map" class="pixxel-map relative w-full  h-[13.75rem] md:h-[16.25rem] flex flex-col mt-6 rounded-2xl border-2 border-transparent md:border-midnight-50 !font-sans transition-all" data-lat="<?= $section3['lat'] ?>" data-lng="<?= $section3['lng'] ?>">
                <div class="navigator-box hidden flex-col gap-2 text-midnight-700 z-[999] text-2xl font-bold bottom-28 md:bottom-4 right-4 absolute">
                    <div class="flex flex-col w-10 h-20 rounded-lg justify-center items-center  bg-midnight-700/30 backdrop-blur-sm">
                        <i class="pixxelicon-positive zoom-in flex w-8 h-10 justify-center items-center cursor-pointer border-b border-b-midnight-700"></i>
                        <i class="pixxelicon-negative zoom-out flex w-8 h-10   justify-center items-center cursor-pointer"></i>
                    </div>
                    <i class="pixxelicon-current-location current-location w-10 h-10 bg-midnight-700/30 hidden flex justify-center items-center rounded-lg cursor-pointer backdrop-blur-sm "></i>
                </div>
            </div>
            <div class="flex items-center gap-4 md:gap-5 pt-6">
                <i class="pixxelicon-location text-3xl"></i>
                <span class="w-[1px] h-6 bg-midnight-50"></span>
                <div class="flex flex-col gap-2">
                    <h3 class="semibold-16 md:semibold-18">آدرس ما</h3>
                    <p class="regular-14 md:regular-16 text-midnight-700"><?= $section3['address'] ?></p>
                </div>
            </div>
            <div class="flex items-center gap-4 md:gap-5 pt-6 md:pt-4">
                <i class="pixxelicon-phone text-3xl"></i>
                <span class="w-[1px] h-6 bg-midnight-50"></span>
                <div class="flex flex-col md:flex-row md:justify-between grow gap-8 md:gap-4">
                    <div class="flex flex-col gap-2">
                        <h3 class="semibold-16 md:semibold-18">تلفن</h3>
                        <p class="regular-14 md:regular-16 text-midnight-700"><?= $section3['phone'] ?></p>
                    </div>
                    <div class="flex items-center gap-4 w-full md:w-auto text-blue-main text-xl justify-center md:justify-end">
                        <a href="https://www.instagram.com/pixxel.iran/"><i class="pixxelicon-instagram size-12 flex-center rounded-full bg-light-blue"></i></a>
                        <a href="https://t.me/Pixxelskinexpert"><i class="pixxelicon-telegram size-12 flex-center rounded-full bg-light-blue"></i></a>
                        <a href="https://www.linkedin.com/company/pixxelskinexpert/"><i class="pixxelicon-linkedin size-12 flex-center rounded-full bg-light-blue"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>