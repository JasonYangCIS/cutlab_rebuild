<?php
/**
 * The loop that displays posts.
 *
 * @package WordPress
 * @subpackage ReadyMobile
 * @since Ready Mobile 2012 1.0
 */
?>


<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
   <h1><?php _e( 'Not Found', 'ReadyArtwork' ); ?></h1>
   <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'ReadyArtwork' ); ?></p>
   <?php get_search_form(); ?>
<?php endif; ?>

<?php while ( have_posts() ) : the_post(); ?>



   <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      <header>
         <h2 class="blog-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'ReadyArtwork' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

         <?php // ReadyArtwork_posted_on(); ?>
      </header>

      <div class="featured-object">
         <?php if ( has_post_thumbnail() ): ?>
            <?php the_post_thumbnail();  ?>
         <?php else: ?>
            <?php echo catch_that_image('image'); ?>
         <?php endif; ?>
      </div>

      
      <?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
         <?php the_excerpt('Read More'); ?>
      <?php else : ?>
         <?php //the_content( __( 'Continue reading &rarr;', 'ReadyArtwork' ) ); ?>
         <?php the_excerpt(); ?>

         <?php wp_link_pages( array( 'before' => '<nav>' . __( 'Pages:', 'ReadyArtwork' ), 'after' => '</nav>' ) ); ?>
      <?php endif; ?>

      <footer>

       <?php edit_post_link( __( 'Edit', 'ReadyArtwork' ), '', '' ); ?>

    </footer>
 </article>

 <?php comments_template( '', true ); ?>



<?php endwhile; // End the loop. Whew. ?>

<?php if ( function_exists('base_pagination') ) { base_pagination(); } else if ( is_paged() ) { ?>
<div class="navigation clearfix">
 <div class="alignleft"><?php next_posts_link('&laquo; Previous Entries') ?></div>
 <div class="alignright"><?php previous_posts_link('Next Entries &raquo;') ?></div>
</div>
<?php } ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
   <div id="nav-below" class="navigation">
      <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyten' ) ); ?></div>
      <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
   </div><!-- #nav-below -->
<?php endif; ?>

