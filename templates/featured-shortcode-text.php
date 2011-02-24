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

<?php if ( $features->have_posts() ) : ?>
     <ul class="featured-content-shortcode-list">

     <?php while ($features->have_posts()) :
          $features->the_post(); ?>

          <li class="featured-content-shortcode-item">
               <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br>
          <?php echo $this->trim_excerpt(get_the_content(), $words); ?>
     </li>

     <?php endwhile; ?>
     </ul>
<?php endif; ?>
