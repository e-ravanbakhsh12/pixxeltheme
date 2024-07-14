<?php

namespace PixxelTheme\templates\contactUs;

// wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBow3_Ck71F_ApQTlzWlPeRkEV_sCeuppo', array(), PIXXEL_VERSION, true);
wp_enqueue_script('labell-contact-us', PIXXEL_URL . '/assets/js/contact-us.js', ['jquery'], PIXXEL_VERSION, true);


$class = $args['class'];
$info = \get_field('info');
?>
<div class="main-container bg-gray-1 relative">
    <section class="bg-magenta relative pt-[4.5rem] md:pt-32">

        <img class="w-full absolute h-full object-cover inset-0" src="<?= PIXXEL_URL . '/assets/img/home/hero-bg.png' ?>" alt="">

        <div class="container xl:max-w-screen-xl  text-white z-10 relative px-4 md:px-0">
            <div class="flex flex-col md:flex-row gap-14 md:gap-32 mt-8">
                <div class="mt-2 mb-32  md:mb-16 w-full max-w-[39rem]">
                    <h1 class="text-3xl md:text-4xl font-black"><?= get_the_title() ?></h1>
                    <div class="flex flex-col gap-6 text-sm mt-6 md:mt-8">
                    <a href="tel:<?= $info['number'] ?>" class="flex items-center gap-2">
                            <div class="icon-container flex-center size-12 relative bg-white text-magenta">
                                <i class="pixxelicon-phone text-lg "></i>
                                <i class="pixxelicon-corner absolute -top-1 right-0  text-sm rotate-180"></i>
                                <i class="pixxelicon-corner absolute -bottom-1 left-0  text-sm"></i>
                            </div>
                            <?= $info['number'] ?>
                            <span class="text-xs">(بدون کد)</span>
                        </a>
                        <div class="flex items-center gap-2">
                            <div class="icon-container flex-center size-12 relative bg-white text-magenta">
                                <i class="pixxelicon-location text-lg "></i>
                                <i class="pixxelicon-corner absolute -top-1 right-0  text-sm rotate-180"></i>
                                <i class="pixxelicon-corner absolute -bottom-1 left-0  text-sm"></i>
                            </div>
                            <?= $info['address'] ?>
                        </div>
                        <a href="mailto:<?= $info['email'] ?>" class="flex items-center gap-2">
                            <div class="icon-container flex-center size-12 relative bg-white text-magenta">
                                <i class="pixxelicon-mail text-lg "></i>
                                <i class="pixxelicon-corner absolute -top-1 right-0  text-sm rotate-180"></i>
                                <i class="pixxelicon-corner absolute -bottom-1 left-0  text-sm"></i>
                            </div>
                            <?= $info['email'] ?>
                        </a>
                    </div>
                    <div class="flex flex-col md:flex-row  gap-4 md:gap-6 mt-6 md:mt-8">
                        <a href="<?= home_url() . '/representation' ?>" type="submit" class="w-full md:w-1/2 px-4 flex items-center justify-center gap-2 font-bold h-8 text-white bg-transparent border-2 border-white">
                            راههای درخواست نمایندگی
                            <i class="pixxelicon-Left-arrow text-xl"></i>
                        </a>
                    </div>
                </div>
                <div class="w-full max-w-[32.8125rem] relative">
                    <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data" class="contact-form w-full max-w-[32.8125rem] object-contain absolute top-[-120px] md:top-0 -mt-16 md:mt-0  text-black right-0 z-10">
                        <div class="inner relative bg-white px-3 py-4 md:py-12 md:px-10 mt-9 md:mt-0">
                            <input type="hidden" name="leadsourceid" value="11" />
                            <input type="hidden" name="leadcatid" value="8" />
                            <div class="flex flex-col gap-6 w-full">
                                <div class="flex flex-col w-full md:flex-row  gap-6 md:gap-3">
                                    <div class="w-full text-sm">
                                        <label>نام</label>
                                        <div class="flex items-center relative">
                                            <input type="text" class="first-name text-gray-4 text-sm p-3 pl-6 border border-gray-4 w-full outline-none focus:border-magenta transition-all mt-1" name="leadfn" id="contact-first-name">
                                        </div>
                                    </div>
                                    <div class="w-full text-sm">
                                        <label>نام خانوادگی</label>
                                        <div class="flex items-center relative">
                                            <input type="text" class="last-name text-gray-4 text-sm p-3 pl-6 border border-gray-4 w-full outline-none focus:border-magenta transition-all mt-1" name="leadln" id="contact-last-name" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-col w-full md:flex-row  gap-6 md:gap-3">
                                    <div class="w-full text-sm">
                                        <label>شماره تلفن همراه</label>
                                        <div class="flex items-center relative">
                                            <input type="text" maxlength="11" class="phone-number text-gray-4 text-sm p-3 pl-6 border border-gray-4 w-full outline-none focus:border-magenta transition-all mt-1" name="leadcell" id="contact-phone-number" inputmode="numeric" required>
                                        </div>
                                    </div>
                                    <div class="w-full text-sm">
                                        <label>ایمیل</label>
                                        <div class="flex items-center relative">
                                            <input type="email" class="email text-gray-4 text-sm p-3 pl-6 border border-gray-4 w-full outline-none focus:border-magenta transition-all mt-1" name="leademail" id="contact-email">
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full text-sm">
                                    <label>متن پیام</label>
                                    <div class="flex items-center relative">
                                        <textarea type="text" class="description text-gray-4 h-36 text-sm p-3 pl-6 border border-gray-4 w-full outline-none focus:border-magenta transition-all mt-1 resize-none" name="description" id="contact-description" required></textarea>
                                    </div>
                                </div>
                                <div class="form-success hidden">
                                    <p class="p-3 rounded-lg text-sm text-green-800 bg-green-100 my-2"></p>
                                </div>
                                <div class="form-error hidden">
                                    <p class="p-3 rounded-lg text-sm text-red-800 bg-red-100 my-2"></p>
                                </div>
                                <button type="submit" class="submitformbutton w-full md:w-fit px-4 flex items-center justify-center gap-2 font-bold  h-8 text-white bg-magenta md:mr-auto">
                                    <svg class="w-6 h-6 fill-magenta animate-spin hidden">
                                        <use href="#loading-spinner"></use>
                                    </svg>
                                    ارسال پیام
                                    <i class="pixxelicon-Left-arrow text-xl"></i>
                                </button>
                            </div>
                            <i class="pixxelicon-corner absolute -bottom-1 left-0 md:left-auto md:right-0 text-gray-1 text-xl md:text-3xl md:-rotate-90"></i>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="container xl:max-w-screen-xl  mt-[38rem] md:mt-[13.25rem] pb-32 md:pb-[11.75rem]">
        <div class="mx-4 md:mx-0  relative z-10">
            <h2 class="text-[1.375rem] md:text-[1.75rem] font-bold flex items-baseline gap-2">
                <i class="pixxelicon-shape text-base text-magenta"></i>
                آدرس ما روی نقشه
            </h2>
            <?php if (0) : ?>
                <div id="google-map" class="w-full h-40 md:h-96 mt-4 md:mt-6"></div>
            <?php else : ?>
                <img src="<?= PIXXEL_URL . '/assets/img/contact-us/map.png' ?>" alt="" class="w-full mt-4 md:mt-6 object-contain">
            <?php endif ?>

        </div>
    </section>
    <div class="fixed top-0 bottom-0 left-0 right-0 z-[60] visible hidden transition-all cursor-pointer success-modal-overlay bg-black/70"></div>

    <div class="success-modal trace-success-modal w-full md:max-w-[460px] md:m-auto bg-white rounded-t-2xl md:rounded-2xl fixed -bottom-[130%]  left-0 md:left-1/2 md:-translate-x-1/2 md:translate-y-1/2 z-[60]  md:duration-700 transition-all flex flex-col items-start justify-start p-8">
        <i class="pixxelicon-close text-xl p-3"></i>

        <div class="w-full flex flex-col items-center justify-center gap-2">
            <img src="<?= PIXXEL_URL . '/assets/img/success.svg' ?>" alt="تصویر ثبت با موفقیت" class="">
            <h3 class="text-xl md:text-2xl font-bold">اطلاعات تماس شما ثبت شد</h3>
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
</svg>