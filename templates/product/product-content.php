<?php

namespace PixxelTheme\templates\product;

use WP_Query;
use PixxelTheme\includes\Api;
use PixxelTheme\includes\comment\Comment;


wp_enqueue_style('labell-icon', PIXXEL_URL . '/assets/css/labellicon.css');
wp_enqueue_style('splide', PIXXEL_URL . '/assets/css/splide-core.min.css', [], '4.1.2');
wp_enqueue_style('labell-glightbox', PIXXEL_URL . '/assets/css/glightbox.min.css', [], PIXXEL_VERSION);
wp_enqueue_script('labell-glightbox', PIXXEL_URL . '/assets/js/glightbox.min.js', [], PIXXEL_VERSION, true);
wp_enqueue_script('splide-grid', PIXXEL_URL . '/assets/js/splide-grid.min.js', [], '0.4.1', true);
wp_enqueue_script('splide', PIXXEL_URL . '/assets/js/splide.min.js', [], '4.1.2', true);
wp_enqueue_script('labell-product', PIXXEL_URL . '/assets/js/product.js', ['jquery', 'splide', 'splide-grid', 'labell-glightbox'], PIXXEL_VERSION, true);

$class = $args['class'];
$sliders = \get_field('slider');
$properties = \get_field('properties');
$requestSteps = [
    [
        'icon' => 'pixxelicon-request',
        'title' => 'ثبت درخواست سفارش',
    ],
    [
        'icon' => 'pixxelicon-support',
        'title' => 'تماس کارشناسان جهت مشاوره و اعلام قیمت',
    ],
    [
        'icon' => 'pixxelicon-roof',
        'title' => 'انتخاب نوع سقف مورد نظر و تولید آن',
    ],
    [
        'icon' => 'pixxelicon-install',
        'title' => 'ارسال و نصب سقف لابل',
    ],
];
$info = \get_field('info');
$samples = \get_field('sample');
$testimonials = \get_field('testimonials');
$roofType = ['گلکسی', 'اپلای', 'چاپی uv', 'چاپی eco', 'ساده مات', 'لاکر', 'ترنسپرنت'];
$light = ['backlight', 'نقطه ای', 'خطی', 'فیبر نوری'];
$calculate = \get_field('calculate');
$titles = \get_field('titles');

$relatedProductArgs = [
    'post_type' => 'product',
    'posts_per_page' => -1,
    'post__not_in' => [get_the_ID()], // Exclude the current product
];
$relatedProduct = new WP_Query($relatedProductArgs);

$api = new Api();
$states  = $api->getDependencies('states');
unset($states[count($states) - 1]);
?>
<div class="main-container bg-gray-1 relative">

    <section class="relative pt-[4.5rem] md:pt-36 pb-44 md:pb-0 bg-white">

        <div class="container xl:max-w-screen-xl px-3 md:px-0 ">
            <div class="py-4 mx-3 mb-6 breadcrumb caption md:overline-font md:mx-0">
                <ul id="labell-breadcrumbs " class="flex gap-1 text-xs md:text-sm text-magenta">
                    <li class="item-home shrink-0"><a class=" transition-all bread-link bread-home hover:text-hunter-green-800 " href="<?= get_home_url() ?>" title="لابل">لابل</a></li>
                    <li class="flex items-start justify-center md:items-center separator-home "> / </li>
                    <li class="item-home shrink-0"><a class=" transition-all bread-link hover:text-hunter-green-800 " href="<?= get_post_type_archive_link('product') ?>" title="انواع سقف">انواع سقف</a></li>
                    <li class="flex items-start justify-center md:items-center "> /</i> </li>
                    <li class="flex items-center justify-center text-hunter-green-800 text-gray-3"><?= get_the_title() ?></li>
                </ul>
            </div>
            <div class="flex flex-col md:flex-row gap-7 md:gap-14 relative">
                <div class="md:w-1/2 md:mt-10">
                    <h1 class="text-3xl md:text-[2.5rem] font-bold text-magenta"><?= get_the_title() ?></h1>
                    <p class="text-xs md:text-base font-medium md:font-normal mt-10 md:mt-8 text-justify"><?= get_the_content() ?></p>
                    <button class="h-12 w-full md:w-auto flex items-center justify-center gap-2 px-4 text-sm  md:text-xl font-bold border bg-magenta text-white mt-6 popup md:mb-36">
                        دریافت مشاوره رایگان
                        <i class="pixxelicon-Left-arrow text-xl"></i>
                    </button>
                </div>
                <div class="h-[24rem] object-fill md:w-1/2 md:max-w-[39rem] md:h-[39rem] absolute top-full md:top-0 left-0 px-3 md:px-0">
                    <div id="slider-gallery" class="splide splide-slider relative w-full mt-5 md:mt-0" aria-label="Slider Gallery">
                        <div class="splide__track">
                            <div class="splide__list">
                                <?php foreach ($sliders as $slide) : ?>
                                    <li class="splide__slide relative group-1 flex-center">
                                        <?= wp_get_attachment_image($slide['image']['id'], 'full', false, ['class' => 'w-full h-[24rem]  md:h-[39rem] object-cover']) ?>
                                        <i class="pixxelicon-corner absolute -bottom-1 md:bottom-3 left-0 text-gray-1 text-3xl md:text-[4rem]"></i>
                                    </li>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <div class="splide__arrows flex items-center justify-center gap-4">
                            <button class="splide__arrow splide__arrow--prev absolute -right-3 md:-right-5 top-1/2 translate-y-1/2 text-sm size-9 flex-center text-dusty-gray bg-gray-1 hover:bg-magenta hover:text-white transition-all">
                                <i class="pixxelicon-Left-arrow flex-center rotate-180"></i>
                            </button>
                            <button class="splide__arrow splide__arrow--next absolute -left-3 md:-left-5 top-1/2 translate-y-1/2 text-sm size-9 flex-center text-dusty-gray bg-gray-1 hover:bg-magenta hover:text-white transition-all">
                                <i class="pixxelicon-Left-arrow flex-center"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="mt-[19.375rem] md:mt-[17.25rem] container xl:max-w-screen-xl px-3 md:px-0">
        <h2 class="text-[1.375rem] md:text-[1.75rem] font-bold flex items-baseline  gap-2">
            <i class="pixxelicon-shape text-base text-magenta"></i>
            <?= isset($titles['properties-title']) ? $titles['properties-title'] : 'ویژگی های ' . get_the_title() ?>
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-10 md:mt-8">
            <?php foreach ($properties as $property) : ?>
                <div class="flex items-center gap-2">
                    <i class="pixxelicon-<?= $property['icon'] ?> text-magenta flex-center size-12 bg-white rounded-full text-2xl"></i>
                    <h4 class="font-bold text-sm"><?= $property['title'] ?></h4>
                </div>
            <?php endforeach ?>
        </div>
    </section>

    <section class="container xl:max-w-screen-xl  mt-[4.5rem] md:mt-[11rem]">
        <div class="mx-4 md:mx-0 bg-white py-12 px-5 md:p-12 relative z-10">
            <h2 class="text-[1.375rem] md:text-[1.75rem] font-bold flex items-baseline  gap-2">
                <i class="pixxelicon-shape text-base text-magenta"></i>
                نحوه ثبت درخواست
            </h2>
            <div class="flex flex-col md:flex-row md:items-center justify-evenly my-8 gap-4 md:gap-0">
                <?php foreach ($requestSteps as $i => $step) : ?>
                    <div class="flex md:flex-col items-center gap-4 md:max-w-[13.5rem]">
                        <div class="logo-container relative">
                            <i class="pixxelicon-shape-2 text-purple-1 opacity-50 text-3xl md:text-4xl absolute right-0 bottom-0 z-0"></i>
                            <i class="<?= $step['icon'] ?> text-4xl md:text-5xl relative z-10"></i>
                        </div>
                        <p class="text-sm font-medium md:text-base md:text-center"><?= $step['title'] ?></p>
                    </div>
                    <img src="<?= PIXXEL_URL . '/assets/img/home/arrow-desktop.svg' ?>" alt="" class="hidden md:block w-[4.75rem] object-contain right-0 <?= $i + 1 === count($requestSteps) ? 'md:hidden' : '' ?>">
                    <img src="<?= PIXXEL_URL . '/assets/img/home/arrow-mobile.svg' ?>" alt="" class=" md:hidden h-8 w-fit object-contain pr-4 <?= $i + 1 === count($requestSteps) ? 'hidden' : '' ?>">
                <?php endforeach ?>
            </div>
            <button class="h-12 flex items-center justify-center gap-2 px-4 md:text-xl font-black  border-2 border-gray-3 text-gray-3 mt-4 md:mt-6 popup mx-auto">
                ثبت سفارش
                <i class="pixxelicon-Left-arrow text-xl"></i>
            </button>
        </div>
    </section>
    <section class="mt-[4.5rem] md:mt-28  bg-light-gray-3">
        <div class="container xl:max-w-screen-xl py-8 px-3 md:px-0 md:py-20">
            <div class="flex flex-col md:flex-row gap-6 md:gap-16">
                <div class="relative h-[23rem] w-full md:max-w-[34.125rem] md:h-[35.75rem]">
                    <?= wp_get_attachment_image($info['image']['id'], 'full', false, ['class' => 'w-full h-full object-cover']) ?>
                    <i class="pixxelicon-corner absolute -bottom-1 md:bottom-3 left-0 text-light-gray-3 text-3xl md:text-[4rem]"></i>
                </div>
                <div class="flex flex-col gap-4 md:gap-10">
                    <?php if (is_array($info['section'])) foreach ($info['section'] as $section) : ?>
                        <div class="">
                            <h3 class="flex items-baseline gap-2 text-[1.375rem] md:text-[1.75rem] font-bold">
                                <i class="pixxelicon-shape text-base text-magenta "></i>
                                <?= $section['title'] ?>
                            </h3>
                            <p class="text-sm md:text-base font-medium mt-3 md:mt-6"> <?= $section['description'] ?></p>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </section>
    <section class="  mt-[4.5rem] md:mt-28">
        <div class="container xl:max-w-screen-xl px-3 md:px-0">
            <h2 class="text-[1.375rem] md:text-[1.75rem] font-bold flex items-baseline  gap-2">
                <i class="pixxelicon-shape text-base text-magenta"></i>
                <?= isset($titles['samples-title']) ? $titles['samples-title'] : 'تصاویری از ' . get_the_title() . ' لابل' ?>
            </h2>
            <div id="sample-gallery" class="splide splide-sample relative w-full mt-6" aria-label="Sample Gallery">
                <div class="splide__track">
                    <div class="splide__list">
                        <?php foreach ($samples as $sample) : ?>
                            <li class="splide__slide relative group-1 flex-center cursor-pointer">
                                <?= wp_get_attachment_image($sample['image']['id'], 'full', false, ['class' => 'w-full h-full object-cover glightbox gallery-item', 'data-gallery'=>'gallery1']) ?>
                                <div class="cover opacity-0 group-1-hover:opacity-20 absolute w-full h-full transition-all bg-magenta "></div>
                                <h4 class="text-xs px-2 py-1 bg-white group-1-hover:bg-magenta group-1-hover:text-white transition-all absolute top-2 right-2 "><?= $sample['title'] ?></h4>
                            </li>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="splide__arrows flex items-center justify-center gap-4 mt-7 md:mt-4">
                    <button class="splide__arrow splide__arrow--prev  text-sm size-9 flex-center text-dusty-gray bg-white hover:bg-magenta hover:text-white transition-all">
                        <i class="pixxelicon-Left-arrow flex-center rotate-180"></i>
                    </button>
                    <button class="splide__arrow splide__arrow--next text-sm size-9 flex-center text-dusty-gray bg-white hover:bg-magenta hover:text-white transition-all">
                        <i class="pixxelicon-Left-arrow flex-center"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>
    <section class="mt-[4.5rem] md:mt-28">
        <div class="container xl:max-w-screen-xl px-3 md:px-0 flex flex-col md:flex-row md:items-center">
            <?= wp_get_attachment_image($calculate['image'], 'full', false, ['class' => 'w-full h-[17.5rem] md:w-[60%] md:h-[42.5rem] object-cover relative z-0 md:order-2']) ?>
            <div class="w-full md:w-1/2">
                <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data" class="calculate-form md:w-[120%] -mt-16 md:mt-0 bg-white px-3 mx-2 md:mx-0 py-4 md:p-12 md:order-1 relative right-0 z-10">
                    <h2 class="text-[1.375rem] md:text-[1.75rem] font-bold flex items-baseline  gap-2">
                        <i class="pixxelicon-shape text-base text-magenta"></i>
                        <?= isset($titles['calculate-title']) ? $titles['calculate-title'] : 'نحوه محاسبه قیمت ' . get_the_title() . ' لابل' ?>
                    </h2>
                    <input type="hidden" name="leadsourceid" value="11" />
                    <input type="hidden" name="leadcatid" value="5" />
                    <div class="flex flex-col gap-6 w-full mt-6 md:mt-8">
                        <div class="flex flex-col w-full md:flex-row  gap-6 md:gap-3">
                            <div class="w-full text-sm">
                                <label>نام</label>
                                <div class="flex items-center relative">
                                    <input type="text" class="text-gray-4 text-sm p-3 pl-6 border border-gray-4 w-full outline-none focus:border-magenta transition-all mt-1" name="leadfn" id="calc-first-name">
                                </div>
                            </div>
                            <div class="w-full text-sm">
                                <label>نام خانوادگی</label>
                                <div class="flex items-center relative">
                                    <input type="text" class="text-gray-4 text-sm p-3 pl-6 border border-gray-4 w-full outline-none focus:border-magenta transition-all mt-1" name="leadln" id="calc-last-name" required>
                                </div>
                            </div>
                        </div>
                        <div class="w-full text-sm">
                            <label>شماره تلفن همراه</label>
                            <div class="flex items-center relative">
                                <input type="text" maxlength="11" class="phone-number text-gray-4 text-sm p-3 pl-6 border border-gray-4 w-full outline-none focus:border-magenta transition-all mt-1" name="leadcell" id="calc-phone-number" inputmode="numeric" required>
                            </div>
                        </div>
                        <div class="flex flex-col w-full md:flex-row  gap-6 md:gap-3">
                            <div class="w-full text-sm">
                                <label>نوع سقف </label>
                                <div class="flex items-center relative">
                                    <select class="text-gray-4 text-sm p-3 pl-6 border border-gray-4 w-full outline-none focus:border-magenta transition-all mt-1" id='roof-type' name="sctype" required>
                                        <option value="0">انتخاب کنید</option>
                                        <?php foreach ($roofType as $option) : ?>
                                            <option value="<?= $option ?>"><?= $option ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <i class="pixxelicon-chevron-down1 text-[0.375rem] absolute left-3 transition-all "></i>
                                </div>
                            </div>
                            <div class="w-full text-sm">
                                <label>متراژ(به متر)</label>
                                <div class="flex items-center relative">
                                    <input type="text" maxlength="5" class="input-number text-gray-4 text-sm p-3 pl-6 border border-gray-4 w-full outline-none focus:border-magenta transition-all mt-1" name="quantity" id="meterage" required inputmode="numeric">
                                </div>
                            </div>
                        </div>
                        <div class="w-full text-sm">
                            <label>نورپردازی</label>
                            <div class="flex items-center relative">
                                <select class="text-gray-4 text-sm p-3 pl-6 border border-gray-4 w-full outline-none focus:border-magenta transition-all mt-1" id='light' name="lighting" required>
                                    <option value="0">انتخاب کنید</option>
                                    <?php foreach ($light as $option) : ?>
                                        <option value="<?= $option ?>"><?= $option ?></option>
                                    <?php endforeach ?>
                                </select>
                                <i class="pixxelicon-chevron-down1 text-[0.375rem] absolute left-3 transition-all "></i>
                            </div>
                        </div>
                        <div class="form-success hidden">
                            <p class="p-3 rounded-lg text-sm text-green-800 bg-green-100 my-2"></p>
                        </div>
                        <div class="form-error hidden">
                            <p class="p-3 rounded-lg text-sm text-red-800 bg-red-100 my-2"></p>
                        </div>
                        <button type="submit" class="submitformbutton w-full flex items-center justify-center gap-2 font-bold text-xl h-14 text-white bg-magenta">
                            <svg class="w-6 h-6 fill-magenta animate-spin hidden">
                                <use href="#loading-spinner"></use>
                            </svg>
                            دریافت قیمت
                            <i class="pixxelicon-Left-arrow text-xl"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section class="mt-[4.5rem] md:mt-28">
        <div class="container xl:max-w-screen-xl px-3 md:px-0 flex flex-col md:items-center">
            <h2 class="text-[1.375rem] md:text-[1.75rem] font-bold flex items-baseline  gap-2 ">
                <i class="pixxelicon-shape text-base text-magenta"></i>
                <?= isset($titles['services-title']) ? $titles['services-title'] : 'خدمات پس از فروش لابل' ?>
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 items-center md:items-start gap-12 md:gap-4 mt-12 w-full">
                <div class="relative bg-white p-4 md:p-6 h-full ">
                    <h3 class="md:text-xl font-bold mx-auto text-center">اعزام نصاب متخصص</h3>
                    <p class="text-sm mt-2 md:mt-4">به علت تخصصی بودن عملیات نصب سقف‌های لابل، پس از سفارش و هماهنگی با شما، نصاب متخصص نیز از طرف شرکت اعزام خواهد شد.</p>
                    <div class=" size-[4.5rem] md:size-[5.5rem] flex-center bg-purple-2 text-magenta text-4xl md:text-5xl absolute -top-8 right-4 md:right-6">
                        <i class="pixxelicon-installer"></i>
                        <i class="pixxelicon-corner absolute -top-1 right-0 text-gray-1 text-xl rotate-180"></i>
                        <i class="pixxelicon-corner absolute -bottom-1 left-0 text-white text-xl"></i>
                    </div>
                </div>
                <div class="relative bg-white p-4 md:p-6 h-full">
                    <h3 class="md:text-xl font-bold mx-auto text-center">گارانتی ۱۲ ساله</h3>
                    <p class="text-sm mt-2 md:mt-4">به علت استفاده از بهترین متریال‌های اروپایی، تمامی محصولات لابل شامل 12 سال گارانتی و تضمین کیفیت هستند.</p>
                    <div class=" size-[4.5rem] md:size-[5.5rem] flex-center bg-purple-2 text-magenta text-4xl md:text-5xl absolute -top-8 right-4 md:right-6">
                        <i class="pixxelicon-warranty"></i>
                        <i class="pixxelicon-corner absolute -top-1 right-0 text-gray-1 text-xl rotate-180"></i>
                        <i class="pixxelicon-corner absolute -bottom-1 left-0 text-white text-xl"></i>
                    </div>
                </div>
                <div class="relative bg-white p-4 md:p-6 h-full">
                    <h3 class="md:text-xl font-bold mx-auto text-center">خدمات حضوری</h3>
                    <p class="text-sm mt-2 md:mt-4">جهت حل مشکلات احتمالی و همچنین نصب تجهیزات مورد نیاز شما، خدمات حضوری توسط متخصصین و کارشناسان ما انجام خواهد شد.</p>
                    <div class=" size-[4.5rem] md:size-[5.5rem] flex-center bg-purple-2 text-magenta text-4xl md:text-5xl absolute -top-8 right-4 md:right-6">
                        <i class="pixxelicon-live-location"></i>
                        <i class="pixxelicon-corner absolute -top-1 right-0 text-gray-1 text-xl rotate-180"></i>
                        <i class="pixxelicon-corner absolute -bottom-1 left-0 text-white text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php if (comments_open()) : ?>
        <section class="container xl:max-w-screen-xl  mt-16 md:mt-28">
            <div class="mx-4 md:mx-0 ">
                <div class="bg-white p-4 md:p-10 relative">
                    <?php

                    $comment = new Comment();
                    $comment->generateCustomComment(get_the_ID());
                    ?>
                    <i class="pixxelicon-corner absolute -bottom-1 right-0 -rotate-90 text-3xl md:text-5xl text-gray-1"></i>
                </div>
            </div>
        </section>
    <?php endif ?>
    <section class="container xl:max-w-screen-xl  mt-16 md:mt-28">
        <div class="mx-4 md:mx-0 ">
            <h2 class="text-[1.375rem] md:text-[1.75rem] font-bold flex items-baseline  gap-2 mb-4 md:-mb-10">
                <i class="pixxelicon-shape text-base text-magenta"></i>
                <?= isset($titles['comments-title']) ? $titles['comments-title'] : 'نظرات کاربران درباره سقف لابل' ?>
            </h2>
            <div class="flex flex-col md:flex-row md:flex-wrap">
                <div id="testimonial-gallery" class="splide splide-testimonial relative" aria-label="Testimonial Gallery">
                    <div class="splide__track">
                        <div class="splide__list">
                            <?php foreach ($testimonials as  $i => $item) :
                                $imageClass = [
                                    'class' => 'w-full h-full object-cover',
                                ];
                                if ($i > 0) $imageClass['loading'] = 'lazy';
                            ?>
                                <li class="splide__slide relative group-1 grid grid-cols-1 md:grid-cols-2">
                                    <div class="w-full h-[12.5rem] md:h-[21.75rem] md:order-2 relative">
                                        <?= wp_get_attachment_image($item['image'], 'full', false, $imageClass) ?>
                                        <i class="pixxelicon-corner absolute -top-1 md:top-3 right-0 text-gray-1 text-3xl md:text-[4rem] rotate-180"></i>
                                        <i class="pixxelicon-qout text-magenta hidden md:block  -right-[25%] bottom-[28%] text-8xl absolute"></i>

                                    </div>
                                    <div class="w-full md:order-1">
                                        <div class="flex flex-col w-full md:w-[130%] bg-white relative px-6 py-10 md:px-14 md:py-[4.5rem] mt-4 md:mt-[14.25rem] z-10">
                                            <i class="pixxelicon-qout text-magenta  left-2 top-0 md:hidden md:-top-20 md:left-1/3 text-[2.625rem] md:text-8xl absolute z-0"></i>
                                            <div class="flex items-baseline gap-1 md:text-2xl ">
                                                <h3 class=" font-bold pr-2 border-r-8 border-magenta"><?= $item['name'] ?></h3>
                                                <i class="pixxelicon-shape text-[5px] text-main-gray"></i>
                                                <p class="text-main-gray">مشتری</p>
                                            </div>
                                            <p class="mt-4 text-sm md:text-base"><?= $item['comment'] ?></p>
                                            <div class="flex items-center gap-2 text-xl text-magenta mt-4">
                                                <?php for ($i = 1; $i < 6; $i++) : ?>
                                                    <i class="pixxelicon-star<?= $i <= $item['rate'] ? '-fill' : '' ?>"></i>
                                                <?php endfor ?>
                                            </div>
                                            <i class="pixxelicon-corner absolute -bottom-1 md:bottom-3 left-0 text-gray-1 text-3xl md:text-[4rem] r"></i>

                                        </div>

                                    </div>

                                </li>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="splide__arrows flex items-center justify-center gap-4 md:absolute md:left-0 md:bottom-28 mt-4 md:mt-0">
                        <button class="splide__arrow splide__arrow--prev text-sm size-9 flex-center text-dusty-gray bg-white hover:bg-magenta hover:text-white transition-all">
                            <i class="pixxelicon-Left-arrow flex-center rotate-180"></i>
                        </button>
                        <button class="splide__arrow splide__arrow--next text-sm size-9 flex-center text-dusty-gray bg-white hover:bg-magenta hover:text-white transition-all">
                            <i class="pixxelicon-Left-arrow flex-center"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    $faqs = get_field('faq');
    if ($faqs) : ?>
        <section class="container xl:max-w-screen-xl px-3 md:px-0  mt-[4.5rem] md:mt-28">
            <h2 class="text-[1.375rem] md:text-[1.75rem] font-bold flex items-baseline  gap-2">
                <i class="pixxelicon-shape text-base text-magenta"></i>
                سوالات متداول
            </h2>
            <div class="toggle-list flex flex-col gap-1 mt-4 md:mt-8">
                <?php if (is_array($faqs)) foreach ($faqs as $i => $faq) : ?>
                    <div class="toggle-container bg-white  p-4 md:py-8" tab="<?= $i ?>">
                        <div class="faq-tab-item flex w-full items-center justify-between gap-2 bg-white font-bold cursor-pointer">
                            <?= $faq['title'] ?>
                            <i class="pixxelicon-chevron-down1 text-[0.5rem] flex-center transition-all"></i>
                        </div>
                        <div class="faq-tab-content whitespace-pre-line hidden  bg-white border-t border-mid-50 pt-3 md:pt-4 mt-3 md:mt-4 text-xs md:text-sm font-medium ">
                            <?= $faq['description'] ?>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </section>
    <?php endif ?>
    <?php
    $seoBox = \get_field('seoBox');
    if ($relatedProduct->have_posts()) :
    ?>
        <section class="container xl:max-w-screen-xl  mt-[4.5rem] md:mt-28 <?= $seoBox ? '' : 'pb-[4.5rem] md:pb-44' ?>">
            <div class="mr-4 md:mr-0 relative z-10">
                <h2 class="text-[1.375rem] md:text-[1.75rem] font-bold flex items-baseline  gap-2">
                    <i class="pixxelicon-shape text-base text-magenta"></i>
                    محصولات دیگر
                </h2>
                <div id="related-product-gallery" class="splide splide-related-product relative mt-6" aria-label="Related Product Gallery">
                    <div class="splide__track">
                        <div class="splide__list">
                            <?php foreach ($relatedProduct->posts as $product) : ?>
                                <li class="splide__slide ">
                                    <a href="<?= get_permalink($product->ID) ?>" class="relative group-1 flex-center">
                                        <?= get_the_post_thumbnail($product->ID, 'full', ['class' => 'w-full object-cover object-top h-40 md:h-[17.5rem]']) ?>
                                        <div class="w-full h-full absolute inset-0 bg-black-cover group-1-hover:opacity-0 transition-all"></div>
                                        <h4 class="text-base md:text-lg font-bold md:text-[1.625rem] text-white absolute text-center"><?= $product->post_title ?></h4>
                                        <i class="pixxelicon-corner absolute -bottom-1 md:bottom- right-0 text-gray-1 text-xl -rotate-90"></i>
                                    </a>
                                </li>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="splide__arrows flex items-center justify-center gap-4 mt-7 md:mt-0">
                        <button class="splide__arrow splide__arrow--prev md:absolute md:-right-5 md:top-1/2 md:-translate-y-1/2 text-sm size-9 flex-center text-dusty-gray bg-white hover:bg-magenta hover:text-white transition-all">
                            <i class="pixxelicon-Left-arrow flex-center rotate-180"></i>
                        </button>
                        <button class="splide__arrow splide__arrow--next md:absolute md:-left-5 md:top-1/2 md:-translate-y-1/2 text-sm size-9 flex-center text-dusty-gray bg-white hover:bg-magenta hover:text-white transition-all">
                            <i class="pixxelicon-Left-arrow flex-center"></i>
                        </button>
                    </div>
                </div>
            </div>
        </section>
    <?php endif ?>
    <?php
    if ($seoBox) : ?>
        <section class="container xl:max-w-screen-xl px-3 md:px-0  mt-[4.5rem] md:mt-28 pb-[4.5rem] md:pb-44">
            <div class="seo-toggle-container bg-white  p-4 md:py-8" tab="<?= $i ?>">
                <div class="seo-tab-item flex w-full items-center justify-between gap-2 bg-white font-bold cursor-pointer">
                    <h2 class="flex items-baseline gap-2">
                        <i class="pixxelicon-shape text-base text-magenta"></i>
                        <?= $seoBox['title'] ?>
                    </h2>
                    <i class="pixxelicon-chevron-down1 text-[0.5rem] flex-center transition-all"></i>
                </div>
                <div class="seo-tab-content whitespace-pre-line hidden  bg-white border-t border-mid-50 pt-3 md:pt-4 mt-3 md:mt-4 text-xs md:text-sm font-medium ">
                    <?= $seoBox['description'] ?>
                </div>
            </div>
        </section>
    <?php endif ?>
    <!-- contact modal  -->
    <div class="fixed top-0 bottom-0 left-0 right-0 z-[60] visible hidden transition-all cursor-pointer modal-overlay bg-black/70"></div>

    <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data" class="modal w-full md:max-w-[460px] md:m-auto bg-white rounded-t-2xl md:rounded-2xl fixed -bottom-[130%]  left-0 md:left-1/2 md:-translate-x-1/2 md:translate-y-1/2 z-[60]  md:duration-700 transition-all flex flex-col items-start justify-start p-8">
        <input type="hidden" name="leadsourceid" value="11" />
        <input type="hidden" name="leadcatid" value="5" />
        <input type="hidden" name="stateid" value="" />

        <div class="flex items-center justify-between w-full">
            <h3 class="text-2xl">دریافت مشاوره رایگان</h3>
            <i class="pixxelicon-close text-xl p-3"></i>
        </div>
        <div class="flex flex-col gap-6 w-full">
            <div class="w-full text-sm">
                <label>نام</label>
                <div class="flex items-center relative">
                    <input type="text" class="text-gray-4 text-sm p-3 pl-6 border border-gray-4 w-full outline-none focus:border-magenta transition-all mt-1" name="leadfn" id="modal-first-name">
                    <i class="pixxelicon-user text-lg absolute left-3"></i>
                </div>
            </div>
            <div class="w-full text-sm">
                <label>نام خانوادگی</label>
                <div class="flex items-center relative">
                    <input type="text" class="text-gray-4 text-sm p-3 pl-6 border border-gray-4 w-full outline-none focus:border-magenta transition-all mt-1" name="leadln" id="modal-last-name" required>
                    <i class="pixxelicon-user text-lg absolute left-3"></i>
                </div>
            </div>
            <div class="w-full text-sm">
                <label>شماره تلفن همراه</label>
                <div class="flex items-center relative">
                    <input type="text" maxlength="11" class="phone-number text-gray-4 text-sm p-3 pl-6 border border-gray-4 w-full outline-none focus:border-magenta transition-all mt-1" name="leadcell" id="modal-phone-number" inputmode="numeric" required>
                    <i class="pixxelicon-smartphone text-lg absolute left-3"></i>
                </div>
            </div>
            <div class="w-full text-sm">
                <label>استان</label>
                <div class="flex items-center relative">
                    <select class="state text-gray-4 text-sm p-3 pl-6 border border-gray-4 w-full outline-none focus:border-magenta transition-all mt-1" id='modal-state' name="state" required>
                        <option value="<?= 0 ?>">انتخاب استان</option>
                        <?php foreach ($states as $state) : ?>
                            <option value="<?= $state->id ?>"><?= $state->name ?></option>
                        <?php endforeach ?>
                    </select>
                    <i class="pixxelicon-chevron-down1 text-[0.375rem] absolute left-3 transition-all "></i>
                </div>
            </div>
            <div class="w-full text-sm">
                <label>شهر</label>
                <div class="flex items-center relative">
                    <select class="city text-gray-4 text-sm p-3 pl-6 border border-gray-4 w-full outline-none focus:border-magenta transition-all mt-1" id='modal-city' name="cityid" required>
                        <option value="<?= 0 ?>">انتخاب شهر</option>
                        <?php foreach ($states as $state) : ?>
                            <?php foreach ($state->cities as $city) : ?>
                                <option value="<?= $city->id ?>" stateId="<?= $city->state_id ?>" class="hidden"><?= $city->name ?></option>
                            <?php endforeach ?>
                        <?php endforeach ?>
                    </select>
                    <i class="pixxelicon-chevron-down1 text-[0.375rem] absolute left-3 transition-all "></i>
                </div>
            </div>
            <div class="form-success hidden">
                <p class="p-3 rounded-lg text-sm text-green-800 bg-green-100 my-2"></p>
            </div>
            <div class="form-error hidden">
                <p class="p-3 rounded-lg text-sm text-red-800 bg-red-100 my-2"></p>
            </div>
            <button type="submit" class="submitformbutton w-full flex items-center justify-center gap-2 font-bold text-xl h-14 text-white bg-magenta">
                <svg class="w-6 h-6 fill-magenta animate-spin hidden">
                    <use href="#loading-spinner"></use>
                </svg>
                دریافت مشاوره رایگان
                <i class="pixxelicon-Left-arrow text-xl"></i>
            </button>
        </div>

    </form>
    <div class="fixed top-0 bottom-0 left-0 right-0 z-[60] visible hidden transition-all cursor-pointer success-modal-overlay bg-black/70"></div>

    <div class="success-modal trace-success-modal w-full md:max-w-[460px] md:m-auto bg-white rounded-t-2xl md:rounded-2xl fixed -bottom-[130%]  left-0 md:left-1/2 md:-translate-x-1/2 md:translate-y-1/2 z-[60]  md:duration-700 transition-all flex flex-col items-start justify-start p-8">
        <i class="pixxelicon-close text-xl p-3"></i>

        <div class="w-full flex flex-col items-center justify-center gap-2">
            <img src="<?= PIXXEL_URL . '/assets/img/success.svg' ?>" alt="تصویر ثبت با موفقیت" class="">
            <h3 class="text-xl md:text-2xl font-bold">درخواست مشاوره رایگان شما ثبت شد</h3>
            <p class="md:text-lg">به زودی همکاران ما با شما تماس خواهند گرفت.</p>
            <button class="close-success w-full flex items-center justify-center gap-2 font-bold text-xl h-14 text-magenta border border-solid border-magenta mt-2">بستن</button>
        </div>

    </div>
</div>
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol role="status" id="loading-spinner" viewBox="0 0 100 101" fill="" xmlns="http://www.w3.org/2000/svg">
        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB" />
        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="" />
    </symbol>
    <symbol role="status" id="loading-spinner" viewBox="0 0 100 101" fill="" xmlns="http://www.w3.org/2000/svg">
        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB" />
        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="" />
    </symbol>
</svg>