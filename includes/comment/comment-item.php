<?php

namespace PixxelTheme\includes\comment;

$_this = $args['_this'];
$comment = $args['comment'];
$i = $args['i'];
$user_id = $args['user_id'];
$level = $args['level'];

$level++;
$commentType = get_comment_meta($comment->comment_ID, 'pixxel_type', true);
$commentTitle = get_comment_meta($comment->comment_ID, 'pixxel_title', true);
$commentRate = intval(get_comment_meta($comment->comment_ID, 'pixxel_rate', true));
$commentAnonyms = intval(get_comment_meta($comment->comment_ID, 'pixxel_anonyms', true));
$commentImages = get_comment_meta($comment->comment_ID, 'pixxel_images', true);
$childrenList = $_this->commentChildren($comment->comment_ID);
$hasChildren = !empty($childrenList);

global $global_first_level_comment_count;

if ($level == 1) {
    $global_first_level_comment_count++;
}
$animationDelay = $i*0.2;
?>
<div class="comment-item   flex-col   relative  transition-all level-<?= $level ?> bg-white rounded-3xl <?= $level===1 && $_this->type == 'blog' ? '' : 'p-3 md:p-6' ?>  <?= $level === 1 && $global_first_level_comment_count > 3 ? 'hidden' : 'flex' ?> <?= $level > 1 ? 'border-2 border-midnight-50' : '' ?>" commentId="<?= esc_attr__($comment->comment_ID) ?>" parentId="<?= esc_attr__($comment->comment_parent) ?>" id="comment-<?= esc_attr__($comment->comment_ID) ?>"  <?= $level===1  ? "data-anim='up' data-y='40' data-delay='0.2'" :'' ?>>
    <?php if ($level === 1 && $_this->type == 'product') : ?>
        <h2 class="comment-title semibold-14 md:semibold-16"><?= esc_attr__($commentTitle) ?></h2>
    <?php endif ?>
    <h3 class="comment-author regular-14 md:regular-16 text-midnight-700 flex items-center gap-1">
        <div class=""><?= $commentType == 'admin' && 0  ? 'تیم پشتیبانی پیکسل' : ($commentAnonyms ? 'مشتری' : esc_attr__($comment->comment_author)) ?> </div>
        <?php if ($_this->type == 'product') : ?>
            <span>-</span>
            <?= human_time_diff(strtotime($comment->comment_date)) . ' پیش' ?>
            <?php if ($level === 1) : ?>
                <div class="flex items-center gap-1 text-lg text-yellow-main">
                    <?php for ($i = 1; $i < 6; $i++) : ?>
                        <i class="pixxelicon-star<?= $i <= $commentRate ? '-fill' : '' ?>"></i>
                    <?php endfor ?>
                </div>
            <?php endif ?>
        <?php endif ?>
    </h3>
    <div class="comment-content  leading-8 break-words regular-14 md:regular-16 ">
        <?= $comment->comment_content  ?>
        <?php if (!$comment->comment_approved) : ?>
            <p class=" regular-12 md:regular-14 text-midnight-700 italic">(دیدگاه شما در انتظار تایید می باشد)</p>
        <?php endif ?>
        <?php if ($commentImages) :
            $commentImages = explode(',', $commentImages);
        ?>
            <?php if ($_this->type == 'product') : ?>
                <div class="comment-image-container pt-3 md:pt-5 flex items-center gap-3">
                    <?php foreach ($commentImages as $image) {
                        echo wp_get_attachment_image($image, 'thumbnail', false,  ['class' => 'image-item flex-center gap-2 size-14 rounded-2xl border-midnight-50 shrink-0 cursor-pointer object-cover']);
                    } ?>
                </div>
            <?php endif ?>
        <?php endif ?>
        <div class="flex gap-3 justify-end items-center text-neutrals-500 mt-2">
            <div class="cursor-pointer text-xs text-bold add-reply flex items-center gap-2">
                پاسخ دهید
                <i class="pixxelicon-redo text-xl"></i>
            </div>
            <div class="flex items-center gap-4 mr-auto">
            </div>
        </div>
    </div>
    <div class="pt-3 md:pt-4 ">
        <?php if ($hasChildren) : ?>
            <?php
            foreach ($childrenList as $child_obj) {
                echo $_this->generateCommentItem($child_obj, 0, 1, $user_id, $level);
            }
            ?>
        <?php endif ?>
    </div>
</div>
<?php if ($level > 1 && count($childrenList) > 2) : ?>
    <div class="bg-white pt-2 -mr-6 mt-2">
        <div class="show-more-comment subtitle2 py-0 px-3 flex justify-center items-center text-neutrals-500 bg-neutrals-200 w-fit cursor-pointer" level="level-<?= $level ?>">نمایش بیشتر (<?= count($childrenList) - 2 ?>)</div>
    </div>
<?php endif;
