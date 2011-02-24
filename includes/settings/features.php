<?php
if ( preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF']) ) {
     die('You are not allowed to call this page directly.');
}
/**
 * features.php - View for the features tab.
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
          <?php _e('Features', 'featured-content'); ?>
     </h3>
     <div class="table featured-content-table">
          <table class="form-table">
               <tbody>
                    <tr align="top">
                         <th scope="row"><label for="featured_content_index_slug"><?php _e('Index Slug', 'featured-content'); ?></label></th>
                         <td>
                              <input title="<?php _e('Set the URL slug for use in content.', 'featured-content'); ?>" class="input" type="text" name="<?php echo $this->optionsName; ?>[index-slug]" id="featured_content_index_slug" value="<?php echo $this->options['index-slug']; ?>" />
                              <a href="<?php echo get_option('home'); ?>/<?php echo $this->options['index-slug']; ?>"><?php _e('View on Site', 'featured-content'); ?></a>
                         </td>
                    </tr>
                    <tr align="top">
                         <th scope="row"><label for="featured_content_identifier"><?php _e('Identifier', 'featured-content'); ?></label></th>
                         <td>
                              <input title="<?php _e('Set the URL identifier for use in URLs.', 'featured-content'); ?>" class="input" type="text" name="<?php echo $this->optionsName; ?>[identifier]" id="featured_content_identifier" value="<?php echo $this->options['identifier']; ?>" />
                         </td>
                    </tr>
                    <tr align="top" class="no-border">
                         <th scope="row"><label for="featured_content_permalink"><?php _e('Permalink Structure'); ?></label></th>
                         <td>
                              <input title="<?php _e('Set the permalink structure for viewing posts.', 'featured-content'); ?>" class="widefat" type="text" name="<?php echo $this->optionsName; ?>[permalink]" id="featured_content_permalink" value="<?php echo $this->options['permalink']; ?>" />
                         </td>
                    </tr>
                    <tr>
                         <td colspan="2">
                              <p><?php
          printf(__('This will be the custom URL structure for your featured content. These follow WP\'s normal %1$s, but must also include the content type \'%2$s\'.</p>', 'featured-content'),
                  '<a href="http://codex.wordpress.org/Using_Permalinks" target="_blank">' . __('permalink tags', 'featured-content') . '</a>',
                  '%identifier%'
          );
          ?>
                              <p><?php _e('Allowed tags: %year%, %monthnum%, %day%, %hour%, %minute%, %second%, %postname%, %post_id%.', 'featured-content'); ?></p>
                         </td>
                    </tr>
                    <tr align="top">
                         <th scope="row"><label for="featured_content_plural_name"><?php _e('Plural Name', 'featured-content'); ?></label></th>
                         <td>
                              <input title="<?php _e('Set the plural name for use in menus.', 'featured-content'); ?>" type="text" name="<?php echo $this->optionsName; ?>[plural-name]" id="featured_content_plural_name" value="<?php echo $this->options['plural-name']; ?>" />
                         </td>
                    </tr>
                    <tr align="top">
                         <th scope="row"><label for="featured_content_singular_name"><?php _e('Singular Name', 'featured-content'); ?></label></th>
                         <td>
                              <input title="<?php _e('Set the singular name for use in menus.', 'featured-content'); ?>" type="text" name="<?php echo $this->optionsName; ?>[singular-name]" id="featured_content_singular_name" value="<?php echo $this->options['singular-name']; ?>" />
                         </td>
                    </tr>
                    <tr align="top">
                         <th class="grey" colspan="4"><?php _e('Enable the following features', 'featured-content'); ?></th>
                    </tr>
                    <tr align="top" class="no-border">
                         <td colspan="2" class="cp-wide-table">
                              <table class="form-table cp-table">
                                   <tr align="top">
                                        <td><label title="<?php _e('Turn on the featured images of WordPress 3.0 to enable thumbnail images for featured content.', 'featured-content'); ?>"><input name="<?php echo $this->optionsName; ?>[use-thumbnails]" id="featured_content_use_thumbnails" type="checkbox" value="1" <?php checked($this->options['use-thumbnails'], 1); ?> /> <?php _e('Thumbnails', 'featured-content'); ?></label></td>
                                        <td><label title="<?php _e('Enable the post categories and tabs for featured content.', 'featured-content'); ?>"><input name="<?php echo $this->optionsName; ?>[use-taxonomies]" id="featured_content_use_taxonomies" type="checkbox" value="1" <?php checked($this->options['use-taxonomies'], 1); ?> /> <?php _e('Taxonomies', 'featured-content'); ?></label></td>
                                        <td><label title="<?php _e('Enable the use of custom fields for featured content.', 'featured-content'); ?>"><input name="<?php echo $this->optionsName; ?>[use-custom-fields]" id="featured_content_use_custom_fields" type="checkbox" value="1" <?php checked($this->options['use-custom-fields'], 1); ?> /> <?php _e('Custom Fields', 'featured-content'); ?></label></td>
                                   </tr>
                                   <tr align="top">
                                        <td><label title="<?php _e('Enable WordPress comments for featured content.', 'featured-content'); ?>"><input name="<?php echo $this->optionsName; ?>[use-comments]" id="featured_content_use_comments" type="checkbox" value="1" <?php checked($this->options['use-comments'], 1); ?> /> <?php _e('Comments', 'featured-content'); ?></label></td>
                                        <td><label title="<?php _e('Enable WordPress trackbacks for featured content.', 'featured-content'); ?>"><input name="<?php echo $this->optionsName; ?>[use-trackbacks]" id="featured_content_use_trackbacks" type="checkbox" value="1" <?php checked($this->options['use-trackbacks'], 1); ?> /> <?php _e('Trackbacks', 'featured-content'); ?></label></td>
                                        <td><label title="<?php _e('Enable WordPress revisions for featured content.', 'featured-content'); ?>"><input name="<?php echo $this->optionsName; ?>[use-revisions]" id="featured_content_use_revisions" type="checkbox" value="1" <?php checked($this->options['use-revisions'], 1); ?> /> <?php _e('Revisions', 'featured-content'); ?></label></td>
                                   </tr>
                              </table>
                         </td>
                    </tr>
               </tbody>
          </table>
     </div>
</div>