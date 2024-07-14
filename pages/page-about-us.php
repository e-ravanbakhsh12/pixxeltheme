<?php
namespace PixxelTheme\pages;
use PixxelTheme\templates\aboutUs\AboutUs;
// Template Name: About Us Page



get_header();
$aboutUsTemplate = new AboutUs();
$aboutUsTemplate->displayContent();
get_footer();
?>