<?php

/**
 * Single View
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

			<div id="bbp-view-<?php bbp_view_id(); ?>" class="bbp-view">
				<h1 class="entry-title"><?php bbp_view_title(); ?></h1>
				<div class="entry-content">

					<?php bbp_get_template_part('bbpress/content', 'single-view'); ?>

				</div>
			</div><!-- #bbp-view-<?php bbp_view_id(); ?> -->

		</div><!-- post -->
	</div><!-- #content -->
</div><!-- #main-col -->
<?php get_footer(); ?>
