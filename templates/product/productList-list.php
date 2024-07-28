<?php

namespace PixxelTheme\templates\product;


$_this = $args['_this'];
$products = $args['products'];
if ($products->have_posts()) foreach ($products->posts as $product) :
    $color = get_field('color', $product->ID);
    $properties = get_field('properties', $product->ID);

?>
    <a href="<?= get_permalink($product->ID) ?>" class="w-full flex flex-col items-center p-3 md:pb-6 bg-white rounded-2xl group-1" data-anim="up" data-y="40" data-delay="0.2">
        <div class="w-full flex items-center justify-between">
            <div class="flex items-center gap-2">
                <?php if ($color) foreach ($color as $i => $item) : ?>
                    <span class="size-5 rounded-full border-orange-2 border-2" style="background-color:<?= $item['value'] ?>"></span>
                <?php endforeach ?>
            </div>
            <div class="semibold-12 md:semibold-14 px-2 py-[0.125rem] rounded-full bg-bg text-midnight-900"><?= $properties['skin_type'] ?></div>
        </div>
        <?= get_the_post_thumbnail($product->ID, 'full', ['class' => 'w-full aspect-square object-contain', 'loading' => "lazy", 'data-item' => 0]) ?>
        <h3 class="regular-16 md:regular-18 w-full text-right transition-all group-1-hover:text-blue-main pt-3 md:pt-4"><?= $product->post_title ?></h3>
        <p class="regular-12 md:regular-14 text-midnight-700 w-full text-right pt-2 line-clamp-2"><?= $product->post_excerpt ?></p>
    </a>
<?php
    wp_reset_postdata();
endforeach ?>

<!-- <div class="w-full flex flex-col p-3 md:pb-6 bg-white rounded-2xl group-1">
    <div class="w-full flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="size-5 rounded-full border-2 skeleton"></span>
            <span class="size-5 rounded-full border-2 skeleton"></span>
        </div>
        <div class="rounded-full w-20 skeleton "></div>
    </div>
    <div class="w-full aspect-square rounded-xl skeleton"></div>
    <div class="w-2/3 md:w-1/3 h-8 md:h-10 rounded-lg skeleton mt-4"></div>
    <div class="mt-2 h-4 md:h-6 rounded-md skeleton w-full"></div>
    <div class="mt-2 h-4 md:h-6 rounded-md skeleton w-full"></div>
</div> -->