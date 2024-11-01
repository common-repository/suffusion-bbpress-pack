<?php

/**
 * Topic Tag Edit
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

			<div id="topic-tag" class="bbp-topic-tag">
				<h1 class="entry-title"><?php printf(__('Topic Tag: %s', 'bbpress'), '<span>' . bbp_get_topic_tag_name() . '</span>'); ?></h1>

				<div class="entry-content">

					<?php bbp_breadcrumb(); ?>

					<?php bbp_topic_tag_description(); ?>

					<?php do_action('bbp_template_before_topic_tag_edit'); ?>

					<?php bbp_get_template_part('bbpress/form', 'topic-tag'); ?>

					<?php do_action('bbp_template_after_topic_tag_edit'); ?>

				</div>
			</div><!-- #topic-tag -->
		</div><!-- post -->
	</div><!-- #content -->
</div><!-- #main-col -->
<?php get_footer(); ?>