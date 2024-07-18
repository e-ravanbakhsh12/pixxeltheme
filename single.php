<?php
use PixxelTheme\templates\product\Product;
use PixxelTheme\templates\blog\Blog;
get_header();
$postType = get_post_type();
    if (get_post_type() == 'post') {
        $blog = new Blog();
        $blog->displayContent();
    } elseif (get_post_type() == 'product') {
        $product = new Product();
        $product->displayContent();
    } else {
        get_template_part('content', get_post_type());
    }

    ?>
<?php get_footer(); ?>