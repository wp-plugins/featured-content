/**
 * featured-shortcode-admin.js - Javascript for the administration screens.
 *
 * @package Featured Content
 * @subpackage js
 * @author GrandSlambert
 * @copyright 2009-2011
 * @access public
 * @since 0.1
 */

/* Function to change tabs on the settings pages */
function featured_content_show_tab(tab) {
     /* Close Active Tab */
     activeTab = document.getElementById('active_tab').value;
     document.getElementById('featured_content_box_' + activeTab).style.display = 'none';
     document.getElementById('featured_content_' + activeTab).removeAttribute('class','featured-content-selected');

     /* Open new Tab */
     document.getElementById('featured_content_box_' + tab).style.display = 'block';
     document.getElementById('featured_content_' + tab).setAttribute('class','featured-content-selected');
     document.getElementById('active_tab').value = tab;
}

/* Function to verify selection to reset options */
function featured_content_reset(element) {
     if (element.checked) {
          if (prompt('Are you sure you want to reset all of your options? To confirm, type the word "reset" into the box.') == 'reset' ) {
               document.getElementById('featured_content_settings').submit();
          } else {
               element.checked = false;
          }
     }
}

/* Function to submit the changes on the settings page. */
function featured_content_settings_save() {
     document.getElementById('featured_content_settings').submit();
}
