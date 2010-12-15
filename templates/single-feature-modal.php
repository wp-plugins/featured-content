<?php
/**
 * The Template for displaying featured posts in a modal window.
 *
 * @package Featured Content
 * @subpackage templates
 */
global $more;
?>

<div id="modal_container">
     <div id="modal_content" role="main">

          <?php if ( have_posts ( ) )
               while (have_posts ()) : the_post(); ?>
          <?php $more = 0; // Leave in if you want to show only part of your post in the modal window. ?>
                    <div id="post-<?php the_ID(); ?>" <?php post_class('modal-post'); ?>>
                         <div class="entry-content">
                    <?php
                    if ( function_exists('has_post_thumbnail') && has_post_thumbnail() ) {
                         the_post_thumbnail('featured-content-modal-image', array('class' => 'alignright'));
                    }
                    ?>
                    <?php the_content($this->options['modal-more-text']); ?>
                    <?php wp_link_pages(array('before' => '<div class="page-link">' . __('Pages:', 'thirdstyle'), 'after' => '</div>')); ?>
               </div><!-- .entry-content -->
          </div>

          <p align="center" onclick="Modalbox.hide()" class="close-text"><?php _e('Close Window', 'featured-content'); ?></p>

          <?php endwhile; // end of the loop.    ?>

     </div><!-- #content -->
</div><!-- #container -->