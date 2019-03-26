<?php

add_action('wp_loaded', 'removeSubAdminBar');

function removeSubAdminBar() {
  $currentUser = wp_get_current_user();

  if(count($currentUser->roles) == 1 AND $currentUser->roles[0] == 'subscriber') {
    show_admin_bar(false);
  }
}