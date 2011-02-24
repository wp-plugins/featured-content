<?php
if ( preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF']) ) {
     die('You are not allowed to call this page directly.');
}
/**
 * sidebar-boxes.php - View for the sidebar on the settings page.
 *
 * @package Featured Content
 * @subpackage includes
 * @author GrandSlambert
 * @copyright 2009-2011
 * @access public
 * @since 0.3
 */
?>

<div style="clear:both;">
     <div class="postbox">
          <h3 class="handl" style="margin:0; padding:3px;cursor:default;"><?php _e('Permalink Instructions', 'featured-content'); ?></h3>
          <div style="padding:8px;">
               <p>
                    <?php
                    printf(__('The permalink structure will be used to create the custom URL structure for your individual recipes. These follow WP\'s normal %1$s, but must also include the content type %2$s and at least one of these unique tags: %3$s or %4$s.', 'featured-content'),
                            '<a href="http://codex.wordpress.org/Using_Permalinks" target="_blank">' . __('permalink tags', 'featured-content') . '</a>',
                            '<strong>%identifier%</strong>',
                            '<strong>%postname%</strong>',
                            '<strong>%post_id%</strong>'
                    );
                    ?>
               </p>
               <p>
                    <?php _e('Allowed tags: %year%, %monthnum%, %day%, %hour%, %minute%, %second%, %postname%, %post_id%', 'featured-content'); ?>
               </p>
               <p>
                    <?php
                    printf(__('For complete instructions on how to set up your permaliks, visit the %1$s.', 'featured-content'),
                            '<a href="http://docs.grandslambert.com/wiki/Featured_Content#Setting_up_the_Permalinks" target="blank">' . __('Documentation Page', 'featured-content') . '</a>'
                    );
                    ?>
               </p>
          </div>
     </div>

     <div class="postbox">
          <h3 class="handl" style="margin:0; padding:3px;cursor:default;"><?php _e('Modal Box Settings', 'featured-content'); ?></h3>
          <div style="padding:8px;">
               <p>
                    <?php _e('The settings on the Modal Boxes tab affect the modal boxes opened by the shortcode and the widget. You can see how your box will display by clicking on the "Show Example" link at the bottom of the box.', 'featured-content'); ?>
               </p>
               <p>
                    <?php printf(__('To create the modal boxes, this plugin uses the %1$s javascript code by %2$s.', 'featured-content'),
                            '<a href="http://okonet.ru/projects/modalbox/" target="_blank">' . __('ModalBox', 'faetured-content') . '</a>',
                            'Andrew Okonetchnikov'
                    ); ?>
               </p>
          </div>
     </div>

     <div class="postbox">
          <h3 class="handl" style="margin:0; padding:3px;cursor:default;"><?php _e('Contributors', 'featured-content'); ?></h3>
          <div style="padding:8px;">
<?php $this->show_contributors('contributors'); ?>
          </div>
     </div>
</div>