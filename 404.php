<?php
use PixxelTheme\templates\page404\Page404;
get_header();
$page404 = new Page404();
$page404->displayContent();
get_footer();