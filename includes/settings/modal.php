<?php
if ( preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF']) ) {
     die('You are not allowed to call this page directly.');
}
/**
 * modal.php - View for the modal boxes settings tab.
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
          <?php _e('Modal Boxes', 'featured-content'); ?>
     </h3>
     <table class="form-table cp-table">
          <tr align="top">
               <th scope="row"><label for="featured_content_modal_title"><?php _e('Title', 'featured-content'); ?></label></th>
               <td><input title="<?php _e('Set the default title for the modal box.', 'featured-content'); ?>" class="input" type="text" name="<?php echo $this->optionsName; ?>[modal-title]" id="featured_content_modal_title" value="<?php echo $this->options['modal-title']; ?>" /></td>
          </tr>
          <tr align="top">
               <th scope="row"><label for="featured_content_modal_width"><?php _e('Width', 'featured-content'); ?></label></th>
               <td><input title="<?php _e('Set the default width for the modal box.', 'featured-content'); ?>" class="input" type="text" name="<?php echo $this->optionsName; ?>[modal-width]" id="featured_content_modal_width" value="<?php echo $this->options['modal-width']; ?>" /></td>
          </tr>
          <tr align="top">
               <th scope="row"><label for="featured_content_modal_height"><?php _e('Height', 'featured-content'); ?></label></th>
               <td><input title="<?php _e('Set the default height for the modal box. Enter -1 to use auto height.', 'featured-content'); ?>" class="input" type="text" name="<?php echo $this->optionsName; ?>[modal-height]" id="featured_content_modal_height" value="<?php echo $this->options['modal-height']; ?>" /></td>
          </tr>
          <tr align="top">
               <th scope="row"><label for="featured_content_modal_loading"><?php _e('Loading Text', 'featured-content'); ?></label></th>
               <td><input loading="<?php _e('Set the default loading text for the modal box.', 'featured-content'); ?>" class="input" type="text" name="<?php echo $this->optionsName; ?>[modal-loading]" id="featured_content_modal_loading" value="<?php echo $this->options['modal-loading']; ?>" /></td>
          </tr>
          <tr align="top">
               <th scope="row"><label for="featured_content_modal_more_text"><?php _e('Read More Text', 'featured-content'); ?></label></th>
               <td><input loading="<?php _e('Set the default loading text for the modal box.', 'featured-content'); ?>" class="input" type="text" name="<?php echo $this->optionsName; ?>[modal-more-text]" id="featured_content_modal_more_text" value="<?php echo $this->options['modal-more-text']; ?>" /></td>
          </tr>
          <tr align="top">
               <th scope="row"><label for="featured_content_modal_close"><?php _e('Close Text', 'featured-content'); ?></label></th>
               <td><input close="<?php _e('Set the default close text for the modal box.', 'featured-content'); ?>" class="input" type="text" name="<?php echo $this->optionsName; ?>[modal-close]" id="featured_content_modal_close" value="<?php echo $this->options['modal-close']; ?>" /></td>
          </tr>
          <tr align="top">
               <th scope="row"><label for="featured_content_modal_overlay_close"><?php _e('Close on overlay click', 'featured-content'); ?></label></th>
               <td><input type="checkbox" title="<?php _e('If checked, modal window will close when viewer clicks anywhere on the overlay', 'featured-content'); ?>" name="<?php echo $this->optionsName; ?>[modal-overlay-close]" id="featured_content_modal_overlay_close" value="1" <?php checked($this->options['modal-overlay-close'], true); ?> /></td>
          </tr>
          <tr align="top">
               <th scope="row"><label for="featured_content_modal_opacity"><?php _e('Overlay Opacity', 'featured-content'); ?></label></th>
               <td>
                    <input title="<?php _e('Set the default overlay opacity (between 0 and 1) for the modal box.', 'featured-content'); ?>" class="input" type="text" name="<?php echo $this->optionsName; ?>[modal-opacity]" id="featured_content_modal_opacity" value="<?php echo $this->options['modal-opacity']; ?>" />
                    <span><?php _e('Must be a decimal value between 0 and 1 only!', 'featured-content'); ?></span>
               </td>
          </tr>
          <tr align="top">
               <th scope="row"><label for="featured_content_modal_duration"><?php _e('Overlay Duration', 'featured-content'); ?></label></th>
               <td><input title="<?php _e('Set the default overlay duration in seconds for the modal box.', 'featured-content'); ?>" class="input" type="text" name="<?php echo $this->optionsName; ?>[modal-duration]" id="featured_content_modal_duration" value="<?php echo $this->options['modal-duration']; ?>" /></td>
          </tr>
          <tr align="top">
               <th scope="row"><label for="featured_content_modal_down_duration"><?php _e('Down Duration', 'featured-content'); ?></label></th>
               <td><input title="<?php _e('Set the default down in seconds for the modal box.', 'featured-content'); ?>" class="input" type="text" name="<?php echo $this->optionsName; ?>[modal-down-duration]" id="featured_content_modal_down_duration" value="<?php echo $this->options['modal-down-duration']; ?>" /></td>
          </tr>
          <tr align="top">
               <th scope="row"><label for="featured_content_modal_up_duration"><?php _e('Up Duration', 'featured-content'); ?></label></th>
               <td><input title="<?php _e('Set the default up duration in seconds for the modal box.', 'featured-content'); ?>" class="input" type="text" name="<?php echo $this->optionsName; ?>[modal-up-duration]" id="featured_content_modal_up_duration" value="<?php echo $this->options['modal-up-duration']; ?>" /></td>
          </tr>
          <tr align="top" class="no-border">
               <td align="center" colspan="2">
                    <a href="#" onclick="Modalbox.show('<?php echo $this->pluginURL; ?>/includes/sample-modal-box.html', {
                         title: document.getElementById('featured_content_modal_title').value,
                         overlayClose: document.getElementById('featured_content_modal_overlay_close').checked,
                         width: document.getElementById('featured_content_modal_width').value,
                         height: document.getElementById('featured_content_modal_height').value,
                         loadingString: document.getElementById('featured_content_modal_loading').value,
                         closeString: document.getElementById('featured_content_modal_close').value,
                         overlayOpacity: document.getElementById('featured_content_modal_opacity').value,
                         overlayDuration: document.getElementById('featured_content_modal_duration').value,
                         slideDownDuration: document.getElementById('featured_content_modal_down_duration').value,
                         slideUpDuration: document.getElementById('featured_content_modal_up_duration').value
                    })"><?php _e('Show Example', 'featured-content'); ?></a>
               </td>
          </tr>
     </table>
</div>