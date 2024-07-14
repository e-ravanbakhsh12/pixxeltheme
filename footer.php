<?php
use PixxelTheme\templates\layouts\footer\Footer;
$footer = new Footer;
if (is_array($args) && isset($args)){
    $mode =  $args['mode'];
    $type =  $args['type'];
}
$footer->displayContent($mode,$type);