<?php
namespace PixxelTheme\pages;
use PixxelTheme\templates\product\ProductList;
// Template Name: Product Page



get_header();
$productListTemplate = new ProductList();
$productListTemplate->displayContent();
get_footer();
?>