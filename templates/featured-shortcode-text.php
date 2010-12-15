<?php
/**
 * The Template for displaying featured posts images in a shortcode.
 *
 * @package Featured Content
 * @subpackage templates
 */
if ( count($features) ) :
?>
     <ul class="featured-content-shortcode-list">

     <?php
     foreach ( $features as $feature ) {
     ?>

          <li class="featured-content-shortcode-item">
               <a href="<?php echo get_post_permalink($feature); ?>"><?php echo $feature->post_title; ?></a><br>
<?php echo $featuredContentPlugin->trim_excerpt($feature->post_content, $words); ?>
     </li>

<?php } ?>
</ul>
<?php endif; ?>
