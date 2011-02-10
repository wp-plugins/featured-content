<?php
if ( preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF']) ) {
     die('You are not allowed to call this page directly.');
}
/**
 * settings.php - View for the Settings page.
 *
 * @package Featured Content
 * @subpackage includes
 * @author GrandSlambert
 * @copyright 2009-2011
 * @access public
 * @since 0.1
 */
/* Flush the rewrite rules */
global $wp_rewrite, $wp_query;
$wp_rewrite->flush_rules();

if ( isset($_REQUEST['tab']) ) {
     $selectedTab = $_REQUEST['tab'];
} else {
     $selectedTab = 'features';
}

$tabs = array(
     'features' => __('Features', 'featured-content'),
     'widget' => __('Widget Defaults', 'featured-content'),
     'modal' => __('Modal Boxes', 'featured-content'),
     'administration' => __('Administration', 'featured-content')
);
?>

<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;" class="overDiv"></div>
<div class="wrap">
     <form method="post" action="options.php" id="featured_content_settings">
          <div class="icon32" id="icon-featured-content"><br/></div>
          <h2><?php echo $this->pluginName; ?> &raquo; <?php _e('Plugin Settings', 'featured-content'); ?> </h2>
<?php if ( isset($_REQUEST['reset']) ) : ?>
               <div id="settings-error-featured-content_upated" class="updated settings-error">
                    <p><strong><?php _e('Featured Content settings have been reset to defaults.', 'featured-content'); ?></strong></p>
          </div>
<?php elseif ( isset($_REQUEST['updated']) ) : ?>
          <div id="settings-error-featured-content_upated" class="updated settings-error">
               <p><strong><?php _e('Featured Content Settings Saved.', 'featured-content'); ?></strong></p>
          </div>
<?php endif; ?>
          <?php settings_fields($this->optionsName); ?>
          <input type="hidden" name="<?php echo $this->optionsName; ?>[random-value]" value="<?php echo rand(1000, 100000); ?>" />
          <input type="hidden" name="active_tab" id="active_tab" value="<?php echo $selectedTab; ?>" />
          <ul id="featured_content_tabs">
<?php foreach ( $tabs as $tab => $name ) : ?>
                    <li id="featured_content_<?php echo $tab; ?>" class="featured-content<?php echo ($selectedTab == $tab) ? '-selected' : ''; ?>" style="display: <?php echo ($tab == 'taxonomies' && !$this->options['use-taxonomies']) ? 'none' : 'block'; ?>">
                    <a href="#top" onclick="featured_content_show_tab('<?php echo $tab; ?>')"><?php echo $name; ?></a>
               </li>
<?php endforeach; ?>
          </ul>

          <div style="width:49%; float:left">
<?php foreach ( $tabs as $tab => $name ) : ?>
                    <div id="featured_content_box_<?php echo $tab; ?>" style="display: <?php echo ($selectedTab == $tab) ? 'block' : 'none'; ?>">
<?php require_once('settings/' . $tab . '.php'); ?>
                    </div>
<?php endforeach; ?>

          </div>

          <div  style="width:49%; float:right">
<?php require_once('footer.php'); ?>
               </div>

               <div style="clear: both;">
                    <p class="submit" align="center">
                         <input type="hidden" name="action" value="update" />
<?php if ( function_exists('wpmu_create_blog') ) : ?>
                              <input type="hidden" name="option_page" value="<?php echo $this->optionsName; ?>" />
<?php else : ?>
                              <input type="hidden" name="page_options" value="<?php echo $this->optionsName; ?>" />
<?php endif; ?>
                              <input type="submit" name="Submit" class="featured-content-save" value="<?php _e('Save Settings', 'featured-content'); ?>" />
               </p>
          </div>
     </form>
</div>
