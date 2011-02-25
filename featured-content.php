<?php

/*
  Plugin Name: Featured Content
  Plugin URI: http://plugins.grandslambert.com/plugins/featured-content.html
  Description: Creates an area to manage "featured content" that can be displayed throughout the web site, in widgets, and with theme functions.
  Author: GrandSlambert
  Version: 0.3.1
  Author: GrandSlambert
  Author URI: http://www.grandslambert.com/

 * *************************************************************************

  Copyright (C) 2010-2011 GrandSlambert

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General License for more details.

  You should have received a copy of the GNU General License
  along with this program.  If not, see <http://www.gnu.org/licenses/>.

 * *************************************************************************
 */

require_once('includes/initialize.php');

class featuredContentPlugin {

     var $menuName = 'featured-content-plugin';
     var $pluginName = 'Featured Content';
     var $version = '0.3.1';
     var $optionsName = 'featured-content-options';
     var $xmlURL = 'http://grandslambert.com/xml/featured-content/';
     var $makeLink = false;

     /**
      * Initiate the plugin
      */
     function featuredContentPlugin() {
          /* Load Langague Files */
          load_plugin_textdomain('featured-content', false, dirname(plugin_basename(__FILE__)) . '/lang');

          /* Plugin settings */
          $this->pluginName = __('Featured Content Plugin', 'featured-content');
          $this->pluginPath = WP_PLUGIN_DIR . '/' . basename(dirname(__FILE__));
          $this->pluginURL = WP_PLUGIN_URL . '/' . basename(dirname(__FILE__));
          $this->load_settings();

          /* Add Actions and Filters */
          add_action('wp_loaded', array(&$this, 'wp_loaded'));
          add_action('wp_print_styles', array(&$this, 'print_styles'));
          add_action('wp_print_scripts', array(&$this, 'print_scripts'));
          add_action('admin_menu', array(&$this, 'admin_menu'));
          add_filter('plugin_action_links', array(&$this, 'plugin_action_links'), 10, 2);
          add_action('admin_init', array(&$this, 'admin_init'));
          add_action('update_option_' . $this->optionsName, array(&$this, 'update_option'), 10);
          add_action('query_vars', array(&$this, 'query_vars'));
          add_action('template_redirect', array(&$this, 'template_redirect'));
          add_action('right_now_content_table_end', array(&$this, 'right_now_content_table_end'));

          /* Add shortcodes */
          add_shortcode('featured', array(&$this, 'featured_content_shortcode'));
          add_shortcode('featured-content', array(&$this, 'featured_content_shortcode'));

          /* Initialize the content type */
          $init = new featuredContentPlugin_Init($this->options);
     }

     /**
      * Load the plugin options.
      *
      * @return array
      */
     function load_settings() {
          $options = get_option($this->optionsName);

          $defaults = array(
               /* Post Type Options */
               'index-slug' => 'features',
               'identifier' => 'feature',
               'permalink' => '%identifier%' . get_option('permalink_structure'),
               'plural-name' => __('Features', 'featured-content'),
               'singular-name' => __('Feature', 'featured-content'),
               'use-thumbnails' => !is_array($options),
               'use-comments' => false,
               'use-trackbacks' => false,
               'use-custom-fields' => false,
               'use-revisions' => false,
               'use-taxonomies' => false,
               /* Image settings */
               'thumbnail-width' => 200,
               'thumbnail-height' => 125,
               'modal-image-width' => 250,
               'modal-image-height' => 250,
               'shortcode-image-width' => 200,
               'shortcode-image-height' => 200,
               /* Widget Settings */
               'widget-items' => 10,
               'widget-type' => 'images',
               'widget-target' => 'modal',
               'widget-sort-type' => 'title',
               'widget-sort-order' => 'asc',
               /* Modal Boxes */
               'modal-more-text' => __('Read More &rarr;', 'featured-content'),
               'modal-title' => __('Featured Content', 'featured-content'),
               'modal-overlay-close' => false,
               'modal-width' => 500,
               'modal-height' => -1,
               'modal-loading' => __('Please wait while we load the featured content', 'featured-content'),
               'modal-close' => __('Close Content', 'featured-content'),
               'modal-opacity' => .65,
               'modal-duration' => 1,
               'modal-down-duration' => 1,
               'modal-up-duration' => 1,
               /* Non-configurable settings */
               'menu-icon' => $this->pluginURL . '/images/featured.png',
          );

          $this->options = wp_parse_args($options, $defaults);

          /* Set up thumbnail size */
          add_image_size('featured-content-thumb', $this->options['thumbnail-width'], $this->options['thumbnail-height'], true);
          add_image_size('featured-content-modal-image', $this->options['modal-image-width'], $this->options['modal-image-height'], true);
          add_image_size('featured-content-shortcode-image', $this->options['shortcode-image-width'], $this->options['shortcode-image-height'], true);

          /* Add support for featured images */
          if ( $this->options['use-thumbnails'] ) {
               add_theme_support('post-thumbnails');
          }

          return $this->options;
     }

     /**
      * Add the admin page for the settings panel.
      *
      * @global string $wp_version
      */
     function admin_menu() {
          global $wp_version, $wpdb;

          $pages = array();

          $pages[] = add_submenu_page('edit.php?post_type=feature', 'Settings', 'Settings', 'edit_posts', $this->menuName, array(&$this, 'settings'));

          foreach ( $pages as $page ) {
               add_action('admin_print_styles-' . $page, array(&$this, 'admin_styles'));
               add_action('admin_print_scripts-' . $page, array(&$this, 'admin_scripts'));
          }
          // Use the bundled jquery library if we are running WP 2.5 or above
          if ( version_compare($wp_version, '2.5', '>=') ) {
               wp_enqueue_script('jquery', false, false, '1.2.3');
          }
     }

     /**
      * Add a configuration link to the plugins list.
      *
      * @staticvar object $this_plugin
      * @param array $links
      * @param array $file
      * @return array
      */
     function plugin_action_links($links, $file) {
          static $this_plugin;

          if ( !$this_plugin ) {
               $this_plugin = plugin_basename(__FILE__);
          }

          if ( $file == $this_plugin ) {
               $settings_link = '<a href="' . get_admin_url() . 'edit.php?post_type=feature&page=' . $this->menuName . '">' . __('Settings', 'featured-content') . '</a>';
               array_unshift($links, $settings_link);
          }

          return $links;
     }

     /**
      * Settings management panel.
      */
     function settings() {
          include($this->pluginPath . '/includes/settings.php');
     }

     /**
      * Settings management panel.
      */
     function contributors() {
          include($this->pluginPath . '/includes/contributors.php');
     }

     /**
      * Add the number of featured items to the Right Now area on the Dasboard.
      */
     function right_now_content_table_end() {
          if ( !post_type_exists('feature') ) {
               return false;
          }

          $num_posts = wp_count_posts('feature');
          $num = number_format_i18n($num_posts->publish);
          $text = _n($this->options['singular-name'], $this->options['plural-name'], intval($num_posts->publish));
          if ( current_user_can('edit_posts') ) {
               $num = "<a href='edit.php?post_type=feature'>$num</a>";
               $text = "<a href='edit.php?post_type=feature'>$text</a>";
          }
          echo '<td class="first b b-feature">' . $num . '</td>';
          echo '<td class="t feature">' . $text . '</td>';

          echo '</tr>';

          if ( $num_posts->pending > 0 ) {
               $num = number_format_i18n($num_posts->pending);
               $text = _n('Pending ' . $this->options['singular-name'], 'Pending ' . $this->options['plural-name'], intval($num_posts->pending));
               if ( current_user_can('edit_posts') ) {
                    $num = "<a href='edit.php?post_status=pending&post_type=feature'>$num</a>";
                    $text = "<a href='edit.php?post_status=pending&post_type=feature'>$text</a>";
               }
               echo '<td class="first b b-feature">' . $num . '</td>';
               echo '<td class="t feature">' . $text . '</td>';

               echo '</tr>';
          }
     }

     /**
      * Register styles and scripts to load on web site.
      */
     function wp_loaded() {
          wp_register_style('featuredContentCSS', $this->get_template('featured-content', '.css', 'url'));
          wp_register_style('featuredContentMBCSS', $this->get_template('modalbox', '.css', 'url'));
          wp_register_script('featuredContentJS', $this->pluginURL . '/js/featured-content.js');
          wp_register_script('featuredcontentMB', $this->pluginURL . '/js/modalbox/modalbox.js', array('prototype', 'scriptaculous'));
     }

     /**
      * Print the styles needed on the front end.
      */
     function print_styles() {
          wp_enqueue_style('featuredContentCSS');
          wp_enqueue_style('featuredContentMBCSS');
     }

     /**
      * Queue the scripts
      */
     function print_scripts() {
          wp_enqueue_script('featuredContentJS');
          wp_enqueue_script('featuredcontentMB');
     }

     /**
      * Admin Init Action
      */
     function admin_init() {
          register_setting($this->optionsName, $this->optionsName);
          wp_register_style('featuredContentAdminCSS', $this->pluginURL . '/includes/featured-content-admin.css');
          wp_register_script('featuredContentAdminJS', $this->pluginURL . '/js/featured-content-admin.js');
     }

     /**
      * Print the stylesheets needed in the admin.
      */
     function admin_styles() {
          wp_enqueue_style('featuredContentAdminCSS');
          $this->print_styles();
     }

     /**
      * Print the scripts neededin the admin.
      */
     function admin_scripts() {
          wp_enqueue_script('featuredContentAdminJS');
          $this->print_scripts();
     }

     /**
      * Shortcode handler
      * 
      * @global object $post
      * @param array $atts
      */
     function featured_content_shortcode($atts) {
          global $post;
          $old_post = $post;

          extract(shortcode_atts(array(
                       'type' => 'images',
                       'target' => 'modal',
                       'limit' => 3,
                       'sort' => 'post_title',
                       'order' => 'asc',
                       'words' => 20
                          ), $atts));

          $options = array(
               'post_type' => 'feature',
               'orderby' => $sort,
               'order' => $order,
               'numberposts' => $limit,
          );

          $features = new WP_query($options);

          ob_start();
          include($this->get_template('featured-shortcode-' . $type));
          $content = ob_get_contents();
          ob_end_clean();

          $post = $old_post;

          return $content;
     }

     /**
      * Build the modal click options
      */
     function get_modal_code($feature) {
          if ( !$this->options['modal-overlay-close'] ) {
               $this->options['modal-overlay-close'] = 0;
          }

          return "Modalbox.show('" . get_post_permalink($feature->ID) . "?modal=true', {
               title: '" . $feature->post_title . "',
               overlayClose: " . $this->options['modal-overlay-close'] . ",
               width: " . $this->options['modal-width'] . ",
               height: " . $this->options['modal-height'] . ",
               loadingString: '" . $this->options['modal-close'] . "',
               closeString: '" . $this->options['modal-close'] . "',
               overlayOpacity: " . $this->options['modal-opacity'] . ",
               overlayDuration: " . $this->options['modal-duration'] . ",
               slideDownDuration: " . $this->options['modal-down-duration'] . ",
               slideUpDuration: " . $this->options['modal-up-duration'] . "
          })";
     }

     /**
      * Check on update option to see if we need to reset the options.
      * @param array $input
      * @return <boolean>
      */
     function update_option($input) {
          if ( $_REQUEST['confirm-reset-options'] ) {
               delete_option($this->optionsName);
               wp_redirect(admin_url('admin.php?page=featured-content-plugin&tab=' . $_POST['active_tab'] . '&reset=true'));
               exit();
          } else {
               wp_redirect(admin_url('admin.php?page=featured-content-plugin&tab=' . $_POST['active_tab'] . '&updated=true'));
               exit();
          }
     }

     /**
      * Add query vars for modal windows
      */
     function query_vars($qvars) {
          $qvars[] = 'modal';
          return $qvars;
     }

     /**
      * Redirect to template for modal windows.
      */
     function template_redirect() {
          global $wp_query, $post;

          if ( !is_object($post) ) {
               return;
          }

          if ( $post->post_type == 'feature' and isset($wp_query->query_vars['modal']) ) {
               include($this->get_template('single-feature-modal'));
               exit;
          }
     }

     /**
      * Retrieve a template file from either the theme or the plugin directory.
      *
      * @param <string> $template    The name of the template.
      * @return <string>             The full path to the template file.
      */
     function get_template($template = NULL, $ext = '.php', $type = 'path') {
          if ( $template == NULL )
               return false;

          $themeFile = get_template_directory() . '/featured-content/' . $template . $ext;

          if ( file_exists($themeFile) ) {
               if ( $type == 'url' ) {
                    $file = get_bloginfo('template_url') . '/featured-content/' . $template . $ext;
               } else {
                    $file = get_template_directory() . '/featured-content/' . $template . $ext;
               }
          } elseif ( $type == 'url' ) {
               $file = $this->pluginURL . '/templates/' . $template . $ext;
          } else {
               $file = $this->pluginPath . '/templates/' . $template . $ext;
          }

          return $file;
     }

     /**
      * Trim the excerpt
      *
      * @global  $post
      * @param <type> $text
      * @param <type> $length
      * @param <type> $suffix
      * @param <type> $allowed_tags
      * @return string
      */
     function trim_excerpt($text, $length = NULL, $suffix = '...', $allowed_tags = 'p') {
          global $post;
          $allowed_tags_formatted = '';

          $tags = explode(',', $allowed_tags);

          foreach ( $tags as $tag ) {
               $allowed_tags_formatted.= '<' . $tag . '>';
          }

          if ( !$length ) {
               //return $text;
          }

          $text = str_replace(']]>', ']]&gt;', $text);
          $text = strip_tags($text, $allowed_tags_formatted);
          $text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
          $words = explode(' ', $text, $length + 1);
          if ( count($words) > $length ) {
               array_pop($words);
               array_push($words, $suffix);
               $text = implode(' ', $words);
          }

          $tags = explode(',', $allowed_tags);
          foreach ( $tags as $tag ) {
               $text.= '</' . $tag . '>';
          }

          return $text;
     }

     /**
      * Display the contributors list.
      *
      * @param <string> $type
      * @return <string>
      */
     function show_contributors($type = 'contributors') {
          $this->showFields = array('NAME', 'LOCATION', 'COUNTRY');
          echo '<ul>';

          $xml_parser = xml_parser_create();
          xml_parser_set_option($xml_parser, XML_OPTION_CASE_FOLDING, true);
          xml_set_element_handler($xml_parser, array($this, "start_element"), array($this, "end_element"));
          xml_set_character_data_handler($xml_parser, array($this, "character_data"));

          if ( !($fp = @fopen($this->xmlURL . $type . '.xml', "r")) ) {
               /* translators: Message displayed when the contributors list cannot be accessed. */
               _e('There was an error getting the list. Try again later.', 'featured-content');
               return;
          }

          while ($data = fread($fp, 4096)) {
               if ( !xml_parse($xml_parser, $data, feof($fp)) ) {
                    die(sprintf("XML error: %s at line %d",
                                    xml_error_string(xml_get_error_code($xml_parser)),
                                    xml_get_current_line_number($xml_parser)));
               }
          }

          xml_parser_free($xml_parser);
          echo '</ul>';
     }

     function start_element($parser, $name, $attrs) {
          if ( $name == 'NAME' ) {
               echo '<li class="rp-contributor">';
          } elseif ( $name == 'ITEM' ) {
               /* translators: Used on the Contributors list to denote what a person contributed. */
               echo ' - <span class="rp_contributor_notes">' . __('Contributed: ', 'featured-content');
          }

          if ( $name == 'URL' ) {
               $this->makeLink = true;
          }
     }

     function end_element($parser, $name) {
          if ( $name == 'ITEM' ) {
               echo '</li>';
          } elseif ( $name == 'ITEM' ) {
               echo '</span>';
          } elseif ( in_array($name, $this->showFields) ) {
               echo ', ';
          }

          $this->makeLink = false;
     }

     function character_data($parser, $data) {
          if ( $this->makeLink ) {
               echo '<a href="http://' . $data . '" target="_blank">' . $data . '</a>';
               $this->makeLink = false;
          } else {
               echo $data;
               $this->makeLink = false;
          }
     }

}

/* Instantiate the Plugin */
$featuredContentPlugin = new featuredContentPlugin;

/* Set up the widgets */
require_once($featuredContentPlugin->pluginPath . '/includes/widgets/list-widget.php');