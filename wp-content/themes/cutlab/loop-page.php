<?php
/**
 * The loop that displays a page.
 *
 * @package WordPress
 * @subpackage ReadyMobile
 * @since Ready Mobile 2012 1.0
 */
?>


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header>
			<div class="wrapper">
				<?php if ( is_front_page() ) { ?>
				<h2><?php the_title(); ?></h2>
				<?php } else { ?>	
				<h1><?php the_title(); ?></h1>
				<?php } ?>
			</div>
		</header>				

		<article>
			<div class="wrapper">
				<div class="content-container">
					<?php the_content(); ?>
					<?php wp_reset_query(); ?>

					
				</div>
			</div>
		</article>
		
		<?php wp_link_pages( array( 'before' => '<nav>' . __( 'Pages:', 'ReadyArtwork' ), 'after' => '</nav>' ) ); ?>
		
		<footer>
			<?php edit_post_link( __( 'Edit', 'ReadyArtwork' ), '', '' ); ?>
		</footer>
	</article>

	<?php //comments_template( '', true ); ?>

<?php endwhile; ?>

