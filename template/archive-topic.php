<?php

/**
 * bbPress - Topic Archive
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

		<div id="topic-front" class="bbp-topics-front">
					<h1 class="entry-title"><?php bbp_topic_archive_title(); ?></h1>
					<div class="entry-content">

						<?php bbp_get_template_part('bbpress/content', 'archive-topic'); ?>

					</div>
				</div><!-- #topics-front -->

		</div><!-- post -->
	</div><!-- #content -->
</div><!-- #main-col -->
<?php get_footer(); ?>
