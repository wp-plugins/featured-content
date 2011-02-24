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
 * @copyright 2009-2011
 * @access public
 * @since 0.1
 */
?>

<div id="featured_content_footer" class="featured-content-footer">
     <div class="postbox" style="width:49%; float:left">
          <h3 class="handl" style="margin:0; padding:3px;cursor:default;"><?php _e('Credits', 'featured-content'); ?></h3>
          <div style="padding:8px;">
               <p>
                    <?php
                    printf(__('Thank you for trying the %1$s plugin - I hope you find it useful. For the latest updates on this plugin, vist the %2$s.', 'featured-content'),
                            $this->pluginName,
                            '<a href="http://plugins.grandslambert.com/plugins/featured-content.html" target="_blank">' . __('official site', 'featured-content') . '</a>'
                    ); ?>

                    <?php
                    printf(__('If you have questions about this plugin, please use our %1$s or visit the %2$s.', 'featured-content'),
                            '<a href="http://support.grandslambert.com/forum/featured-content" target="_blank">' . __('Support Forum', 'featured-content') . '</a>',
                            '<a href="http://docs.grandslambert.com/wiki/Featured_Content" target="_blank">' . __('Documentation Page', 'featured-content') . '</a>'
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
     <div class="postbox" style="width:49%; float:right">
          <h3 class="handl" style="margin:0; padding:3px;cursor:default;"><?php _e('Donate', 'featured-content'); ?></h3>
          <div style="padding:8px">
               <p>
                    <?php printf(__('If you find this plugin useful, please consider supporting this and our other great %1$s.', 'featured-content'), '<a href="http://plugins.grandslambert.com/" target="_blank">' . __('plugins', 'featured-content') . '</a>'); ?>
                    <a href="http://plugins.grandslambert.com/featured-content-donate" target="_blank"><?php _e('Donate a few bucks!', 'featured-content'); ?></a>
               </p>
               <p style="text-align: center;"><a target="_blank" href="http://plugins.grandslambert.com/featured-content-donate"><img width="122" height="47" alt="paypal_btn_donateCC_LG" src="http://grandslambert.com/files/2010/06/btn_donateCC_LG.gif" title="paypal_btn_donateCC_LG" class="aligncenter size-full wp-image-174"/></a></p>
          </div>
     </div>
</div>