<?php 

function winery_post_types() {
  // Event Post Type
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

  // Wine Post Type
  register_post_type('wine', array(
    'supports'      =>  array('title', 'editor', 'thumbnail'),
    'taxonomies'    => array('post_tag'),
    'rewrite'       =>  array('slug' => 'wines'),
    'has_archive'   =>  true,
    'public'        =>  true,
    'show_in_rest'  =>  true,
    'labels'        =>  array(
      'name'            =>  'Wines',
      'add_new_item'    =>  'Add New Wine',
      'edit_item'       =>  'Edit Wine',
      'all_items'       =>  'All Wines',
      'view_item'       =>  'View Wine',
      'singular_name'   =>  'Wine'
    ),
    'menu_icon' => 'dashicons-products'
  ));

  // Staff Post Type
  register_post_type('staff', array(
    'supports'      =>  array('title', 'editor', 'thumbnail'),
    'public'        =>  true,
    'show_in_rest'  =>  true,
    'labels'        =>  array(
      'name'            =>  'Staff',
      'add_new_item'    =>  'Add New Staff',
      'edit_item'       =>  'Edit Staff',
      'all_items'       =>  'All Staff',
      'view_item'       =>  'View Staff',
      'singular_name'   =>  'Staff'
    ),
    'menu_icon' => 'dashicons-businessman'
  ));
}

add_action('init', 'winery_post_types');

?>