<?php

namespace PixxelTheme\templates\home;

use PixxelTheme\includes\Api;

wp_enqueue_style('splide', PIXXEL_URL . '/assets/css/splide-core.min.css', [], '4.1.2');
wp_enqueue_script('splide', PIXXEL_URL . '/assets/js/splide.min.js', [], '4.1.2', true);
wp_enqueue_script('pixxel-home', PIXXEL_URL . '/assets/js/home.js', ['jquery', 'splide'], PIXXEL_VERSION, true);

$_this = $args['_this'];


?>
<div class="home-container relative">
    <section class="relative pt-[4.5rem] md:pt-32">
        <img class="w-full absolute h-full object-cover inset-0" src="<?= PIXXEL_URL . '/assets/img/home/hero-bg.jpg' ?>" alt="">

        <div class="container xl:max-w-screen-xl  text-white z-10 relative px-4 md:px-0 drop-shadow-hero pt-32 pb-8 md:pt-44 md:pb-52">
            <h1 class="bold-24 md:bold-48">پوست شما عاشق میشود</h1>
            <p class="regular-14 md:regular-18 pt-4 md:pt-6 md:max-w-[25rem]">پیکسل یک برند پیشرو در صنعت زیبایی کشور است که در جهت حفظ ارتقای سلامت در جامعه فعاليت می‌كند.</p>
            <a class="flex-center h-10 rounded-full bg-blue-main text-white gap-2 w-fit px-4 mt-4 md:mt-6">
                مشاهده همه محصولات
                <i class="pixxelicon-chevron-left text-[0.5rem]"></i>

            </a>
        </div>
    </section>
    <section class="py-10 md:py-[6.5rem] bg-cream-02">
        <div class="container xl:max-w-screen-xl px-6 md:px-0">
            <div class="flex flex-wrap items-center pb-8 md:pb-4 md:border-b border-white">
                <h2 class="semibold-28 md:semibold-36 md:w-full order-1">محصولات</h2>
                <a class="regular-14 md:regular-16 order-2 md:order-3 mr-auto">
                    مشاهده همه
                </a>
                <p class="pt-2 w-full md:w-auto order-3 md:order-2">پیکسل یک برند پیشرو در صنعت زیبایی کشور است که در جهت حفظ ارتقای سلامت در جامعه فعاليت می‌كند.</p>
            </div>
            <div id="product-gallery" class="splide product-slider relative pt-6 md:pt-8" aria-label="Roof Type Gallery">
                <div class="splide__track  pb-5">
                    <div class="splide__list">
                        <?php
                        for ($i = 0; $i < 7; $i++) : ?>
                            <li class="splide__slide relative w-[14rem] md:w-full bg-white rounded-2xl group-1 ">
                                <div class="w-full flex flex-col items-center p-3">
                                    <div class="w-full flex items-center justify-between">
                                        <span class="size-5 rounded-full bg-orange border-orange-2 border-2"></span>
                                        <div class="semibold-12 md:semibold-14 px-2 py-[0.125rem] rounded-full bg-cream-20">پوست چرب</div>
                                    </div>

                                    <img src="<?= PIXXEL_URL . '/assets/img/home/product.jpg' ?>" alt="" class="w-full aspect-square">
                                    <h3 class="regular-16 md:regular-18 w-full text-right transition-all group-1-hover:text-blue-main pt-3 md:pt-4">ضدآفتاب بدون رنگ</h3>
                                    <p class="regular-12 md:regular-14 text-midnight-700 w-full text-right pt-2 line-clamp-2">ضدآفتاب بژ طبیعی پیکسل (پوست خشک)</p>
                                    <a class="flex-center h-10 rounded-full bg-blue-main text-white gap-2 w-fit px-4 mt-4 md:mt-6 absolute  -bottom-5 opacity-0 group-1-hover:opacity-100 transition-all">مشاهده محصول</a>
                                </div>
                            </li>
                        <?php endfor ?>
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
    <section class="py-10 md:py-[6.5rem]">
        <div class="flex-center flex-col">
            <h2 class="semibold-28 md:semibold-36 md:w-full text-center">ویدیوهای تست محصول</h2>

            <div id="video-gallery" class="splide video-slider relative pt-6 md:pt-8" aria-label="video Gallery">
                <div class="splide__track ">
                    <div class="splide__list">
                        <?php
                        for ($i = 0; $i < 5; $i++) : ?>
                            <li class="splide__slide w-full bg-white overflow-hidden rounded-2xl group-1 ">
                                <div class="w-full flex-center relative">
                                    <img src="<?= PIXXEL_URL . "/assets/img/home/video-$i.jpg" ?>" alt="" class="w-full h-[10rem] md:h-[30rem] object-cover">
                                    <div class="cover absolute w-full h-full bg-black/20"></div>
                                    <i class="pixxelicon-video-play text-2xl text-white absolute "></i>
                                </div>
                            </li>
                        <?php endfor ?>
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
        <div class="container xl:max-w-screen-xl px-6 md:px-0 flex-center flex-col">
            <h2 class="semibold-28 md:semibold-36 md:w-full text-center">سخن متخصصان درباره محصولات ما</h2>
            <div id="consultant-gallery" class="splide consultant-slider w-full relative pt-6 md:pt-8" aria-label="consultant Gallery">
                <div class="splide__track">
                    <div class="splide__list">
                        <?php
                        for ($i = 0; $i < 5; $i++) : ?>
                            <li class="splide__slide bg-white overflow-hidden rounded-2xl group-1 ">
                                <div class="w-[17.5rem] md:w-full flex-center flex-col relative p-3 md:p-6">
                                    <img src="<?= PIXXEL_URL . "/assets/img/home/consultant-$i.png" ?>" alt="" class=" size-[10rem] rounded-full object-cover">
                                    <h3 class="semibold-16 md:semibold-22 pt-3 md:pt-4">دکتر فلاحی</h3>
                                    <p class="regular-14 md:regular-16 md:pt-2">فوق تخصص زیبایی</p>
                                    <div class="w-full h-[1px] bg-midnight-50"></div>
                                    <p class="text-center  regular-12 md:regular-14">صحبت هایی درباره محصولات پیکسل که ویژگی هایی بسیاری دارد. صحبت هایی درباره محصولات پیکسل که ویژگی هایی بسیاری دارد.صحبت هایی درباره محصولات پیکسل که ویژگی هایی بسیاری دارد.صحبت هایی درباره محصولات پیکسل که ویژگی هایی بسیاری دارد.صحبت هایی درباره محصولات پیکسل که ویژگی هایی بسیاری دارد.</p>
                                </div>
                            </li>
                        <?php endfor ?>
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
            <h2 class="semibold-28 md:semibold-36 md:w-full text-center">دیگر برند‌های ما</h2>
            <p class="regular-14 md:regular-16 pt-4">برندهای همکار پیکسل اکسپرت در مجموعه‌ی هولدینگ پیکسل</p>
            <div class="w-full grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-2 pt-6 md:pt-14">
                <?php
                for ($i = 0; $i < 6; $i++) : ?>
                    <div class="w-full h-full flex-center flex-col gap-4 md:gap-8 py-3 md:py-9 px-4 md:px-6">
                        <img src="<?= PIXXEL_URL . '/assets/img/logo.png' ?>" class="grayscale size-16 md:size-[4.5rem] rounded-full object-cover" />
                        <h4 class="regular-16 md:regular-18 line-clamp-1">برند پیکسل اکسپرت</h4>
                    </div>
                <?php endfor ?>
            </div>
        </div>
    </section>
    <section class="py-10 md:py-[6.5rem] bg-cream-02">
        <div class="container xl:max-w-screen-xl px-6 md:px-0 flex-center flex-col">
            <h2 class="semibold-28 md:semibold-36 md:w-full text-center">مقالات پیکسل اکسپرت</h2>
            <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4 pt-6 md:pt-14">
                <?php
                for ($i = 0; $i < 4; $i++) : ?>
                    <div class="w-full h-full p-3 md:p-6 bg-white rounded-3xl grid grid-cols-[7.75rem_1fr] md:grid-cols-[14rem_1fr] grid-rows-[auto_auto] gap-3 md:gap-x-6 md:gap-y-4">
                        <img src="<?= PIXXEL_URL . '/assets/img/home/blog.jpg' ?>" class="row-span-1 md:row-span-2 w-full h-20 md:h-[8.75rem] object-cover rounded-2xl" />
                        <h3 class="semibold-16 md:semibold-18 line-clamp-2 w-full">کرم‌های مخصوص گردن و دکلته: چرا مهم هستند؟</h3>
                        <p class="regular-14 md:regular-16 line-clamp-2 col-span-2 md:col-span-1">نکات کلیدی برای استفاده موثر از کرم‌های آنتی‌اکسیدان برای بهره‌مندی حداکثری از خواص آنتی‌اکسیدان‌ها، استفاده روزانه و منظم از کرم ضروری است. اعمال کرم روی پوست تمیز و مرطوب، استفاده همزمان از ضد آفتاب در طول روز، و ترکیب با سایر محصولات مراقبتی مناسب می‌تواند اثربخشی این کرم‌ها را افزایش دهد.</p>
                    </div>
                <?php endfor ?>
            </div>
             <a class="regular-16 px-6 py-3 rounded-full border border-black mt-3 md:mt-8 transition-all hover:px-10 cursor-pointer">مشاهده‌ی همه</a>       
        </div>
    </section>
    <section class="py-10 md:py-[6.5rem] bg-cream-02">
        <div class="container xl:max-w-screen-xl px-6 md:px-0 flex-center flex-col">

        </div>
    </section>
</div>
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol role="status" id="loading-spinner" viewBox="0 0 100 101" fill="" xmlns="http://www.w3.org/2000/svg">
        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB" />
        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="" />
    </symbol>

</svg>