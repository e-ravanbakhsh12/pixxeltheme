<?php

namespace PixxelTheme;

use PixxelTheme\templates\product\ProductList;
use PixxelTheme\templates\blog\Blog;
use PixxelTheme\templates\project\ProjectList;

get_header();
if (get_post_type() == 'post') {
    $blog = new Blog();
    $blog->displayContent();
} elseif (get_post_type() == 'product') {
    $productList = new ProductList();
    $productList->displayContent();
}elseif (get_post_type() == 'project') {
    $projectList = new ProjectList();
    $projectList->displayContent();
}
get_footer();
