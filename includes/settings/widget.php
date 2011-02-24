<?php
if ( preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF']) ) {
     die('You are not allowed to call this page directly.');
}
/**
 * widget.php - View for the default widget settings tab.
 *
 * @package Featured Content
 * @subpackage includes
 * @author GrandSlambert
 * @copyright 2009-2011
 * @access public
 * @since 0.1
 */
?>

<div class="postbox">
     <h3 class="handl" style="margin:0;padding:3px;cursor:default;">
          <?php _e('Widget Defaults', 'featured-content'); ?>
     </h3>
     <div class="table featured-content-table">
          <table class="form-table">
               <tr align="top">
                    <th scope="row"><label for="featured_content_widget_items"><?php _e('Default Posts to Display', 'featured-content'); ?></label></th>
                    <td>
                         <select name="<?php echo $this->optionsName; ?>[widget-items]" id="featured_content_widget_items">
                              <?php
                              for ( $i = 1; $i <= 20; ++$i ) echo "<option value='$i' " . selected($this->options['widget-items'], $i) . ">$i</option>";
                              ?>
                         </select>
                    </td>
               </tr>
               <tr align="top">
                    <th scope="row"><label for="featured_content_widget_type"><?php _e('Widget Type', 'featured-content'); ?></label></th>
                    <td>
                         <select name="<?php echo $this->optionsName; ?>[widget-type]" id="featured_content_widget_type">
                              <option value="images" <?php selected($this->options['widget-type'], 'images'); ?> ><?php _e('Use Featured Image', 'featured-content'); ?></option>
                              <option value="text" <?php selected($this->options['widget-type'], 'text'); ?> ><?php _e('Display text', 'featured-content'); ?></option>
                         </select>
                    </td>
               </tr>
               <tr align="top" class="no-border">
                    <th scope="row"><label for="featured_content_widget_target"><?php _e(' Link Target', 'featured-content'); ?></label></th>
                    <td>
                         <select name="<?php echo $this->optionsName; ?>[widget-target]" id="featured_content_widget_target">
                              <option value="0">None</option>
                              <option value="modal" <?php selected($this->options['widget-target'], 'modal'); ?>>Modal Window</option>
                              <option value="window" <?php selected($this->options['widget-target'], 'window'); ?>>New Window</option>
                              <option value="page" <?php selected($this->options['widget-target'], 'page'); ?>>Display Page</option>
                         </select>
                    </td>
               </tr>
          </table>
     </div>
</div>