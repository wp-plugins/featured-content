<?php

if ( preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF']) ) {
     die('You are not allowed to call this page directly.');
}

/**
 * list-widget.php - sidebar widget for listing featured content.
 *
 * @package Featured Content
 * @subpackage includes/widgets
 * @author GrandSlambert
 * @copyright 2009-2010
 * @access public
 */
class FeaturedContentListWidget extends WP_Widget {

     var $options = array();

     /**
      * Constructor
      */
     function FeaturedContentListWidget() {
          global $featuredContentPlugin;

          /* translators: The description of the Featured Content widget on the Appearance->Widgets page. */
          $widget_ops = array('description' => __('List featured content on your sidebar. By GrandSlambert.', 'featured-content'));
          /* translators: The title for the Recipe List widget. */
          $this->WP_Widget('featured_content_list_widget', __('Featured Content &raquo; List', 'featured-content'), $widget_ops);

          $this->pluginPath = $featuredContentPlugin->pluginPath;
          $this->options = $featuredContentPlugin->loadSettings();
     }

     function defaults($args = array()) {
          $defaults = array(
               'title' => '',
               'items' => $this->options['widget-items'],
               'type' => $this->options['widget-type'],
               'sort-type' => $this->options['widget-sort-type'],
               'sort-order' => $this->options['widget-sort-order'],
               'widget-target' => $this->options['widget-target'],
               'more-text' => $this->options['modal-more-text'],
               'hide-current' => false,
               'length' => 20,
          );

          return wp_parse_args($args, $defaults);
     }

     /**
      * Widget code
      */
     function widget($args, $instance) {
          global $featuredContentPlugin;
          
          if ( isset($instance['error']) && $instance['error'] ) {
               return;
          }

          $instance = $this->defaults($instance);

          $options = array(
               'post_type' => 'feature',
               'order' => $instance['sort-order'],
               'numberposts' => $instance['items'],
          );

          if ( $instance['hide-current'] or true == 1 ) {
               global $post;
               $options['post__not_in'] = array($post->ID);
          }

          switch ($instance['sort-type']) {
               case 'random':
                    $options['orderby'] = 'rand';
                    break;
               case 'newest':
                    $options['orderby'] = 'date';
                    $options['order'] = 'desc';
                    break;
               default:
                    $options['orderby'] = 'title';
          }

          $features = get_posts($options);

          /* Show Title */
          print $args['before_widget'];
          if ( $instance['title'] ) {
               print $args['before_title'] . $instance['title'] . $args['after_title'];
          }

          $contents = '';

          if ( $instance['type'] != 'images' ) {
               $contents.= '<ul class="featured-content-list">';
          }


          /* Display Featured Posts */
          foreach ( $features as $feature ) {
               switch ($instance['type']) {
                    case 'images':
                         $imageAttr = array(
                              'alt' => $feature->post_title,
                              'title' => $feature->post_title
                         );

                         if ( $instance['widget-target'] == 'modal' ) {
                              $imageAttr['onclick'] = $featuredContentPlugin->get_modal_code($feature);
                         }

                         $contents.= get_the_post_thumbnail($feature->ID, 'featured-content-thumb', $imageAttr);
                         break;
                    case 'excerpt':
                         $contents.= '<li class="featured-content-item"><a href="' . get_post_permalink($feature->ID) . '">' . $feature->post_title . '</a><br>' . $featuredContentPlugin->trim_excerpt($feature->post_content, $instance['length']) . '</li>';
                         break;
                    default:
                         $contents.= '<li class="featured-content-item"><a href="' . get_post_permalink($feature->ID) . '">' . $feature->post_title . '</a></li>';
               }
          }

          if ( $instance['type'] != 'images' ) {
               $contents.= '</ul>';
          }

          print $contents;
          print $args['after_widget'];
     }

     /** @see WP_Widget::form */
     function form($instance) {
          global $featuredContentPlugin;

          $instance = $this->defaults($instance);
          include( $this->pluginPath . '/includes/widgets/list-form.php');
     }

}

add_action('widgets_init', create_function('', 'return register_widget("FeaturedContentListWidget");'));