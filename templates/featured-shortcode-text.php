<?php
if ( preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF']) ) {
     die('You are not allowed to call this page directly.');
}
/**
 * featured-shortcode-text.php - Template for shortcode with text.
 *
 * @package Featured Content
 * @subpackage templates
 * @author GrandSlambert
 * @copyright 2009-2011
 * @access public
 * @since 0.1
 */
?>

<?php if ( count($features) ) : ?>
     <ul class="featured-content-shortcode-list">

     <?php foreach ( $features as $feature ) : ?>

          <li class="featured-content-shortcode-item">
               <a href="<?php echo get_post_permalink($feature); ?>"><?php echo $feature->post_title; ?></a><br>
          <?php echo $featuredContentPlugin->trim_excerpt($feature->post_content, $words); ?>
     </li>

     <?php endforeach; ?>
     </ul>
<?php endif; ?>
