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
function verifyResetOptions(element) {
     if (element.checked) {
          if (prompt('Are you sure you want to reset all of your options? To confirm, type the word "reset" into the box.') == 'reset' ) {
               document.getElementById('featured_content_settings').submit();
          } else {
               element.checked = false;
          }
     }
}
