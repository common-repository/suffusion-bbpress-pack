<?php

/**
 * Single Forum
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php get_header(); ?>

<div id="main-col">
	<div id="content">

	<?php do_action('bbp_template_notices'); ?>
		<div <?php suffusion_bbpress_content_class(); ?> >

			<?php while (have_posts()) : the_post(); ?>

			<?php if (bbp_user_can_view_forum()) : ?>

				<div id="forum-<?php bbp_forum_id(); ?>" class="bbp-forum-content">
					<h1 class="entry-title"><?php bbp_forum_title(); ?></h1>
					<div class="entry-content">

						<?php bbp_get_template_part('bbpress/content', 'single-forum'); ?>

					</div>
				</div><!-- #forum-<?php bbp_forum_id(); ?> -->

				<?php else : // Forum exists, user no access ?>

				<?php bbp_get_template_part('bbpress/feedback', 'no-access'); ?>

				<?php endif; ?>

			<?php endwhile; ?>

		</div><!-- post -->
	</div><!-- #content -->
</div><!-- #main-col -->
<?php get_footer(); ?>
