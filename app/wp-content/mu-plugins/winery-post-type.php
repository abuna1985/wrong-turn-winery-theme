<?php 

function winery_post_types() {
  register_post_type('event', array(
    'supports'      =>  array('title', 'editor', 'excerpt'),
    'rewrite'       =>  array('slug' => 'events'),
    'has_archive'   =>  true,
    'public'        =>  true,
    'show_in_rest'  =>  true,
    'labels'        =>  array(
      'name'            =>  'Events',
      'add_new_item'    =>  'Add New Event',
      'edit_item'       =>  'Edit Event',
      'all_items'       =>  'All Events',
      'view_item'       =>  'View Event',
      'singular_name'   =>  'Event'
    ),
    'menu_icon' => 'dashicons-calendar'
  ));
}

add_action('init', 'winery_post_types');

?>