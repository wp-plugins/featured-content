<?php
if ( preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF']) ) {
     die('You are not allowed to call this page directly.');
}
/**
 * contributors.php - View for the Contributors page.
 *
 * @package Featured Content
 * @subpackage includes
 * @author GrandSlambert
 * @copyright 2009-2011
 * @access public
 * @since 0.1
 */
?>

<div class="wrap">
     <div class="icon32" id="icon-featured-content"><br/></div>
     <h2><?php echo $this->pluginName; ?> &raquo; <?php _e('Contributors', 'featured-content'); ?></h2>
     <p><?php _e('This page includes a list of users who have contributed time or money to the development of this plugin.', 'featured-content'); ?></p>
     <div class="col-wrap" style="width:49%; float: left;">
          <div style="clear:both; margin-top:10px;">
               <div class="postbox">
                    <h3 class="handl" style="margin:0; padding:3px;cursor:default;"><?php _e('Major Contributors', 'featured-content'); ?></h3>
                    <div style="padding:8px">
<?php $this->show_contributors('major'); ?>
                    </div>
               </div>
               <div class="postbox">
                    <h3 class="handl" style="margin:0; padding:3px;cursor:default;"><?php _e('Additional Contributors', 'featured-content'); ?></h3>
                    <div style="padding:8px;">
<?php $this->show_contributors('contributors'); ?>
                    </div>
               </div>
          </div>
     </div>

     <div  style="width:49%; float:right">
<?php require_once('footer.php'); ?>
     </div>
</div>
