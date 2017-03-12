<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage ReadyMobile
 * @since Ready Mobile 2012 1.0
 */
?>

<aside class="sidebar">
	<?php
	if ( is_active_sidebar( 'sidebar' ) ) : dynamic_sidebar( 'sidebar' ); ?>
				
	<?php endif; ?>

	<?php query_posts( array('post_type' => 'post', 'posts_per_page' => -1, 'orderby' => 'menu_order title', 'order' => 'DESC')); ?>
	<ul class="blog-feed-container">
		<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>
			<li>
				<a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a>
				<span class="post-date">Published on: <?php echo get_the_date(); ?></span>
			</li>
		<?php endwhile; endif; ?>
	</ul>
	<?php wp_reset_query(); ?>
</aside>
