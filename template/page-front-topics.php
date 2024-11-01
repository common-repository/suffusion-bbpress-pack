<?php

/**
 * Template Name: bbPress - Topics (Newest)
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

			<div id="topics-front" class="bbp-topics-front">
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<div class="entry-content">

					<?php the_content(); ?>

					<?php bbp_get_template_part('bbpress/content', 'archive-topic'); ?>

				</div>
			</div><!-- #topics-front -->

			<?php endwhile; ?>

		</div><!-- post -->
	</div><!-- #content -->
</div><!-- #main-col -->
<?php get_footer(); ?>
