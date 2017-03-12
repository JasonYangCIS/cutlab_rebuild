<?php
/**
 * The loop that displays a single post.
 *
 * @package WordPress
 * @subpackage ReadyArtwork
 * @since Ready Mobile 2012 1.0
 */
?>


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <h2 class="section-title"><span><?php the_title(); ?></span></h2>
    <div class="featured-employee-image">
         <?php if ( has_post_thumbnail() ): ?>
            <?php the_post_thumbnail();  ?>
         <?php else: ?>
            <?php echo catch_that_image('image'); ?>
         <?php endif; ?>
      </div>
      
      <div class="employee-bio">
        <?php  the_content(); ?>
      </div>
      <div class="gallery">
        <?php $instagramGallery = get_field("instagram"); ?>
        <?php $galleryTitle = get_field("gallery_title"); ?>
        
        <?php if ($galleryTitle) : ?>
          <div class="gallery-title">
            <?php echo $galleryTitle; ?>
          </div>
        <?php endif; ?>
        
        <?php if ($instagramGallery) {
              echo $instagramGallery;
        } ?>
      </div>

    <footer>
      <?php edit_post_link( __( 'Edit', 'ReadyArtwork' ), '', '' ); ?>
    </footer>

  </article>


  <?php // comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>