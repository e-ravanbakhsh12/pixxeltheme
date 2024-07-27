<?php

namespace PixxelTheme\includes\comment;

$_this = $args['_this'];
$imageId = $args['imageId'];
?>
<div class=" size-24 relative group-1" >
    <i class=" pixxelicon-cross text-[0.5rem] remove-upload-image size-4 rounded-full bg-midnight-900 text-white items-center justify-center hidden group-1-hover:flex absolute top-1 left-1 cursor-pointer" data-attach-id=<?= $imageId ?>></i>
    <?php
    echo wp_get_attachment_image($imageId, $size = 'thumbnail', false,  ['class' => 'image-item  flex-center gap-2 size-24 rounded-2xl border-midnight-50 shrink-0 cursor-pointer object-cover']);
    ?>
</div>