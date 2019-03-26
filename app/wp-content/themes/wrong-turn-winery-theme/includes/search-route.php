<?php

add_action('rest_api_init', wineryRegisterSearch);

function wineryRegisterSearch() {
  register_rest_route('winery/v1', 'search', array(
    'methods'   => WP_REST_SERVER::READABLE,
    'callback'  => 'winerySearchResults' 
  ));
}

function winerySearchResults($data) {
  $mainQuery = new WP_Query(array(
    'post_type'       =>  array('post', 'page', 'staff', 'wine', 'location', 'event'),
    's'               =>  sanitize_text_field($data['term']),
    'posts_per_page'  =>  -1
  ));

  $results = array(
    'generalInfo' => array(),
    'staff'     => array(),
    'wines'     => array(),
    'events'    => array(),
    'locations' => array()
  );

  while ($mainQuery->have_posts()) {
    $mainQuery->the_post();
    
    if (get_post_type() == 'post' || get_post_type() == 'page') {
      array_push($results['generalInfo'], array(
        'title'       => get_the_title(),
        'permalink'   => get_the_permalink(),
        'postType'    => get_post_type(),
        'authorName'  => get_the_author()
      ));
    }

    if (get_post_type() == 'staff') {
      array_push($results['staff'], array(
        'title'     => get_the_title(),
        'permalink' => get_the_permalink(),
        'image'     => get_the_post_thumbnail_url(0, 'staffLandscape')
      ));
    }

    if (get_post_type() == 'wine') {
      $relatedLocations = get_field('related_locations');

      if ($relatedLocations) {
        foreach ($relatedLocations as $location) {
          array_push($results['locations'], array(
              'title'     => get_the_title($location),
              'permalink' => get_the_permalink($location) 
          ));
        }
      }

      array_push($results['wines'], array(
        'title'     => get_the_title(),
        'permalink' => get_the_permalink(),
        'id'        => get_the_id()
      ));
    }

    if (get_post_type() == 'location') {
      array_push($results['locations'], array(
        'title'     => get_the_title(),
        'permalink' => get_the_permalink()
      ));
    }

    if (get_post_type() == 'event') {
      $eventDate = new DateTime(get_field('event_date'));
      $description = null;
      if (has_excerpt()) {
        $description = get_the_excerpt();
      } else {
        $description = wp_trim_words(get_the_content(), 18);
      }

      array_push($results['events'], array(
        'title'       => get_the_title(),
        'permalink'   => get_the_permalink(),
        'month'       => $eventDate->format('M'),
        'day'         => $eventDate->format('d'),
        'description' => $description
      ));
    }
  }

  if ($results['wines']) {
    $winesMetaQuery = array('relation'  => 'OR');

    foreach ($results['wines'] as $item) {
      array_push($winesMetaQuery, array(
        'key'     =>  'related_wines',
        'compare' =>  'LIKE',
        'value'   =>  '"' . $item['id'] . '"'
      ));
    }

    $wineRelationshipQuery = new WP_Query(array(
      'post_type'   =>  array('staff', 'event'),
      'meta_query'  =>  $winesMetaQuery  
    ));

    while($wineRelationshipQuery->have_posts()){
      $wineRelationshipQuery->the_post();
    
      if (get_post_type() == 'event') {
        $eventDate = new DateTime(get_field('event_date'));
        $description = null;
        if (has_excerpt()) {
          $description = get_the_excerpt();
        } else {
          $description = wp_trim_words(get_the_content(), 18);
        }
  
        array_push($results['events'], array(
          'title'       => get_the_title(),
          'permalink'   => get_the_permalink(),
          'month'       => $eventDate->format('M'),
          'day'         => $eventDate->format('d'),
          'description' => $description
        ));
      }
      
      if (get_post_type() == 'staff') {
        array_push($results['staff'], array(
          'title'     => get_the_title(),
          'permalink' => get_the_permalink(),
          'image'     => get_the_post_thumbnail_url(0, 'staffLandscape')
        ));
      }
    }

    $results['staff'] = array_values(array_unique($results['staff'], SORT_REGULAR));
    $results['events'] = array_values(array_unique($results['events'], SORT_REGULAR));
    $results['locations'] = array_values(array_unique($results['locations'], SORT_REGULAR));
  }

  
  return $results;

}