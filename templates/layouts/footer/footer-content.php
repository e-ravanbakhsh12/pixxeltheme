<?php

namespace PixxelTheme\templates\layouts\footer;

use WP_Query;

$_this = $args['this'];
$mode = $_this->mode;
$type = $_thi->type;
$footerData = get_field('footer_data', 'option');
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
                <section class="bg-midnight-900 text-white ">
                    <div class="inner-section container xl:max-w-screen-xl px-6 md:px-0 flex flex-col md:flex-row justify-between items-center gap-4 py-4 overflow-hidden">
                        <p class="regular-12 md:regular-14" data-anim="horizontal" data-x="40" data-delay="0.2">با <span class="semibold-14 md:semibold-16">پیکسل</span> پوست شما عاشق میشود</p>
                        <i class="pixxelicon-logo text-5xl" data-anim="up" data-y="40" data-delay="0.2"></i>
                        <div class="flex-center gap-4 md:gap-10 text-base md:text-xl" data-anim="horizontal" data-x="-40" data-delay="0.2">
                            <i class="pixxelicon-instagram md:text-blue-main"></i>
                            <i class="pixxelicon-telegram "></i>
                        </div>
                    </div>
                </section>
                <section class=" container xl:max-w-screen-xl flex flex-col items-center  px-3 md:px-0 overflow-hidden">
                    <p class="regular-14 md:regular-16 text-center pt-10 md:pt-14 " data-anim="up" data-y="40" data-delay="0.3"><?= $footerData['description'] ?></p>
                    <div class="flex flex-col md:flex-row gap-10 md:gap-6 w-full max-w-[45.25rem] py-6 md:py-14">
                        <div class="flex-1" data-anim="horizontal" data-x="-40" data-delay="0.2">
                            <h3 class="semibold-16 md:semibold-18 md:text-center">آشنایی با پیکسل اکسپرت</h3>
                            <div class="grid grid-cols-2 md:grid-cols-1 gap-2 md:gap-4  regular-14 md:regular-16 text-midnight-700 pt-4 md:pt-6">
                                <?php if($footerData['column_1'] && count($footerData['column_1'])) foreach ($footerData['column_1'] as $link) : ?>
                                    <a href="<?= $link['link']['url'] ?>" class="hover:text-blue-main transition-all w-full md:text-center"><?= $link['label'] ?></a>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <div class="flex-1" data-anim="horizontal" data-x="-40" data-delay="0.4">
                            <h3 class="semibold-16 md:semibold-18 md:text-center">مطالب مفید</h3>
                            <div class="grid grid-cols-2 md:grid-cols-1 gap-2 md:gap-4  regular-14 md:regular-16 text-midnight-700 pt-4 md:pt-6">
                                <?php if($footerData['column_2'] && count($footerData['column_2'])) foreach ($footerData['column_2'] as $link) : ?>
                                    <a href="<?= $link['link']['url'] ?>" class="hover:text-blue-main transition-all w-full md:text-center"><?= $link['label'] ?></a>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <div class="flex-1" data-anim="horizontal" data-x="-40" data-delay="0.6">
                            <h3 class="semibold-16 md:semibold-18 md:text-center">خرید از پیکسل اکسپرت</h3>
                            <div class="grid grid-cols-2 md:grid-cols-1 gap-2 md:gap-4  regular-14 md:regular-16 text-midnight-700 pt-4 md:pt-6">
                                <?php if($footerData['column_3'] && count($footerData['column_3'])) foreach ($footerData['column_3'] as $link) : ?>
                                    <a href="<?= $link['link']['url'] ?>" class="hover:text-blue-main transition-all w-full md:text-center"><?= $link['label'] ?></a>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                    <div class="flex-center w-full py-6 border-t border-midnight-50 gap-1 regular-14 text-midnight-700" data-anim="up" data-y="40" data-delay="0.2">
                        <p class="">تمامی حقوق برای پیکسل‌ اکسپرت محفوظ است</p>
                        <div class="w-[1px] h-2 bg-midnight-700"></div>
                        <p class="">۱۴۰۳</p>
                    </div>
                </section>
            </footer>
            <!-- svg -->
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol role="status" id="loading-spinner" viewBox="0 0 100 101" fill="" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB" />
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="" />
                </symbol>
            </svg>
        </div>
    <?php endif ?>
    </main><!-- end website wrapper -->
<?php endif ?>
<?php wp_footer(); ?>
</body>

</html>