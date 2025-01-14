<?php

/**
 * User Profile
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php get_header(); ?>

<div id="main-col">
	<div id="content">

		<div <?php suffusion_bbpress_content_class(); ?> >
			<div id="bbp-user-<?php bbp_current_user_id(); ?>" class="bbp-single-user">
				<div class="entry-content">

					<?php bbp_get_template_part('bbpress/content', 'single-user'); ?>

				</div><!-- .entry-content -->
			</div><!-- #bbp-user-<?php bbp_current_user_id(); ?> -->

		</div><!-- post -->
	</div><!-- #content -->
</div><!-- #main-col -->
<?php get_footer(); ?>
