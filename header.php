<?php
use PixxelTheme\templates\layouts\header\Header;
if (is_array($args) && isset($args)){
    $mode =  $args['mode'];
    $type =  $args['type'];
}
$header = new Header($mode,$type);
$header->displayContent();

