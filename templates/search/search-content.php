<?php

namespace PixxelTheme\templates\search;

use WP_Query;

$_this = $args['_this'];
$products = $args['product'];

if ($posts) foreach ($products as $product) : ?>
    <a href="<?= get_permalink($product->ID) ?>" class="w-full flex flex-col items-center group-1">
        <?= get_the_post_thumbnail($product->ID, 'large', ['class' => 'w-full h-full max-h-[12.5rem] aspect-square object-contain', 'loading' => "lazy"]) ?>
        <h3 class="regular-14 md:regular-16 w-full text-right transition-all group-1-hover:text-blue-main pt-3 md:pt-4"><?= $product->post_title ?></h3>
        <p class="regular-12 text-midnight-700 w-full text-right mt-2 line-clamp-2"><?= $product->post_excerpt ?></p>
    </a>
<?php endforeach ?>