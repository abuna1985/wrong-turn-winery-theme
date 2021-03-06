<?php

function winery_files() {
  wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyC4UvhBtsRx6svEyQLiIMCKbXLqp5ZcD5U', NULL, '1.0', true);
  wp_enqueue_script('main-winery-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime(), true);
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  // TODO: revert microtime() back to version '1.0' before this goes live
  wp_enqueue_style('winery_main_styles', get_stylesheet_uri(), NULL, microtime());
  wp_localize_script('main-winery-js', 'wineryData', array(
   'root_url' => get_site_url()
  ));
}

add_action('wp_enqueue_scripts', 'winery_files');