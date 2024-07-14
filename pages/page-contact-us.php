<?php
namespace PixxelTheme\pages;
use PixxelTheme\templates\contactUs\ContactUs;
// Template Name: Contact Us Page



get_header('',['mode'=>'dark']);
$contactUsTemplate = new ContactUs();
$contactUsTemplate->displayContent();
get_footer();
?>