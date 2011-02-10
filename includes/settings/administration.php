<?php
if ( preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF']) ) {
     die('You are not allowed to call this page directly.');
}
/**
 * admin.php - View for the administration tab.
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
          <?php _e('Administration', 'featured-content'); ?>
     </h3>
     <div class="table">
          <table class="form-table cp-table">
               <tbody>
                    <tr align="top">
                         <th scope="row"><label for="featured_content_reset_options"><?php _e('Reset to default: ', 'featured-content'); ?></label></th>
                         <td><input type="checkbox" id="featured_content_reset_options" name="confirm-reset-options" value="1" onclick="verifyResetOptions(this)" /></td>
                    </tr>
                    <!--
                    <tr align="top">
                         <th scope="row"><label for="featured_content_backup_options"><?php _e('Back-up Options: ', 'featured-content'); ?></label></th>
                         <td><input type="checkbox" id="featured_content_backup_options" name="confirm-backup-options" value="1" onclick="backupOptions(this)" /></td>
                    </tr>
                    <tr align="top">
                         <th scope="row"><label for="featured_content_restore_options"><?php _e('Restore Options: ', 'featured-content'); ?></label></th>
                         <td><input type="file" id="featured_content_restore_options" name="featured-content-restore-options"/></td>
                    </tr>
                    -->
               </tbody>
          </table>
     </div>
</div>