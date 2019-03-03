<?php

function winery_adjust_queries($query) {
  if (!is_admin() AND is_post_type_archive('location') AND $query->is_main_query()) {
    $query->set('post_per_page', -1);
  }

  // If on the wine archive post, list wines by alphabetical order
  if (!is_admin() AND is_post_type_archive('wine') AND $query->is_main_query()) {
    $query->set('orderby','title');
    $query->set('order','ASC');
    $query->set('post_per_page', -1);
  }

  // If on the event archive post, only list wines that are past today's date and in chronological order
  if (!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) {
    $today = date('Ymd');
    $query->set('meta_key','event_date');
    $query->set('orderby','meta_value_num');
    $query->set('order','ASC');
    $query->set(
      'meta_query', 
      array(
        array(
          'key'     => 'event_date',
          'compare' => '>=',
          'value'   => $today,
          'type'    => 'DATE'
        )
      )
    );
  }
}

add_action('pre_get_posts', 'winery_adjust_queries');