<?php

/**
 * Edit handler for replies
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php get_header(); ?>

<div id="main-col">
	<div id="content">

		<div <?php suffusion_bbpress_content_class(); ?> >
			<?php while (have_posts()) : the_post(); ?>

			<div id="bbp-edit-page" class="bbp-edit-page">
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<div class="entry-content">

					<?php bbp_get_template_part('bbpress/form', 'reply'); ?>

				</div>
			</div><!-- #bbp-edit-page -->

			<?php endwhile; ?>

		</div><!-- post -->
	</div><!-- #content -->
</div><!-- #main-col -->
<?php get_footer(); ?>
