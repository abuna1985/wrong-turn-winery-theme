<?php 

function winery_post_types() {
  // Location Post Type
  register_post_type('location', array(
    'capability_type' =>  'location',
    'map_meta_cap'    =>  true, 
    'supports'        =>  array('title', 'editor', 'excerpt'),
    'rewrite'         =>  array('slug' => 'locations'),
    'has_archive'     =>  true,
    'public'          =>  true,
    'show_in_rest'    =>  true,
    'labels'          =>  array(
      'name'            =>  'Locations',
      'add_new_item'    =>  'Add New Location',
      'edit_item'       =>  'Edit Location',
      'all_items'       =>  'All Locations',
      'view_item'       =>  'View Location',
      'singular_name'   =>  'Location'
    ),
    'menu_icon' => 'dashicons-location-alt'
  ));
  
  // Event Post Type
  register_post_type('event', array(
    'capability_type' =>  'event',
    'map_meta_cap'    =>  true, 
    'supports'        =>  array('title', 'editor', 'excerpt'),
    'rewrite'         =>  array('slug' => 'events'),
    'has_archive'     =>  true,
    'public'          =>  true,
    'show_in_rest'    =>  true,
    'labels'          =>  array(
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
    'capability_type' =>  'wine',
    'map_meta_cap'    =>  true, 
    'supports'        =>  array('title', 'editor', 'thumbnail'),
    'taxonomies'      =>  array('post_tag'),
    'rewrite'         =>  array('slug' => 'wines'),
    'has_archive'     =>  true,
    'public'          =>  true,
    'show_in_rest'    =>  true,
    'labels'          =>  array(
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
    'capability_type' =>  'staff',
    'map_meta_cap'    =>  true, 
    'supports'        =>  array('title', 'editor', 'thumbnail'),
    'public'          =>  true,
    'show_in_rest'    =>  true,
    'labels'          =>  array(
      'name'            =>  'Staff',
      'add_new_item'    =>  'Add New Staff',
      'edit_item'       =>  'Edit Staff',
      'all_items'       =>  'All Staff',
      'view_item'       =>  'View Staff',
      'singular_name'   =>  'Staff'
    ),
    'menu_icon' => 'dashicons-businessman'
  ));

  // Note Post Type
  register_post_type('note', array(
    'supports'        =>  array('title', 'editor', 'author'),
    'public'          =>  false,
    'show_ui'         =>  true,
    'show_in_rest'    =>  true,
    'labels'          =>  array(
      'name'            =>  'Notes',
      'add_new_item'    =>  'Add New Note',
      'edit_item'       =>  'Edit Note',
      'all_items'       =>  'All Notes',
      'view_item'       =>  'View Note',
      'singular_name'   =>  'Note'
    ),
    'menu_icon' => 'dashicons-welcome-write-blog'
  ));
}

add_action('init', 'winery_post_types');

?>