<?php
/**
 * bbPress - Forum Archive
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

			<div id="forum-front" class="bbp-forum-front">
				<h1 class="entry-title"><?php bbp_forum_archive_title(); ?></h1>
				<div class="entry-content">

					<?php bbp_get_template_part('bbpress/content', 'archive-forum'); ?>

				</div>
			</div><!-- #forum-front -->

		</div><!-- post -->
	</div><!-- #content -->
</div><!-- #main-col -->
<?php get_footer(); ?>
