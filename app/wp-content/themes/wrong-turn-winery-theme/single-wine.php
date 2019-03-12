<?php
  
  get_header();

  while(have_posts()) {
    the_post(); 
    pageBanner();
    ?>
   
    <div class="container container--narrow page-section">
      <div class="metabox metabox--position-up metabox--with-home-link">
        <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('wine'); ?>"><i class="fa fa-home" aria-hidden="true"></i> All Wines </a> <span class="metabox__main"><?php the_title(); ?></span></p>
      </div>

      <div class="generic-content">
        <div class="row group">
          <div class="one-third">
            <?php the_post_thumbnail('staffPortrait'); ?>
          </div>
          <div class="two-thirds">
            <?php the_content(); ?>
          </div>
        </div>
      </div>
      
      <?php 

        $relatedStaff = new WP_Query(array(
          'posts_per_page' => -1,
          'post_type' => 'staff',
          'orderby' => 'title',
          'order' => 'ASC',
          'meta_query' => array(
            array(
              'key' => 'related_wines',
              'compare' => 'LIKE',
              'value' => '"' . get_the_ID() . '"'
            )
          )
        ));

        if ($relatedStaff->have_posts()) {
          echo '<hr class="section-break">';
          echo '<h2 class="headline headline--medium">' . get_the_title() . ' Experts</h2>';
          echo '<ul class="staff-cards">';
          while($relatedStaff->have_posts()) {
            $relatedStaff->the_post(); ?>
            <li class="staff-card__list-item">
              <a class="staff-card" href="<?php the_permalink(); ?>">
                <img class="staff-card__image" src="<?php the_post_thumbnail_url('staffLandscape'); ?>">
                <span class="staff-card__name"><?php the_title(); ?></span>
              </a>
            </li>
          <?php }
          echo '</ul>';
        }

        wp_reset_postdata();

        $today = date('Ymd');
        $homepageEvents = new WP_Query(array(
          'posts_per_page'  => 2,
          'post_type'       => 'event',
          'meta_key'        => 'event_date',
          'orderby'        => 'meta_value_num',
          'order'           => 'ASC',
          'meta_query'      => array(
            array(
              'key'     => 'event_date',
              'compare' => '>=',
              'value'   => $today,
              'type'    => 'DATE'
            ),
            array(
              'key'     => 'related_wines',
              'compare' => 'LIKE',
              'value'   => '"' .get_the_ID() . '"'
            )
          )
        ));

        if ($homepageEvents->have_posts()) {
          echo '<hr class="section-break">';
          echo '<h2 class="headline headline--medium">Events Featuring ' . get_the_title() . '</h2>';

          while($homepageEvents->have_posts()) {
            $homepageEvents->the_post(); 
            get_template_part('template-parts/content-event');
          }
        }

        wp_reset_postdata();
        $relatedLocations = get_field('related_locations');

        if ($relatedLocations) {
          echo '<hr class="section-break">';
          echo '<h2 class="headline headline--medium">' . get_the_title() . ' is Available At These Locations</h2>';
          echo '<ul class="min-list link-list">';
            foreach ($relatedLocations as $location) {
              ?> <li><a href="<?php echo get_the_permalink($location); ?>"><?php echo get_the_title($location); ?></a></li> <?php

            }
          echo '</ul>';
        }

      ?>

    </div>

  <?php }

  get_footer();

?>