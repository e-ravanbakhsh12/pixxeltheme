<?php

namespace PixxelTheme\includes\comment;

$_this = $args['_this'];
$post_id = $args['post_id'];
$is_login = 0;
$user_id = session_id();
if (is_user_logged_in()) {
    $is_login = 1;
    $user_id = get_current_user_id();
}
$rateAverage = get_post_meta($post_id, 'rate_average', true);
$ratesData = $_this->commentRateAverage($post_id);

// enqueue js file
wp_enqueue_script('pixxel-comment', PIXXEL_URL . '/assets/js/comment.js', ['jquery'], PIXXEL_VERSION, true);
wp_localize_script('pixxel-comment', 'commentData', ['isLogin' => $is_login, 'postId' => $post_id]);

$comment_list = get_comments(['post_id' => $post_id, 'status' => 'approve', 'parent__in' => [0]]);
?>
<div class="flex flex-col lg:flex-row justify-between lg:gap-4">
    <?php if ($_this->type == 'product') : ?>
        <div class="flex flex-col justify-between md:justify-start shrink-0">
            <h3 class="semibold-28 md:semibold-36" data-anim="title" data-delay="0.2" data-split="lines">
                نظر کاربران
            </h3>
            <div class="rates-container mt-3 md:mt-4 regular-14 md:regular-16 flex items-center gap-2 shrink-0" data-anim="up" data-y="40" data-delay="0.2">
                <div class="">
                    امتیاز <span class="font-bold"><?= $ratesData['averageRate'] ?></span> از <span class="font-bold"><?= $ratesData['commentCount'] ?></span> نظر
                </div>
                <div class="flex items-center gap-1 text-lg text-yellow-main">
                    <?php for ($i = 1; $i < 6; $i++) : ?>
                        <i class="pixxelicon-star<?= $i <= $ratesData['averageRate'] ? '-fill' : '' ?>"></i>
                    <?php endfor ?>
                </div>

            </div>
            <a href="#pixxel-comment-form" class="flex items-center md:hidden regular-16 text-white bg-blue-main flex-center w-full rounded-full h-10 shrink-0 mt-3" data-anim="up" data-y="40" data-delay="0.2">
                نظر خود را بنویسید
            </a>
        </div>
    <?php endif ?>
    <div class="lg:grow space-y-2 md:space-y-4">
        <div class="flex flex-col gap-2 md:gap-4 mt-2 pixxel-comment-container md:mt-6">
            <?php if (is_array($comment_list)) foreach ($comment_list as $i => $comment) : ?>
                <?php echo $_this->generateCommentItem($comment, $i, $user_id, 0); ?>
            <?php endforeach ?>
        </div>
        <form id="pixxel-comment-form" class="pixxel-comment-popup regular-14 p-6 px-3 bg-white relative flex flex-col w-full pixxel-comment-form rounded-3xl" data-anim="up" data-y="40" data-delay="0.2">
            <div class="flex flex-col gap-4 ">
                <?php if (!$is_login) : ?>
                    <div class="flex flex-col gap-4 md:flex-row w-full">
                        <div class="md:flex-1 flex flex-col gap-1">
                            <label for="pixxel-comment-name" class="">نام و نام خانوادگی</label>
                            <input type="text" name="pixxel-comment-name" id="pixxel-comment-name" class="h-10 py-1 px-3 border-2 outline-none border-midnight-50 rounded-2xl text-midnight-400" placeholder="نام و نام خانوادگی خود را وارد کنید">
                        </div>
                        <div class="md:flex-1 flex flex-col gap-1">
                            <label for="pixxel-comment-mobile" class="">ایمیل</label>
                            <input type="email" name="pixxel-comment-email" id="pixxel-comment-email" class="h-10 py-1 px-3 border-2 outline-none border-midnight-50 rounded-2xl text-midnight-400" placeholder="ایمیل خود را وارد کنید">
                        </div>
                    </div>
                <?php endif ?>
                <?php if ($_this->type == 'product') : ?>
                    <div class="flex flex-col gap-4 md:flex-row w-full">
                        <div class="md:flex-1 flex flex-col gap-1">
                            <label for="pixxel-comment-title" class="">عنوان دیدگاه</label>
                            <input type="text" name="pixxel-comment-title" id="pixxel-comment-title" class="h-10 py-1 px-3 border-2 outline-none border-midnight-50 rounded-2xl text-midnight-400" placeholder="عنوان دیدگاهتان را بنویسید">
                        </div>
                        <div class="md:flex-1 flex flex-col gap-1">
                            <label for="pixxel-comment-rate" class="text-medium text-xs md:text-sm">امتیاز شما به این محصول</label>
                            <div class="rate-container flex items-center gap-1 mt-2 justify-end" data-rate="" dir="ltr">
                                <i class="pixxelicon-star-fill text-xl text-midnight-400 hover:text-yellow-main cursor-pointer peer transition-all" data-number="5"></i>
                                <i class="pixxelicon-star-fill text-xl text-midnight-400 hover:text-yellow-main cursor-pointer peer peer-hover:text-yellow-main transition-all" data-number="4"></i>
                                <i class="pixxelicon-star-fill text-xl text-midnight-400 hover:text-yellow-main cursor-pointer peer peer-hover:text-yellow-main transition-all" data-number="3"></i>
                                <i class="pixxelicon-star-fill text-xl text-midnight-400 hover:text-yellow-main cursor-pointer peer peer-hover:text-yellow-main transition-all" data-number="2"></i>
                                <i class="pixxelicon-star-fill text-xl text-midnight-400 hover:text-yellow-main cursor-pointer peer peer-hover:text-yellow-main transition-all" data-number="1"></i>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
                <div class=" flex flex-col w-full gap-3">
                    <div class="flex flex-col gap-1">
                        <label for="pixxel-comment-content" class="">متن دیدگاه</label>
                        <textarea name="pixxel-comment-content" id="pixxel-comment-content" class="w-full p-3 outline-none resize-none h-20 border-2 border-midnight-50 rounded-2xl text-midnight-400" placeholder="متن دیدگاهتان را بنویسید"></textarea>
                    </div>
                    <?php if ($_this->type == 'product') : ?>
                        <div class="upload-section-container">
                            <label for="pixxel-uploaded-image" class="">ارسال تصویر</label>
                            <input type="hidden" class="pixxel-uploaded-image mt-1" id="pixxel-uploaded-image" name="pixxel-uploaded-image" value="">
                            <input id="pixxel-upload-img" type="file" class="hidden" multiple accept="image/*">
                            <div class="flex flex-row flex-wrap gap-1 mt-2">

                                <label for="pixxel-upload-img" class=" flex-center flex-col gap-2 size-24 border-2 border-dashed rounded-2xl text-midnight-400 border-midnight-50 shrink-0 cursor-pointer">
                                    <i class="pixxelicon-add-image text-lg text-midnight-400"></i>
                                    <div class="regular-12">بارگذاری تصویر</div>
                                    <svg class="hidden size-6 animate-spin fill-blue-main">
                                        <use href="#loading-spinner"></use>
                                    </svg>
                                </label>
                                <div class="display-uploaded-img flex flex-wrap gap-1"></div>
                            </div>
                        </div>
                    <?php endif ?>
                    <div class="flex flex-col md:flex-row md:justify-between gap-3 mt-3">
                        <div class="checkbox flex items-center gap-2">
                            <input type="checkbox" name="pixxel-anonyms" id="pixxel-anonyms" class="size-3 border-2 border-midnight-50">
                            <label for="pixxel-anonyms" class="">ارسال دیدگاه به صورت ناشناش</label>
                        </div>
                        <button type="submit" class="h-10 flex-center w-full md:w-fit md:mr-auto  text-white bg-blue-main px-4 md:px-16 flex justify-center items-center gap-3 rounded-full">
                            ثبت نظر
                            <i class="pixxelicon-chevron-left text-[0.5rem]"></i>

                            <svg class="hidden w-6 h-6 animate-spin fill-blue-main">
                                <use href="#loading-spinner"></use>
                            </svg>
                        </button>
                    </div>
                </div>

            </div>
            <div class="comment-response-box">
                <div class="hidden w-full px-4 py-1 border success-message regular-16 rounded-full md:text-md-bold border-green-400 bg-green-100 text-green-800  mt-5"></div>
                <div class="hidden w-full px-4 py-1 border error-message regular-16 rounded-full md:text-md-bold border-red-400 bg-red-100 text-red-800  mt-5"></div>
            </div>
        </form>

        <button class="comment-show-more w-full md:w-fit h-12 border rounded-full border-blue-main px-16 text-blue-main semibold-14 md:semibold-16 <?php echo count($comment_list) > 3 ? 'flex' : 'hidden' ?> items-center justify-center gap-3 mx-auto mt-4" data-page="2" data-all-page="<?php echo  ceil(count($comment_list) / 3);  ?>" data-anim="up" data-y="40" data-delay="0.2">
            مشاهده نظر بیشتر
            <i class="pixxelicon-arrow-bottom text-sm"></i>
        </button>
    </div>
</div>
<div class="reply-container hidden">
    <div class="comment-reply-field hidden md:flex flex-col mt-4">
        <?php if (!$is_login) : ?>
            <div class="flex flex-col gap-5 md:flex-row">
                <input type="text" name="pixxel-comment-name" id="pixxel-reply-comment-name" class="md:flex-1  h-10 py-1 px-3 border-2 outline-none border-midnight-50 rounded-2xl text-midnight-400" placeholder="نام و نام خانوادگی">
                <input type="text" name="pixxel-comment-email" id="pixxel-reply-comment-email" class="h-10 py-1 px-3 border-2 outline-none border-midnight-50 rounded-2xl text-midnight-400" placeholder="ایمیل">
            </div>
        <?php endif ?>
        <div class="textarea-container flex w-full gap-0 items-end justify-center  mt-6 absolute md:relative transition-all">
            <i class="pixxelicon-mouse-arrow submit-comment text-midnight-700 opacity-50 text-2xl text-neutrals-600 absolute left-3  bottom-3"></i>
            <span class="w-full caption comment-textarea min-h-12 border-2 rounded-2xl border-midnight-50 outline-none pr-4 pl-16 py-3 no-scrollbar resize-y bg-white" placeholder="پاسخ شما به این دیدگاه چیست؟" name="add-new-comment" role="textbox" parentId="" contenteditable></span>
            <svg role="status" class="w-6 h-6 hidden  text-white animate-spin absolute left-3 fill-blue-main bottom-3" id="comment-spin">
                <use href="#loading-spinner"></use>
            </svg>
            <div class="textarea-placeholder text-sm-semibold absolute top-3 right-4 text-neutrals-500">پاسخ شما به این دیدگاه چیست؟</div>
        </div>
    </div>
</div>
<div class="fixed top-0 bottom-0 left-0 right-0 z-50 visible hidden transition-all cursor-pointer pixxel-comment-popup-overlay bg-black/40"></div>
<!-- reply comment in mobile -->
<div class="reply-comment-modal-overlay hidden bg-black/40 fixed top-0 right-0 left-0 bottom-0 z-50 transition-all visible cursor-pointer px-6 pt-6 pb-4"></div>
<div class="reply-comment-modal rounded-t-3xl fixed -bottom-full right-0 flex-col justify-start items-start text-neutrals-900 md:text-neutrals-700  shadow-search bg-white transition-all px-6 pt-6 pb-4 duration-700 w-full z-[60]">
    <i class="pixxelicon-cross text-sm font-medium text-neutrals-900 cursor-pointer p-3"></i>
    <?php if (!$is_login) : ?>
        <div class="flex flex-col gap-5 md:flex-row mt-6">
            <input type="text" name="pixxel-comment-name" id="pixxel-reply-comment-name-mobile" class="md:flex-1  h-10 py-1 px-3 border-2 outline-none border-midnight-50 rounded-2xl text-midnight-400" placeholder="نام و نام خانوادگی">
            <input type="number" name="pixxel-comment-email" id="pixxel-reply-comment-email-mobile" class="h-10 py-1 px-3 border-2 outline-none border-midnight-50 rounded-2xl text-midnight-400" placeholder="ایمیل">
        </div>
    <?php endif ?>
    <h4 class="headline4 pt-6 pb-4">پاسخ</h4>
    <textarea name="mobile-comment-textarea" class="comment-textarea rounded-2xl regular-14 md:regular-16  w-full h-full max-h-[180px] border-2 border-midnight-50 p-4 resize-none overflow-y-auto outline-none text-justify" id="mobile-comment-textarea" cols="30" rows="10" parentId="" firstLevel="" placeholder="پاسخ شما به این دیدگاه چیست؟" <?php echo is_user_logged_in() ? '' : 'maxlength="600"' ?>></textarea>
    <div class="submit-comment opacity-50 button-font bg-blue-main w-full h-12 rounded-full mt-6 flex justify-center items-center text-white">ثبت دیدگاه</div>
</div>