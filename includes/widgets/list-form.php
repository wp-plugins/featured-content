<?php
if ( preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF']) ) {
     die('You are not allowed to call this page directly.');
}
/**
 * list-form.php - featured content list widget form.
 *
 * @package Featured Content
 * @subpackage includes/widgets
 * @author GrandSlambert
 * @copyright 2009-2010
 * @access public
 */
?>

<p>
     <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title (optional):', 'featured-content'); ?></label>
     <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
</p>
<p>
     <label for="<?php echo $this->get_field_id('items'); ?>"><?php _e('How many items would you like to display?', 'featured-content'); ?></label>
     <select name="<?php echo $this->get_field_name('items'); ?>" id="<?php echo $this->get_field_id('items'); ?>">
          <option value="default" <?php selected($instance['items'], 'default'); ?>><?php _e('Always use default', 'featured-content'); ?></option>
          <?php
          for ( $i = 1; $i <= 20; ++$i ) echo "<option value='$i' " . ( $instance['items'] == $i ? "selected='selected'" : '' ) . ">$i</option>";
          ?>
     </select>
</p>
<p>
     <label for="<?php echo $this->get_field_id('hide-current'); ?>"><?php _e('Hide Current Post?', 'featured-content'); ?></label>
     <input type="checkbox" name="<?php echo $this->get_field_name('hide-current'); ?>" id="<?php echo $this->get_field_id('hide-current'); ?>" value="1" <?php checked($instance['hide-current'], 1); ?> />
<p>
     <label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Display Type:', 'featured-content'); ?></label>
     <select name="<?php echo $this->get_field_name('type'); ?>" id="<?php echo $this->get_field_id('type'); ?>">
          <option value="images" <?php selected($instance['type'], 'images'); ?> ><?php _e('Use Featured Image', 'featured-content'); ?></option>
          <option value="title" <?php selected($instance['type'], 'title'); ?> ><?php _e('Display Titles', 'featured-content'); ?></option>
          <option value="excerpt" <?php selected($instance['type'], 'excerpt'); ?> ><?php _e('Display Excerpts', 'featured-content'); ?></option>
     </select>
</p>
<p>
     <label for="<?php echo $this->get_field_id('length'); ?>"><?php _e('Length of Excerpt:', 'featured-content'); ?></label>
     <input class="number" id="<?php echo $this->get_field_id('length'); ?>" name="<?php echo $this->get_field_name('length'); ?>" type="text" value="<?php echo $instance['length']; ?>" /> <?php _e('words', 'featured-content'); ?>
</p>
<p>
     <label for="<?php echo $this->get_field_id('sort-type'); ?>"><?php _e('Sort Order:', 'featured-content'); ?></label>
     <select name="<?php echo $this->get_field_name('sort-type'); ?>" id="<?php echo $this->get_field_id('sort-type'); ?>">
          <option value="title" <?php selected($instance['sort-type'], 'title'); ?> ><?php _e('Title', 'featured-content'); ?></option>
          <option value="newest" <?php selected($instance['sort-type'], 'newest'); ?>><?php _e('Newest', 'featured-content'); ?></option>
          <option value="random" <?php selected($instance['sort-type'], 'random'); ?>><?php _e('Random', 'featured-content'); ?></option>
     </select>
</p>
<p>
     <label for="<?php echo $this->get_field_id('sort-order'); ?>"><?php _e('Sort Order:', 'featured-content'); ?></label>
     <select name="<?php echo $this->get_field_name('sort-order'); ?>" id="<?php echo $this->get_field_id('sort-order'); ?>">
          <option value="ASC" <?php selected($instance['sort-order'], 'ASC'); ?> ><?php _e('Ascending', 'featured-content'); ?></option>
          <option value="DESC" <?php selected($instance['sort-order'], 'DESC'); ?>><?php _e('Descending', 'featured-content'); ?></option>
     </select>
</p>
<p>
     <label for="<?php echo $this->get_field_id('target'); ?>"><?php _e('Link Target:', 'featured-content'); ?></label>
     <select name="<?php echo $this->get_field_name('target'); ?>" id="<?php echo $this->get_field_id('target'); ?>">
          <option value="0">None</option>
          <option value="modal" <?php selected($instance['widget-target'], 'modal'); ?>><?php _e('Modal Window', 'featured-content'); ?></option>
          <option value="window" <?php selected($instance['widget-target'], 'window'); ?>><?php _e('New Window', 'featured-content'); ?></option>
          <option value="page" <?php selected($instance['widget-target'], 'page'); ?>><?php _e('Display Page', 'featured-content'); ?></option>
     </select>
</p>