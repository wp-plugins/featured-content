<?php

/**
 * The Template for displaying featured posts images in a shortcode.
 *
 * @package Featured Content
 * @subpackage templates
 */
if ( count($features) ) {
     foreach ( $features as $feature ) {
          setup_postdata($feature); /* Does not seem to work! */

          if ( function_exists('has_post_thumbnail') && has_post_thumbnail() ) {
               /* These are the settings for the image. */
               $settings = array(
                    'class' => 'featured-content-shortcode-image',
                    'alt' => get_the_title($feature),
                    'title' => get_the_title($feature),
               );

               switch ($target) {
                    case 'modal':
                         $settings['onclick'] = $featuredContentPlugin->get_modal_code($feature);
                         the_post_thumbnail('featured-content-shortcode-image', $settings);
                         break;
                    default:
                         echo '<a href="<?php the_permalink(); ?>">';
                         the_post_thumbnail('featured-content-modal-image', $settings);
                         echo '</a>';
               }
          }
     }
}