<?php

namespace PixxelTheme\templates\blog;


$_this = $args['_this'];
$blogs = $args['blogs'];

if ($blogs->have_posts()) foreach ($blogs->posts as $i=> $blog) : ?>
    <a href="<?= get_permalink($blog->ID) ?>" class="w-full flex flex-col items-center bg-white rounded-2xl group-1" data-anim="up" data-y="40" data-delay="0.2">
        <?= get_the_post_thumbnail($blog->ID, 'full', ['class' => 'w-full h-[12.5rem] md:h-[12.rem] rounded-2xl object-cover', 'loading' => "lazy"]) ?>
        <h3 class="semibold-14 md:semibold-16 line-clamp-2 min-h-9 md:max-h-12 w-full text-right mt-2 md:mt-6">
            <?= $blog->post_title ?>
        </h3>
        <div class="mt-auto w-full">
            <p class="mt-2 line-clamp-2 w-full text-justify"><?= getFirstParagraph($blog->post_content) ?></p>
        </div>
    </a>
<?php
    wp_reset_postdata();
endforeach ?>

