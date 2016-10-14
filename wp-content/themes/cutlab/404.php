<?php
/**
 * The template for displaying 404 pages.
 *
 * @package WordPress
 * @subpackage ReadyMobile
 * @since Ready Mobile 2012 1.0
 */

get_header(); ?>
<section class="content content-full">
	<article>
		<h1><?php _e( 'Not Found', 'ReadyArtwork' ); ?></h1>
		<p><?php _e( 'Sorry, but the page you were trying to view does not exist. Perhaps searching will help.', 'ReadyArtwork' ); ?></p>
		<?php get_search_form(); ?>
	</article>
</section>

<?php get_footer(); ?>
