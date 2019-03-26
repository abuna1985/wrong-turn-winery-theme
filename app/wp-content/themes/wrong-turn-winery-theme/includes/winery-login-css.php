<?php

add_action('login_enqueue_scripts', 'wineryLoginCSS');

function wineryLoginCSS() {
  wp_enqueue_style('winery_main_styles', get_stylesheet_uri(), NULL,'1.0');
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
}