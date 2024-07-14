<?php

namespace PixxelTheme\templates\aboutUs;

wp_enqueue_script('labell-product', PIXXEL_URL . '/assets/js/faq.js', ['jquery'], PIXXEL_VERSION, true);


$class = $args['class'];
$info = get_field('info');
$statistics = get_field('statistics');
?>
<div class="main-container bg-grad relative">
    <section class=" relative pt-[4.5rem] md:pt-32">
        <div class="container xl:max-w-screen-xl  z-10 relative px-4 md:px-0">
            <div class="flex flex-col md:flex-row gap-6 md:gap-7 mt-8">
                <div class="mt-2 md:mb-16 w-full max-w-[39rem]">
                    <h1 class="text-3xl md:text-4xl font-black"><?= isset($info['section-1']['title']) ? $info['section-1']['title'] : 'درباره لابل' ?></h1>
                    <p class="text-[0.8125rem] md:text-base mt-10 md:mt-8">
                        <?= isset($info['section-1']['description']) ? $info['section-1']['description'] : '' ?>
                    </p>
                    <div class="flex w-full max-w-[39rem] mt-6 md:mt-10">
                        <div class=" flex flex-col gap-1 px-4 border-r border-r-magenta text-xl md:text-2xl font-bold">
                            +<?= $statistics['project'] ?>
                            <span class="text-sm md:text-base font-normal text-maine-shaft">پروژه موفق</span>
                        </div>
                        <div class="flex flex-col gap-1 px-4 border-r border-r-magenta text-xl md:text-2xl font-bold">
                            +<?= $statistics['satisfaction'] ?>
                            <span class="text-sm md:text-base font-normal text-maine-shaft">رضایت مشتری</span>
                        </div>
                        <div class="flex flex-col gap-1 px-4 border-r border-r-magenta text-xl md:text-2xl font-bold">
                            +<?= $statistics['history'] ?>
                            <span class="text-sm md:text-base font-normal text-maine-shaft">سال سابقه و تجربه</span>
                        </div>
                    </div>
                </div>
                <div class="w-full max-w-[37rem] relative">
                    <?= get_the_post_thumbnail(get_the_ID(), 'full', ['class' => 'w-full max-w-[37rem] object-contain']) ?>
                </div>
            </div>
        </div>
    </section>
    <section class="container xl:max-w-[60.5rem]  mt-10 md:mt-32">
        <div class="mx-4 md:mx-0 flex flex-col md:items-center z-10">
            <h2 class="text-[1.375rem] md:text-[1.75rem] font-bold flex items-baseline text-magenta gap-2">
                <i class="pixxelicon-shape text-base "></i>
                <?= isset($info['section-2']['title']) ? $info['section-2']['title'] : '' ?>
            </h2>
            <div class="text-sm mt-6 md:mt-8">
                <?= isset($info['section-2']['description']) ? $info['section-2']['description'] : '' ?>
            </div>
            <?php if (0) : ?>
                <a href="" class="w-full md:w-fit md:px-4 flex items-center justify-center gap-2 font-bold h-8 text-white bg-magenta mt-6 md:mt-8">
                    ثبت درخواست نمایندگی
                    <i class="pixxelicon-Left-arrow text-xl"></i>
                </a>
            <?php endif ?>
        </div>
    </section>
    <section class="mt-[4.5rem] md:mt-28">
        <div class="container xl:max-w-screen-xl px-3 md:px-0 flex flex-col md:flex-row md:items-center">
            <div class="relative w-full h-[17.5rem] md:w-[60%] md:h-[38.75rem] md:order-2 z-0">
                <?= wp_get_attachment_image($info['ceo']['image'], 'full', false, ['class' => 'w-full h-[17.5rem] md:h-[38.75rem] object-cover relative z-0 ']) ?>
                <i class="pixxelicon-corner absolute -bottom-1 left-0  text-gray-1 text-2xl md:text-5xl "></i>
            </div>
            <div class="w-full md:w-1/2">
                <div action="" class=" md:w-[120%] -mt-16 md:mt-0 bg-white px-4 mx-2 md:mx-0 py-8 md:p-12 md:order-1 relative right-0 z-10">
                    <h2 class="text-lg md:text-2xl font-bold flex items-baseline  gap-2">
                        <i class="pixxelicon-shape text-base text-magenta"></i>
                        <?= isset($info['ceo']['title']) ? $info['ceo']['title'] : 'معرفی مدیرعامل' ?>
                    </h2>
                    <div class="mt-4 md:mt-8">
                        <?= isset($info['ceo']['description']) ? $info['ceo']['description'] : '' ?>
                    </div>
                    <i class="pixxelicon-qout-fill text-4xl md:text-5xl text-magenta absolute right-6 -bottom-6"></i>
                </div>
            </div>
        </div>
    </section>
    <section class="container xl:max-w-[60.5rem]  mt-[4.5rem]">
        <div class="mx-4 md:mx-0 flex flex-col md:items-center z-10">
            <h2 class="text-[1.375rem] md:text-[1.75rem] font-bold flex items-baseline text-magenta gap-2">
                <i class="pixxelicon-shape text-base "></i>
                <?= isset($info['section-3']['title']) ? $info['section-3']['title'] : '' ?>
            </h2>
            <div class="text-sm mt-6 md:mt-8">
                <?= isset($info['section-3']['description']) ? $info['section-3']['description'] : '' ?>
            </div>
            <?php if (0) : ?>
                <a href="" class="w-full md:w-fit md:px-4 flex items-center justify-center gap-2 font-bold h-8 text-white bg-magenta mt-6 md:mt-8">
                    ثبت درخواست نمایندگی
                    <i class="pixxelicon-Left-arrow text-xl"></i>
                </a>
            <?php endif ?>
            <div class="statestic-container grid grid-cols-2 md:grid-cols-4 gap-x-7 gap-y-8 md:gap-x-8 items-center w-full mt-[4.5rem]">
                <div class=" flex flex-col gap-2 flex-center py-4 border-b border-b-magenta text-xl md:text-[1.75rem] font-bold">
                    +<?= $statistics['variety'] ?>
                    <span class="text-sm md:text-base text-maine-shaft font-normal">تنوع طرح</span>
                </div>
                <div class=" flex flex-col gap-2 flex-center py-4 border-b border-b-magenta text-xl md:text-[1.75rem] font-bold">
                    +<?= $statistics['installer'] ?>
                    <span class="text-sm md:text-base text-maine-shaft font-normal">نصاب آموزش دیده</span>
                </div>
                <div class=" flex flex-col gap-2 flex-center py-4 border-b border-b-magenta text-xl md:text-[1.75rem] font-bold">
                    +<?= $statistics['representation'] ?>
                    <span class="text-sm md:text-base text-maine-shaft font-normal">نمایندگی فعال</span>
                </div>
                <div class=" flex flex-col gap-2 flex-center py-4 border-b border-b-magenta text-xl md:text-[1.75rem] font-bold">
                    +<?= $statistics['installation'] ?>
                    <span class="text-sm md:text-base text-maine-shaft font-normal">نصب موفق</span>
                </div>
            </div>
        </div>
    </section>
    <section class=" container xl:max-w-screen-xl mt-[4.5rem] pb-32 md:pb-[11.75rem] ">
        <div class="mx-3 md:mx-0 p-4 md:p-10 flex flex-col items-center bg-white">
            <h2 class="text-[1.375rem] md:text-[1.75rem] font-bold flex items-baseline  gap-2">
                <i class="pixxelicon-shape text-base text-magenta"></i>
                <?= isset($info['certificate']['title']) ? $info['certificate']['title'] : '' ?>
            </h2>
            <div class="text-xs mt-2">
                <?= isset($info['certificate']['description']) ? $info['certificate']['description'] : '' ?>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-5 w-full mt-8 md:mt-20">
                <?php if (isset($info['certificate']['item'])) foreach ($info['certificate']['item'] as $item) : ?>
                    <div class="flex items-center flex-col gap-4 md:gap-10 w-full">
                        <?= wp_get_attachment_image($item['image'], 'full', false, ['class' => 'w-full max-w-24 md:max-w-32 object-contain']) ?>
                        <h4 class="mt-4 md:mt-10 text-sm text-medium"><?= $item['title'] ?></h4>
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