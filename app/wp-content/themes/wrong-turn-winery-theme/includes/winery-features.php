<?php

function winery_features() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_image_size('staffLandscape', 400, 260, true);
  add_image_size('staffPortrait', 480, 650, true);
  add_image_size('pageBanner', 1500, 350, true);
}

add_action('after_setup_theme', 'winery_features');