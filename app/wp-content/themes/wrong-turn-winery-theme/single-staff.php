<?php
  
  get_header();

  while(have_posts()) {
    the_post(); 
    pageBanner();
    ?>
    

    <div class="container container--narrow page-section">

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

        $relatedWines = get_field('related_wines');
        
        // If there are 'related_wines' selected in the custom field of the event post, show them
        if($relatedWines){
          echo '<hr class="section-break">';
          echo '<h2 class="headline headline--medium">Knowledge of Wine(s)</h2>';
          echo '<ul class="link-list min-list">';
          foreach($relatedWines as $wine) { ?>
            <li><a href="<?php echo get_the_permalink($wine) ?>"><?php echo get_the_title($wine); ?></a></li>
          <?php }
          echo '</ul>';
        }
        
      ?>
    </div>

  <?php }

  get_footer();

?>