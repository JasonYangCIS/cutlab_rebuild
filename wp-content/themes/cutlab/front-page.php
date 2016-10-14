<?php
  /**
  * The template for displaying all pages.
  *
  * @package WordPress
  * @subpackage ReadyMobile
  * @since Ready Mobile 2012 1.0
  */

  get_header(); ?>

  <section class="content front-page-content">
    <article>
      <?php wp_reset_query(); ?>
      
      <div class="home-featured-container">
        <div class="home-featured-image">
          <?php 
          // Check if the post has a Post Thumbnail assigned to it.
          if ( has_post_thumbnail() ) {
            the_post_thumbnail();
          }
          ?>
        </div>

        <div class="home-featured-text">
          <?php the_content(); ?>
        </div>
      </div>
      <div class="home-list" id="anchor-list">
        <div class="wrapper">
          <?php 
          for($i = 1; $i <=4; $i++){
            echo '<div class="list-content">';
            if(get_field('content_image_'.$i)){
              $image = get_field('content_image_'.$i);
              ?>
              <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
              <?php
            }
            if(get_field('content_'.$i)){
              echo get_field('content_'.$i);
            }
            echo '</div>';
          }
          ?>

        </div>
      </div>
    </article>
  </section>


  <?php  get_footer(); ?>
