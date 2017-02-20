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
        <article>
          <?php query_posts( array('post_type' => 'employees', 'posts_per_page' => -1, 'orderby' => 'menu_order title', 'order' => 'ASC')); ?>
          <ul class="projects-container">
            <?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>
              <li>
                <span class="staff-name"><a href="<?php echo the_permalink();?>"><?php the_title(); ?></a></span>
                <span class="position"><?php echo get_field('position'); ?></span>
              </li>
            <?php endwhile; endif; ?>
            <?php wp_reset_query(); ?>
          </ul>
        </article>
      </section>

      <section id="menu">
        <h2 class="section-title"><span><?php echo get_field('section_title_3');?></span></h2>
        <?php 
        $image = get_field('banner_image');
        if( !empty($image) ) {
          $imageLarge = $image['sizes']['medium_large'];
        }
        ?>
        <div class="menu-banner">
          <img title="<?php the_title(); ?>" src="<?php echo $imageLarge ?>" />
        </div>
        <?php for($i = 1; $i <= 3; $i++){ ?>
          <div class="menu-column">
            <?php echo get_field('column_' . $i); ?>
          </div>
        <?php }; //end for loop ?>
      </section>

      <section id="blog">
        <h2 class="section-title"><span><?php echo get_field('section_title_4');?></span></h2>
        <div class="container-left">
          <?php echo get_field('content_instagram'); ?>
        </div>
        <div class="container-right">
          <?php echo get_sidebar('blog'); ?>
        </div>
      </section>

      <section id="contact">
        <h2 class="section-title"><span><?php echo get_field('section_title_5');?></span></h2>
      </section>

    </div>
  </div>


  <?php  get_footer(); ?>
