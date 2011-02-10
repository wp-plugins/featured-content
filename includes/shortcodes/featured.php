<?php

if ( preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF']) ) {
     die('You are not allowed to call this page directly.');
}

/**
 * featured.php - View for the Contributors page.
 *
 * @package Featured Content
 * @subpackage includes/shortcodes
 * @author GrandSlambert
 * @copyright 2009-2011
 * @access public
 * @since 0.1
 */
function featured_content_shortcode($atts) {
     global $featuredContentPlugin, $post;

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

     $features = get_posts($options);

     include($featuredContentPlugin->get_template('featured-shortcode-' . $type));
}