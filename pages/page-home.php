<?php
namespace PixxelTheme\pages;
use PixxelTheme\templates\home\Home;
// Template Name: Home Page



get_header('',['mode'=>'transparent']);
$homePageTemplate = new Home();
$homePageTemplate->displayContent();
get_footer();
?>