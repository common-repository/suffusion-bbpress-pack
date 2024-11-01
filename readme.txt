=== Suffusion bbPress Pack ===
Contributors: sayontan
Donate link: http://aquoid.com/news/plugins/suffusion-bbpress-pack/
License: GPL v3 or later
Tags: suffusion, bbpress
Requires at least: WP 3.1, Suffusion 4.0.0, bbPress 2.0
Tested up to: WP 3.4.1
Stable tag: trunk

A compatibility plugin to get bbPress running on your Suffusion-based website.

== Description ==

Suffusion bbPress Pack helps add bbPress support to your <a href='http://wordpress.org/extend/themes/suffusion'>Suffusion</a>-based site.
It works by copying a handful of template files to your (child) theme directory. The templates are based on the default bbPress TwentyTen theme,
modified suitably to match Suffusion's markup.

= Pre-requisites =

You need the following to use the plugin:

*	<a href='http://wordpress.org/extend/plugins/bbpress/'>bbPress</a> 2.0 (or higher)
*	<a href='http://wordpress.org/extend/themes/suffusion/'>Suffusion</a> 4.0.0 (or higher)
*	A child theme of Suffusion. If you are unsure about creating one, use the <a href='http://aquoid.com/news/2012/02/suffu-scion-a-starter-child-theme-for-suffusion/'>starter pack</a>.

Using a child theme is strongly recommended, to avoid accidentally wiping your main theme installation clean during a theme upgrade.

== Installation ==

You can install the plugin through the WordPress installer under <strong>Plugins &rarr; Add New</strong> by searching for it,
or by uploading the file downloaded from here. Alternatively you can download the file from here, unzip it and move the unzipped
contents to the <code>wp-content/plugins</code> folder of your WordPress installation. You will then be able to activate the plugin.

Once you have installed the plugin, activate it from <strong>Plugins &rarr; Installed Plugins</strong>. This will create a new
menu item, <strong>Appearance &rarr; Suffusion bbPress Pack</strong>. When you visit this tab, you will see an option to "(Re)Build bbPress Files".
Click on that, and the appropriate files will be copied to your theme folder. Your installation of Suffusion is now bbPress-ready!

== Screenshots ==

None.

== Frequently Asked Questions ==

= What happens if I don't use a child theme? =

Short answer - very bad things. Suffusion is a theme that gets regular updates. A theme update will wipe out your existing
theme installation folder. Since the plugin copies files to your theme installation folder, you might suddenly be left with
broken bbPress files on your site. Using a child theme ensures that if you upgrade Suffusion, your child theme files will
remain untouched.

= Can I use this along with Suffusion BuddyPress Pack? =

Absolutely. You shouldn't have any issues getting them to work together.

== Changelog ==

= 1.01 =

*	Added some checks to prevent fatal errors in case bbPress is not activated.
*   Viewing of group forum topics was causing an error. This has been fixed.

= 1.00 =

*	New version created.

== Upgrade Notice ==

No upgrade notices at this point.