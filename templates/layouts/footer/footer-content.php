<?php

namespace PixxelTheme\templates\layouts\footer;

use WP_Query;

$_this = $args['this'];
$mode =$_this->mode;
$type = $_thi->type;
$footerData = get_field('footer', 'option');
$blogArgs = [
    'post_type' => 'post',
    'posts_per_page' => 4,
];
$blogs = new WP_Query($blogArgs);
?>
<?php if ($type != 'empty') : ?>
    </div><!-- .main-page-wrapper -->
    <?php if (!function_exists('elementor_theme_do_location') || !\elementor_theme_do_location('footer')) : ?>
        <div class="footer-wrapper bg-gray-2 mt-auto relative">
            <footer class="container xl:max-w-screen-xl haal-footer ">
                
            </footer>
        </div>
    <?php endif ?>
    </main><!-- end website wrapper -->
<?php endif ?>
<?php wp_footer(); ?>
</body>

</html>