<?php

/**
 * Template Name: bbPress - User Register
 *
 * @package bbPress
 * @subpackage Theme
 */

// No logged in users
bbp_logged_in_redirect();

// Begin Template
get_header(); ?>

<div id="main-col">
	<div id="content">

	<?php do_action('bbp_template_notices'); ?>
		<div <?php suffusion_bbpress_content_class(); ?> >

		<?php while (have_posts()) : the_post(); ?>

					<div id="bbp-register" class="bbp-register">
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<div class="entry-content">

							<?php the_content(); ?>

							<?php bbp_breadcrumb(); ?>

							<?php bbp_get_template_part('bbpress/form', 'user-register'); ?>

						</div>
					</div><!-- #bbp-register -->

				<?php endwhile; ?>

		</div><!-- post -->
	</div><!-- #content -->
</div><!-- #main-col -->
<?php get_footer(); ?>
