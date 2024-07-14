<?php get_header(); ?>
<div class="entry-content page-content">
    <?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
</div><!-- .entry-content -->

<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>