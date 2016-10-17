<?php
  /**
  * The template for displaying all pages.
  *
  * @package WordPress
  * @subpackage ReadyMobile
  * @since Ready Mobile 2012 1.0
  */

  get_header(); ?>
  <?php wp_reset_query(); ?>

  <?php if ( has_post_thumbnail() ) { ?>
  <div class="home-banner" style="background: url('<?php the_post_thumbnail_url(); ?>') center no-repeat">
    <div class="banner-content">
      <?php the_content(); ?>     
    </div>  
  </div>
  <?php } ?>
  <div class="front-page-container">
    <div class="wrapper">
      <section id="mission">
        <h2 class="section-title"><span><?php echo get_field('section_title_1');?></span></h2>
        <div class="mission-content"><?php echo get_field('full_content_1');?></div>
      </section>

      <section id="team">
        <h2 class="section-title"><span><?php echo get_field('section_title_2');?></span></h2>
      </section>

      <section id="menu">
        <h2 class="section-title"><span><?php echo get_field('section_title_3');?></span></h2>
      </section>

      <section id="blog">
        <h2 class="section-title"><span><?php echo get_field('section_title_4');?></span></h2>
      </section>

      <section id="contact">
        <h2 class="section-title"><span><?php echo get_field('section_title_5');?></span></h2>
      </section>

    </div>
  </div>


  <?php  get_footer(); ?>
