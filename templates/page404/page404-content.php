<?php

namespace PixxelTheme\templates\page404;

?>
<div class="404-container flex flex-col">
    <section class="container xl:max-w-screen-xl grow flex flex-col">
        <div class="mx-4 md:mx-0 relative z-10 flex flex-col grow items-center justify-center py-16 md:py-20"  data-anim="up" data-y="40" data-delay="0.2">
            <img src="<?= PIXXEL_URL . '/assets/img/404.svg' ?>" alt="" class="w-full max-w-[12.5rem] md:max-w-[20rem] object-contain ">
            <h1 class="semibold-28 md:semibold-36 mt-6 md:mt-14">صفحه‌ای که دنبال آن بودید یافت نشد!</h1>
            <p class="regular-16 md:regular-18 max-w-[40rem] text-center pt-4">ممکن است آدرس اشتباه وارد شده باشد یا پیج موردنظر به آدرس دیگری منتقل شده باشد.</p>
            <a href="<?= home_url() ?>" class="flex-center h-8 rounded-full bg-blue-main text-white gap-2  w-full md:w-fit px-4 md:px-12 cursor-pointer mt-4">
                بازگشت به خانه
            </a>
        </div>
    </section>
</div>