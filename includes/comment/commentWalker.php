<?php
namespace PixxelTheme\includes\comment;
use Walker_Comment;

/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if (post_password_required())
	return;


class commentWalker extends Walker_Comment
{
	var $tree_type = 'comment';
	var $db_fields = array('parent' => 'comment_parent', 'id' => 'comment_ID');

	// constructor – wrapper for the comments list
	function __construct()
	{ ?>

		<ul class="comments-list flex flex-col gap-5 p-4 rounded-xl shadow-cart w-full">

		<?php }

	// start_lvl – wrapper for child comments list
	function start_lvl(&$output, $depth = 0, $args = array())
	{
		$GLOBALS['comment_depth'] = $depth + 2; ?>

			<ul class="child-comments comments-list">

			<?php }

		// end_lvl – closing wrapper for child comments list
		function end_lvl(&$output, $depth = 0, $args = array())
		{
			$GLOBALS['comment_depth'] = $depth + 2; ?>

			</ul>

		<?php }

		// start_el – HTML for comment template
		function start_el(&$output, $comment, $depth = 0, $args = array(), $id = 0)
		{
			$depth++;
			$GLOBALS['comment_depth'] = $depth;
			$GLOBALS['comment'] = $comment;
			$parent_class = (empty($args['has_children']) ? '' : 'parent');

			if ('article' == $args['style']) {
				$tag = 'article';
				$add_below = 'comment';
			} else {
				$tag = 'article';
				$add_below = 'comment';
			}
			$comment_class = empty($args['has_children']) ? 'p-4 rounded-xl border-neutrals-200 border-2 shadow-cart' : 'p-4 rounded-xl border-neutrals-200 border-2 shadow-cart parent ';
			if ($depth == 1) {
				$comment_class .= '';
			}
			if ($depth > 1) {
				$comment_class .= '  mr-3 mt-3';
			}
		?>
			<li <?php comment_class($comment_class) ?> id="comment-<?php comment_ID() ?>" itemprop="comment" itemscope itemtype="http://schema.org/Comment">
				<div class="flex gap-3 justify-start items-center">
					<figure class="gravatar"><?php echo get_avatar($comment, 65, '[default gravatar URL]', 'Author’s gravatar'); ?></figure>
					<div class="">
						<h3 class="comment-author">
							<a class="comment-author-link body-font2 text-neutrals-900" href="<?php comment_author_url(); ?>" itemprop="author"><?php comment_author(); ?></a>
						</h3>
						<time class="comment-meta-item overline-font text-neutrals-400" datetime="<?php comment_date('Y-m-d') ?>T<?php comment_time('H:iP') ?>" itemprop="datePublished"><?php date_i18n('Y-m-d  H:i:s', strtotime(comment_date('Y-m-d') . '' . comment_time('H:i')))  ?></time>
					</div>
					<div class="mr-auto">
						<?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					</div>
				</div>
				<div class="comment-meta post-meta flex text-right justify-between items-center" role="complementary">
					<?php // edit_comment_link('ویرایش این دیدگاه'); 
					?>
					<?php if ($comment->comment_approved == '0') : ?>
						<p class="comment-meta-item">دیدگاه شما در انتظار تایید می باشد</p>
					<?php endif; ?>

				</div>
				<div class="comment-content body-font2 post-content py-4 text-neutrals-900" itemprop="text">
					<?php comment_text() ?>

				</div>

			<?php }

		// end_el – closing HTML for comment template
		function end_el(&$output, $comment, $depth = 0, $args = array())
		{ ?>

			</li>

		<?php }

		// destructor – closing wrapper for the comments list
		function __destruct()
		{ ?>

		</ul>

<?php }
	}
?>

<div id="comments" class="comments-area bg-white rounded-2xl shadow-cart p-3 md:p-10 mb-3 md:mb-10">
	<?php if (have_comments()) : ?>
		<h2 class="comments-title">
			<?php
			echo number_format_i18n(get_comments_number()) . ' دیدگاه'
			?>
		</h2>
		<div class="nik-comment-box flex bg-transparent lg:mt-10 mt-3 w-full">
			<?php
			wp_list_comments(array(
				'avatar_size' => 32,
				'max_depth'  => 5,
				'reply_text' => '<button class="text-white caption text-6px; bg-primary-400 rounded-lg px-2 ">پاسخ به دیدگاه</button>',
				'walker' =>  new haal_comment_walker(),

			));
			?>

			<?php
			// Are there comments to navigate through?
			if (get_comment_pages_count() > 1 && get_option('page_comments')) :
			?>
				<nav class="navigation comment-navigation" role="navigation">
					<h1 class="screen-reader-text section-heading"><?php esc_html_e('Comment navigation', 'woodmart'); ?></h1>
					<div class="nav-previous"><?php previous_comments_link(esc_html__('&larr; Older Comments', 'woodmart')); ?></div>
					<div class="nav-next"><?php next_comments_link(esc_html__('Newer Comments &rarr;', 'woodmart')); ?></div>
				</nav><!-- .comment-navigation -->
			<?php endif; // Check for comment navigation 
			?>

			<?php if (!comments_open() && get_comments_number()) : ?>
				<p class="no-comments"><?php esc_html_e('دیدگاه ها بسته می باشد', 'woodmart'); ?></p>
			<?php endif; ?>
		</div>
	<?php endif; // have_comments() 
	?>

	<?php
	$args = array(
		'title_reply' => '',
		'title_reply_to' => 'پاسخ به ',
		'title_reply_before' => '<h4 id="reply-title" class="body-font2 comment-reply-title flex justify-between items-center my-3">',
		'title_reply_after' => '</h4>',
		// 'cancel_reply_before' => '<div class="testing">',
		// 'cancel_reply_after' => '<div/>',
		'logged_in_as' => '',
		'class_form' => 'form',
		'comment_notes_before' => '',
		'comment_field' =>
		'<div class="flex flex-col gap-3 justify-center items-start">
						<label class="font-bold">دیدگاه</label>
						<textarea class="w-full bg-neutrals-100 rounded-lg resize-none p-4 outline-none " placeholder="دیدگاه خود را وارد کنید" required id="comment" name="comment" rows="8" ></textarea>
					',
		'submit_field' =>
		'<button type="submit" class="button-font text-base w-1/2 mr-auto  my-4 py-2 px-4 text-white bg-primary-500 rounded-lg mt-3 max-w-[230px]">ثبت دیدگاه</button>
			<input type="hidden" name="comment_post_ID" value="' . get_the_ID() . '" id="comment_post_ID">
			<input type="hidden" name="comment_parent" id="comment_parent" value="0">
			</div>',
		'fields' => array(
			'author' =>
			'<div class="flex flex-col md:flex w-full gap-4  md:gap-8 mt-5">
					<div class="flex w-full md:w-1/2 flex-col gap-3">
						<label class="font-bold" >نام و نام خانوادگی</label>
						<input class="bg-neutrals-100 rounded-lg w-full p-2 " type="text" placeholder="نام و نام خانوادگی" required id="author" name="author">
					</div>',
			'email' =>
			'<div class="flex w-full md:w-1/2 flex-col gap-3">
							<label class="font-bold">ایمیل</label>
							<input class="bg-neutrals-100 rounded-lg w-full p-2" type="text" placeholder="ایمیل" required id="email" name="email">               
					</div>
				</div>
				',
			// 'mobile' =>
			// '<div class="flex w-full flex-col gap-3">
			// 		<label class="font-bold">موبایل</label>
			// 		<input class="bg-white rounded-lg w-full p-2" type="text" placeholder="موبایل" required id="mobile" name="mobile">               
			// 	 </div>
			// 	 ',
			'cookies' => '
				 <p class="comment-form-cookies-consent hidden">
					<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" checked> 
					<label for="wp-comment-cookies-consent">ذخیره نام، ایمیل و وبسایت من در مرورگر برای زمانی که دوباره دیدگاهی می‌نویسم.</label>
				 </p>
				 '
		)
	);
	comment_form($args);
	?>


</div><!-- #comments -->