<?php

// Redirect subscriber accounts out of admin and onto the homepage
add_action('admin_init', 'redirectSubsToHomePage');

function redirectSubsToHomePage() {
  $currentUser = wp_get_current_user();

  if(count($currentUser->roles) == 1 AND $currentUser->roles[0] == 'subscriber') {
    wp_redirect(site_url('/'));
    exit;
  }
}