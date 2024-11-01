<?php

/**
 * Split topic page
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

			<?php while (have_posts()) the_post(); ?>

			<div id="bbp-edit-page" class="bbp-edit-page">
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<div class="entry-content">

					<?php bbp_get_template_part('bbpress/form', 'topic-split'); ?>

				</div>
			</div><!-- #bbp-edit-page -->

		</div><!-- post -->
	</div><!-- #content -->
</div><!-- #main-col -->
<?php get_footer(); ?>
