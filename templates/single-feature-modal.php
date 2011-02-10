<?php
if ( preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF']) ) {
     die('You are not allowed to call this page directly.');
}
/**
 * single-feature-modal.php - Modal window for single posts.
 *
 * @package Featured Content
 * @subpackage templates
 * @author GrandSlambert
 * @copyright 2009-2011
 * @access public
 * @since 0.1
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