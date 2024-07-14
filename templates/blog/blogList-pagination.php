<?php
namespace PixxelTheme\templates\blog;


$class = $args['class'];
$max_num_pages = $args['max_num_pages'];
$page_query = intval($args['page_query']);
$pagination_offset = $args['pagination_offset'];
$url = $args['url'];
if ($max_num_pages > 1) : ?>

    <div class="w-full md:w-1/4"></div>
    <div class="labell-pagination flex w-full my-5 text-sm" page="<?php esc_attr_e($page_query) ?>" max-page="<?php esc_attr_e($max_num_pages) ?>">
        <div class="mx-auto flex items-start gap-1 md:gap-3">
            <?php if ($page_query > 1) : ?>
                <a href="<?= $url.'?paged='.$page_query - 1  ?>"  class="page-item size-9 flex-center cursor-pointer flex bg-bg  hover:bg-magenta transition-all hover:text-white" page="<?php esc_attr_e($page_query - 1) ?>">
                    <i class="pixxelicon-Left-arrow rotate-180"></i>
                </a>
            <?php endif ?>
            <div class="page-numbers flex  flex-wrap justify-center gap-3 md:gap-2">

                <?php for ($i = 1; $i <= $max_num_pages; $i++) : ?>
                    <?php if ($max_num_pages > 6 && $page_query > ($pagination_offset + 2)) : ?>
                        <?php if ($i == $pagination_offset) : ?>
                            <div class="page-item size-9 flex-center cursor-pointer flex bg-bg hover:bg-magenta transition-all hover:text-white" page="<?php esc_attr_e($i) ?>">...</div>
                        <?php endif ?>
                        <?php if ($i == $pagination_offset - 2 || $i == $pagination_offset - 1) : ?>
                            <a href="<?= $url.'?paged='.$i  ?>" class="page-item size-9 flex-center cursor-pointer flex  hover:bg-magenta transition-all hover:text-white <?php echo $i == $page_query ? 'bg-magenta text-white selected' : 'bg-bg' ?>" page="<?php esc_attr_e($i) ?>"><?php esc_attr_e($i) ?></a>
                        <?php endif ?>
                    <?php endif ?>

                    <?php if (!($i >= $page_query + $pagination_offset + 1 || $i <= $page_query - $pagination_offset - 1)) : ?>
                        <a  href="<?= $url.'?paged='.$i  ?>" class="page-item size-9 flex-center cursor-pointer flex  hover:bg-magenta transition-all hover:text-white <?php echo $i == $page_query ? 'bg-magenta text-white selected' : 'bg-bg' ?>" page="<?php esc_attr_e($i) ?>"><?php esc_attr_e($i) ?></a>
                    <?php endif ?>
                    <?php if ($max_num_pages > 6 && $page_query < ($max_num_pages - $pagination_offset - 1)) : ?>
                        <?php if ($i == $max_num_pages - 2) : ?>
                            <div class="page-item size-9 flex-center cursor-pointer flex bg-bg hover:bg-magenta transition-all hover:text-white" page="<?php esc_attr_e($i) ?>">...</div>
                        <?php endif ?>
                        <?php if ($i == $max_num_pages - 1 || $i == $max_num_pages) : ?>
                            <a  href="<?= $url.'?paged='.$i  ?>" class="page-item size-9 flex-center cursor-pointer flex  hover:bg-magenta transition-all hover:text-white <?php echo $i == $page_query ? 'bg-magenta text-white selected' : 'bg-bg' ?>" page="<?php esc_attr_e($i) ?>"><?php esc_attr_e($i) ?></a>
                        <?php endif ?>
                    <?php endif ?>
                <?php endfor ?>
            </div>
            <?php if ($page_query != $max_num_pages) : ?>
                <a  href="<?= $url.'?paged='.$page_query + 1  ?>" class="page-item size-9 flex-center cursor-pointer flex bg-bg  hover:bg-magenta transition-all hover:text-white"  page="<?php esc_attr_e($page_query + 1) ?>">
                    <i class="pixxelicon-Left-arrow"></i>
                </a>
            <?php endif ?>
        </div>
    </div>
<?php endif ?>