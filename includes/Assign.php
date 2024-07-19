<?php

namespace PixxelTheme\includes;


if (!defined('ABSPATH')) {
    exit;
}

class Assign
{
    function __construct()
    {
    }

    public  function addToFooter()
    {
    }

    public  function addToHeader()
    {
        $color = get_option('theme_color','option');
        ?>  
        <style>  
            :root {  
                --primary: rgb(var<?= $color  ?>);  
            }  

        </style>  
        <?php  
    }

    public  function addToBody()
    {
        
    }
}
