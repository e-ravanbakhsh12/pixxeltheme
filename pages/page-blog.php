<?php
namespace PixxelTheme\pages;
use PixxelTheme\templates\blog\BlogList;
// Template Name: Blog Page



get_header();
$blogListTemplate = new BlogList();
$blogListTemplate->displayContent();
get_footer();
?>