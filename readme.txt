=== Featured Content ===
Contributors: grandslambert
Donate link: http://plugins.grandslambert.com/featured-content-donate
Tags: content, sidebar, widget, featured image, modal window, shortcode
Requires at least: 3.0
Tested up to: 3.1
Stable tag: trunk

Creates an area to manage "featured content" that can be displayed throughout the web site, in widgets, and with theme functions.

== Description ==

Creates a custom post type for "featured content" which can be displayed in widgets and other parts of the
site. Uses featured images and modal windows for displaying content.

= Features =

* Creates a custom post type that supports all the features of standard posts.
* Support for pretty permalinks on featured posts.
* Automatically lists all featured posts using a custom URL structure.
* Supports post thumbnails and automatically adds support in themes that do not support featured images.
* Feature content in your sidebars with widgets that can open new pages or modal windows.
* Uses the "Read More" capability in WordPress to display partial text in modal windows.
* Ability to hide the post being displayed in sidebar widgets.
* Uses the Modalbox library, included with the plugin.

== Installation ==

1. Upload `featured-content` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Use the widgets or shortcodes to feature content on your site.

== Frequently Asked Questions ==

= What does this plugin do? =

This plugin allows you to create featured items to be used in sidebars and posts. Links to posts can either
open the full page, open in a new window, or open in a modal box with a link to the full post.

= How can I get support for this plugin? =

Support for this plugin is handled on our support forum at http://support.grandslambert.com/forum/featured-content

== Screenshots ==

1. An example of the modal windows created by this plugin
1. An example of using the short code on a post to display 6 images.
1. An example of the widget using the featured images.

== Changelog ==

= 0.3.1 - February 25th, 2011 =

* Fixed an issue where the shortcode displayed content in the wrong place.

= 0.3 - February 24th, 2011 =

* Changed how posts are looped in templates to use template tags.
* Improved support for WordPress version 3.1.
* Moved the shortcode function into core code to reduce load.
* Added support for archive and index tempalte files for post type.
* Added an index-slug for the permalinks for the list page.

= 0.2 - February 10th, 2011 =

* Fixed some code that was causing formatting issues on some themes.
* Renamed several functions to avoid conflicts with other plugins.
* Cleaned up code and added more comments.

= 0.1 - December 15h, 2010 =

* Initial release

== Upgrade Notice ==

= 0.3 =
Includes updates to be compatible with WordPress 3.1 and other new features.

= 0.2 =
Update if you are having issues with sidebars breaking on your theme.

= 0.1 =
First release - not really needed.