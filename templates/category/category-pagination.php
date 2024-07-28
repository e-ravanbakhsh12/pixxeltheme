<?php

namespace PixxelTheme\templates\category;


$class = $args['class'];
$max_num_pages = $args['max_num_pages'];
$page_query = intval($args['page_query']);
$pagination_offset = $args['pagination_offset'];
if ($max_num_pages > 1) : ?>

    <div class="w-full md:w-1/4"></div>
    <div class="pixxel-pagination flex w-full pt-4 md:pt-14 text-sm" page="<?php esc_attr_e($page_query) ?>" max-page="<?php esc_attr_e($max_num_pages) ?>">
        <div class="mx-auto flex items-start gap-1 md:gap-3 bg-white rounded-full py-2 px-6">
            <?php if ($page_query > 1) : ?>
                <a href="<?= $url . '?page=' . $page_query - 1  ?>" class="page-item size-6 md:size-8 rounded-full flex-center cursor-pointer flex hover:bg-light-blue transition-all hover:text-white" page="<?php esc_attr_e($page_query - 1) ?>">
                    <i class="pixxelicon-arrow-right-2"></i>
                </a>
            <?php endif ?>
            <div class="page-numbers flex  flex-wrap justify-center gap-3 md:gap-2">

                <?php for ($i = 1; $i <= $max_num_pages; $i++) : ?>
                    <?php if ($max_num_pages > 6 && $page_query > ($pagination_offset + 2)) : ?>
                        <?php if ($i == $pagination_offset) : ?>
                            <div class="page-item size-6 md:size-8 rounded-full flex-center cursor-pointer flex hover:bg-light-blue transition-all " page="<?php esc_attr_e($i) ?>">...</div>
                        <?php endif ?>
                        <?php if ($i == $pagination_offset - 2 || $i == $pagination_offset - 1) : ?>
                            <a href="<?= $url . '?page=' . $i  ?>" class="page-item size-6 md:size-8 rounded-full flex-center cursor-pointer flex   transition-all <?php echo $i == $page_query ? 'bg-blue-main text-white selected' : ' hover:bg-light-blue ' ?>" page="<?php esc_attr_e($i) ?>"><?php esc_attr_e($i) ?></a>
                        <?php endif ?>
                    <?php endif ?>

                    <?php if (!($i >= $page_query + $pagination_offset + 1 || $i <= $page_query - $pagination_offset - 1)) : ?>
                        <a href="<?= $url . '?page=' . $i  ?>" class="page-item size-6 md:size-8 rounded-full flex-center cursor-pointer flex   transition-all <?php echo $i == $page_query ? 'bg-blue-main text-white selected' : 'hover:bg-light-blue' ?>" page="<?php esc_attr_e($i) ?>"><?php esc_attr_e($i) ?></a>
                    <?php endif ?>
                    <?php if ($max_num_pages > 6 && $page_query < ($max_num_pages - $pagination_offset - 1)) : ?>
                        <?php if ($i == $max_num_pages - 2) : ?>
                            <div class="page-item size-6 md:size-8 rounded-full flex-center cursor-pointer flex hover:bg-light-blue transition-all" page="<?php esc_attr_e($i) ?>">...</div>
                        <?php endif ?>
                        <?php if ($i == $max_num_pages - 1 || $i == $max_num_pages) : ?>
                            <a href="<?= $url . '?page=' . $i  ?>" class="page-item size-6 md:size-8 rounded-full flex-center cursor-pointer flex   transition-all <?php echo $i == $page_query ? 'bg-blue-main text-white selected' : 'hover:bg-light-blue' ?>" page="<?php esc_attr_e($i) ?>"><?php esc_attr_e($i) ?></a>
                        <?php endif ?>
                    <?php endif ?>
                <?php endfor ?>
            </div>
            <?php if ($page_query != $max_num_pages) : ?>
                <a href="<?= $url . '?page=' . $page_query + 1  ?>" class="page-item size-6 md:size-8 rounded-full flex-center cursor-pointer flex hover:bg-light-blue transition-all" page="<?php esc_attr_e($page_query + 1) ?>">
                    <i class="pixxelicon-arrow-right-2 rotate-180"></i>
                </a>
            <?php endif ?>
        </div>
    </div>
<?php endif ?>