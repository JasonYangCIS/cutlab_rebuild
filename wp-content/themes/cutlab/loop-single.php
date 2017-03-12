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

    <header>
      <h1 class="blog-title"><?php the_title(); ?></h1>
    </header>
    <div class="featured-object">
         <?php if ( has_post_thumbnail() ): ?>
            <?php the_post_thumbnail();  ?>
         <?php else: ?>
            <?php echo catch_that_image('image'); ?>
         <?php endif; ?>
      </div>
    <?php  the_content(); ?>

    <footer>
      <?php edit_post_link( __( 'Edit', 'ReadyArtwork' ), '', '' ); ?>
    </footer>

  </article>

<?php endwhile; // end of the loop. ?>
