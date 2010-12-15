<?php
if ( preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF']) ) {
     die('You are not allowed to call this page directly.');
}
/**
 * footer.php - View for the footer of all special pages.
 *
 * @package Featured Content
 * @subpackage includes
 * @author GrandSlambert
 * @copyright 2009-2010
 * @access public
 */
?>

<div style="clear:both;">
     <div class="postbox">
          <h3 class="handl" style="margin:0; padding:3px;cursor:default;"><?php _e('Credits', 'featured-content'); ?></h3>
          <div style="padding:8px;">
               <p>
                    <?php
                    printf(__('Thank you for trying the %1$s plugin - I hope you find it useful. For the latest updates on this plugin, vist the %2$s.', 'featured-content'),
                            $this->pluginName,
                            '<a href="http://plugins.grandslambert.com/plugins/featured-content.html" target="_blank">' . __('official site', 'featured-content') . '</a>'
                    ); ?>

<?php
                    printf(__('If you have questions about this plugin, please use our %1$s.', 'featured-content'),
                            '<a href="http://support.grandslambert.com/forum/featured-content" target="_blank">' . __('Support Forum', 'featured-content') . '</a>'
                    ); ?>
               </p>
               <p>
<?php
                    printf(__('This plugin is &copy; %1$s by %2$s and is released under the %3$s', 'featured-content'),
                            '2009-' . date("Y"),
                            '<a href="http://grandslambert.com" target="_blank">GrandSlambert, Inc.</a>',
                            '<a href="http://www.gnu.org/licenses/gpl.html" target="_blank">' . __('GNU General Public License', 'featured-content') . '</a>'
                    );
?>
               </p>
          </div>
     </div>
     <div class="postbox">
          <h3 class="handl" style="margin:0; padding:3px;cursor:default;"><?php _e('Donate', 'featured-content'); ?></h3>
          <div style="padding:8px">
               <p>
<?php printf(__('If you find this plugin useful, please consider supporting this and our other great %1$s.', 'featured-content'), '<a href="http://plugins.grandslambert.com/" target="_blank">' . __('plugins', 'featured-content') . '</a>'); ?>
                    <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8BZ3BH732RZ2N" target="_blank"><?php _e('Donate a few bucks!', 'featured-content'); ?></a>
               </p>
               <p style="text-align: center;"><a target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8BZ3BH732RZ2N"><img width="122" height="47" alt="paypal_btn_donateCC_LG" src="http://grandslambert.com/files/2010/06/btn_donateCC_LG.gif" title="paypal_btn_donateCC_LG" class="aligncenter size-full wp-image-174"/></a></p>
          </div>
     </div>
</div>