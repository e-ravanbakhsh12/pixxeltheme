<?php

namespace PixxelTheme;

use PixxelTheme\templates\category\Category;
get_header();
    $category = new Category();
    $category->displayContent();

get_footer();