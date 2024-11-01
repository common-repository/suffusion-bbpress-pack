<?php
/**
 * Plugin Name: Suffusion bbPress Pack
 * Plugin URI: http://aquoid.com/news/plugins/suffusion-bbpress-pack/
 * Description: This plugin is an add-on to the Suffusion WordPress Theme. It sets up your Suffusion installation as being bbPress compatible
 * Version: 1.01
 * Author: Sayontan Sinha
 * Author URI: http://mynethome.net/blog
 * License: GNU General Public License (GPL), v3 (or newer)
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * Copyright (c) 2009 - 2012 Sayontan Sinha. All rights reserved.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

include_once(plugin_dir_path(__FILE__).'/suffusion-integration-pack.php');

class Suffusion_bbPress_Pack extends Suffusion_Integration_Pack {
	var $templates_copied;
	function __construct() {
		if (!defined('SUFFUSION_BBPRESS_PACK_VERSION')) {
			define('SUFFUSION_BBPRESS_PACK_VERSION', '1.01');
		}

		$this->templates_copied = false;
		add_theme_support('bbpress');
		parent::__construct('Suffusion bbPress Pack', 'Suffusion bbPress Pack', 'suffusion-bbpress-pack', SUFFUSION_BBPRESS_PACK_VERSION);

		// Handles the ajax favorite/unfavorite
		add_action('wp_ajax_dim-favorite', array($this, 'ajax_favorite'));

		// Handles the ajax subscribe/unsubscribe
		add_action('wp_ajax_dim-subscription', array($this, 'ajax_subscription'));
	}

	function admin_menu() {
		if ((isset($_GET['page']) && $_GET['page'] == 'suffusion-bbpress-pack') && isset($_REQUEST['suffusion_copy_bbpress_template'])) {
			$check = check_admin_referer('suffusion-bbpress-save', 'suffusion-bbpress-wpnonce');
			if ($check) {
				$this->move_template_files();
				$this->templates_copied = true;
			}
		}

		parent::admin_menu();
	}

	function add_admin_scripts($hook) {
		if (!is_admin()) {
			return;
		}

		if ($this->option_page == $hook) {
//			wp_enqueue_script('jquery');
			wp_enqueue_style('suffusion-bbpress-admin', plugins_url('include/css/admin.css', __FILE__), array(), $this->version);
			wp_enqueue_style('suffusion-bbpress-dosis', 'http://fonts.googleapis.com/css?family=Dosis', array(), $this->version);
		}
	}

	function add_scripts() {
		// Right to left
		if (is_rtl()) {
			wp_enqueue_style('suffusion-bbpress-style', plugins_url('include/css/bbpress-rtl.css', __FILE__), '', $this->version, 'screen');
		}
		else {
			wp_enqueue_style('suffusion-bbpress-style', plugins_url('include/css/bbpress.css', __FILE__), '', $this->version, 'screen');
		}

		if (!function_exists('bbp_is_single_topic')) {
			return;
		}

		if (bbp_is_single_topic()) {
			wp_enqueue_script('suffusion-bbpress-topic', plugins_url('include/js/topic.js', __FILE__), array('wp-lists'), $this->version);
		}

		if (function_exists('bbp_is_single_user_edit') && bbp_is_single_user_edit()) {
			wp_enqueue_script('user-profile');
		}

		// Bail if not viewing a single topic
		if (!bbp_is_single_topic())
			return;

		// Bail if user is not logged in
		if (!is_user_logged_in())
			return;

		if (bbp_is_single_topic() && is_user_logged_in()) {
			$user_id = bbp_get_current_user_id();

			$localizations = array(
				'currentUserId' => $user_id,
				'topicId' => bbp_get_topic_id(),
			);

			// Favorites
			if (function_exists('bbp_is_favorites_active') && bbp_is_favorites_active()) {
				$localizations['favoritesActive'] = 1;
				$localizations['favoritesLink'] = bbp_get_favorites_permalink($user_id);
				$localizations['isFav'] = (int) bbp_is_user_favorite($user_id);
				$localizations['favLinkYes'] = __('favorites', 'bbpress');
				$localizations['favLinkNo'] = __('?', 'bbpress');
				$localizations['favYes'] = __('This topic is one of your %favLinkYes% [%favDel%]', 'bbpress');
				$localizations['favNo'] = __('%favAdd% (%favLinkNo%)', 'bbpress');
				$localizations['favDel'] = __('&times;', 'bbpress');
				$localizations['favAdd'] = __('Add this topic to your favorites', 'bbpress');
			}
			else {
				$localizations['favoritesActive'] = 0;
			}

			// Subscriptions
			if (function_exists('bbp_is_subscriptions_active') && bbp_is_subscriptions_active()) {
				$localizations['subsActive'] = 1;
				$localizations['isSubscribed'] = (int) bbp_is_user_subscribed($user_id);
				$localizations['subsSub'] = __('Subscribe', 'bbpress');
				$localizations['subsUns'] = __('Unsubscribe', 'bbpress');
				$localizations['subsLink'] = bbp_get_topic_permalink();
			}
			else {
				$localizations['subsActive'] = 0;
			}

			wp_localize_script('suffusion-bbpress-topic', 'bbpTopicJS', $localizations);
		}
	}

	function direct_scripts() {
		if (is_admin() || !function_exists('bbp_is_single_topic')) {
			return;
		}

		if (bbp_is_single_topic()) { ?>
		<script type='text/javascript'>
			/* <![CDATA[ */
			var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
			/* ]]> */
		</script>
		<?php
		}
		else if (bbp_is_single_user_edit()) {
			?>
		<script type="text/javascript" charset="utf-8">
			if (window.location.hash == '#password') {
				document.getElementById('pass1').focus();
			}
		</script>
		<?php
		}
	}

	function render_options() {?>
	<div class="suf-ip-wrapper">
		<h1>Welcome to the Suffusion bbPress Pack</h1>
		<?php
		$this->check_theme();
		if ($this->templates_copied) {
		?>
		<div id="suf_bbp_return_message" class="updated">The template files have been successfully copied.</div>
			<?php
		}
		?>
		<p>
			This plugin will help you if you are using bbPress and would like to take advantage of all the options offered
			by the <a href="http://www.aquoid.com/news/themes/suffusion">Suffusion</a> WordPress Theme. The plugin makes heavy use
			of design aspects from the default theme included with bbPress.
		</p>

		<form method="post" name="copy_template_form" id="copy_template_form">
			<fieldset>
				<legend>(Re)Build bbPress Files</legend>
				<p>
					If you are starting out afresh with bbPress on Suffusion or Suffusion on bbPress, this is the first thing you should do.
					Since the default bbPress HTML markup is different from Suffusion's markup, this step will help (re)create your templates.
					You should be using a child theme of Suffusion before you start using this theme. Otherwise if you update Suffusion from the
					WP themes repository you will lose all the bbPress-specific files.
				</p>
				<p>
					Please note that all your template files will be written to <strong><?php echo get_stylesheet_directory(); ?></strong>.
				</p>

				<input name="suffusion_copy_bbpress_template" type="submit" value="(Re)Build bbPress Files" class="button"/>
				<?php wp_nonce_field('suffusion-bbpress-save', 'suffusion-bbpress-wpnonce'); ?>
			</fieldset>
		</form>

		<fieldset>
			<legend>Help and Support</legend>
			<p>
				For support queries please feel free to contact the developer at <a href="http://aquoid.com/forum">Suffusion's support forum</a>.
			</p>
		</fieldset>

		<?php $this->other_plugins(); ?>
	</div>
	<?php
	}

	function ajax_favorite() {
		$user_id = bbp_get_current_user_id();
		$id = intval($_POST['id']);

		if (!current_user_can('edit_user', $user_id))
			die('-1');

		if (!$topic = bbp_get_topic($id))
			die('0');

		check_ajax_referer('toggle-favorite_' . $topic->ID);

		if (bbp_is_user_favorite($user_id, $topic->ID)) {
			if (bbp_remove_user_favorite($user_id, $topic->ID)) {
				die('1');
			}
		} else {
			if (bbp_add_user_favorite($user_id, $topic->ID)) {
				die('1');
			}
		}

		die('0');
	}

	function ajax_subscription() {
		if (!bbp_is_subscriptions_active())
			return;

		$user_id = bbp_get_current_user_id();
		$id = intval($_POST['id']);

		if (!current_user_can('edit_user', $user_id))
			die('-1');

		if (!$topic = bbp_get_topic($id))
			die('0');

		check_ajax_referer('toggle-subscription_' . $topic->ID);

		if (bbp_is_user_subscribed($user_id, $topic->ID)) {
			if (bbp_remove_user_subscription($user_id, $topic->ID)) {
				die('1');
			}
		} else {
			if (bbp_add_user_subscription($user_id, $topic->ID)) {
				die('1');
			}
		}

		die('0');
	}

	function move_template_files() {
		$source_folder = plugin_dir_path(__FILE__).'/template/';
		$target_folder = trailingslashit(get_stylesheet_directory());
		$this->recurse_copy($source_folder, $target_folder);
	}

	/**
	 * Recursively copies plugin-specific folders from the template directory to the child theme's folder.
	 *
	 * @param $source
	 * @param $target
	 * @return bool
	 */
	function recurse_copy($source, $target) {
		$dir = @opendir($source);

		if (!file_exists($target)) {
			if (!@mkdir($target)) {
				return false;
			}
		}

		while (false !== ($file = readdir($dir))) {
			if (($file != '.') && ($file != '..')) {
				if (is_dir($source.'/'.$file)) {
					$this->recurse_copy($source.'/'.$file, $target.'/'.$file);
				}
				else {
					if (!@copy($source.'/'.$file, $target.'/'.$file)) {
						return false;
					}
				}
			}
		}

		@closedir($dir);
		return true;
	}
}

add_action('init', 'init_suffusion_bbpress_pack');
function init_suffusion_bbpress_pack() {
	global $Suffusion_bbPress_Pack;
	$Suffusion_bbPress_Pack = new Suffusion_bbPress_Pack();
}

function suffusion_bbpress_content_class() {
	echo " class='post' ";
}