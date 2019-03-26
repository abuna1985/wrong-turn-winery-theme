<?php

add_filter('login_headerurl', 'customHeaderUrl');

function customHeaderUrl() {
  return esc_url(site_url('/'));
}