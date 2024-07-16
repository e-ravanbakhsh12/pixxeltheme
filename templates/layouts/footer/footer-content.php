<?php

namespace PixxelTheme\templates\layouts\footer;

use WP_Query;

$_this = $args['this'];
$mode = $_this->mode;
$type = $_thi->type;
// $footerData = get_field('footer', 'option');
// $blogArgs = [
//     'post_type' => 'post',
//     'posts_per_page' => 4,
// ];
// $blogs = new WP_Query($blogArgs);
$footerList = [
    'محصولات',
    'دربا‌ره‌ی ما',
    'وبلاگ',
    'تماس با ما',
    'سوالات متداول',
    'حریم خصوصی',
];
?>
<?php if ($type != 'empty') : ?>
    </div><!-- .main-page-wrapper -->
    <?php if (!function_exists('elementor_theme_do_location') || !\elementor_theme_do_location('footer')) : ?>
        <div class="footer-wrapper bg-gray-2 mt-auto relative">
            <footer class="">
                <section class="bg-midnight-900 text-white">
                    <div class="inner-section container xl:max-w-screen-xl px-6 md:px-0 flex flex-col md:flex-row justify-between items-center gap-4 py-4">
                        <p class="regular-12 md:regular-14">با <span class="semibold-14 md:semibold-16">پیکسل</span> پوست شما عاشق میشود</p>
                        <i class="pixxelicon-logo text-5xl"></i>
                        <div class="flex-center gap-4 md:gap-10 text-base md:text-xl">
                            <i class="pixxelicon-instagram md:text-blue-main"></i>
                            <i class="pixxelicon-telegram "></i>
                        </div>
                    </div>
                </section>
                <section class=" container xl:max-w-screen-xl flex flex-col items-center  px-3 md:px-0">
                    <p class="regular-14 md:regular-16 text-center pt-10 md:pt-14 ">پیکسل یک برند پیشرو در صنعت زیبایی کشور است که در جهت حفظ ارتقای سلامت در جامعه فعاليت می‌كند. ترکیبات و فرمولاسیون محصولات برند پیکسل مورد تایید لابراتور اتو سوئیس بوده که مواد اولیه تمام محصولات از خارج کشور به ویژه کشور سوئیس تامین می‌شود. هلدینگ سیلانه سبز صاحب انحصاری محصولات پیکسل در ایران به حساب می‌آید که با همکاری هلدینگ تهران بوران، این محصولات بهداشتی و مراقبتی را در اختیار مردم قرار می‌دهد به گونه‌ای که کلیه محصولات این برند را می‌توانید از داروخانه‌ها، فروشگاه‌های زیبایی، زنجیره‌ای و اینترنتی در سراسر ایران تهیه کنید.</p>
                    <div class="flex flex-col md:flex-row gap-10 md:gap-6 w-full max-w-[45.25rem] py-6 md:py-14">
                        <div class="flex-1">
                            <h3 class="semibold-16 md:semibold-18 md:text-center">آشنایی با پیکسل اکسپرت</h3>
                            <div class="grid grid-cols-2 md:grid-cols-1 gap-2 md:gap-4  regular-14 md:regular-16 text-midnight-700 pt-4 md:pt-6">
                                <?php foreach ($footerList as $link) : ?>
                                    <a href="#" class="hover:text-blue-main transition-all w-full md:text-center"><?= $link ?></a>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="semibold-16 md:semibold-18 md:text-center">مطالب مفید</h3>
                            <div class="grid grid-cols-2 md:grid-cols-1 gap-2 md:gap-4  regular-14 md:regular-16 text-midnight-700 pt-4 md:pt-6">
                                <?php foreach ($footerList as $link) : ?>
                                    <a href="#" class="hover:text-blue-main transition-all w-full md:text-center"><?= $link ?></a>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="semibold-16 md:semibold-18 md:text-center">خرید از پیکسل اکسپرت</h3>
                            <div class="grid grid-cols-2 md:grid-cols-1 gap-2 md:gap-4  regular-14 md:regular-16 text-midnight-700 pt-4 md:pt-6">
                                <?php foreach ($footerList as $link) : ?>
                                    <a href="#" class="hover:text-blue-main transition-all w-full md:text-center"><?= $link ?></a>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                    <div class="flex-center w-full py-6 border-t border-midnight-50 gap-1 regular-14 text-midnight-700">
                        <p class="">تمامی حقوق برای پیکسل‌ اکسپرت محفوظ است</p>
                        <div class="w-[1px] h-2 bg-midnight-700"></div>
                        <p class="">۱۴۰۳</p>
                    </div>
                </section>
            </footer>
        </div>
    <?php endif ?>
    </main><!-- end website wrapper -->
<?php endif ?>
<?php wp_footer(); ?>
</body>

</html>