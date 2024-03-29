<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage ReadyMobile
 * @since Ready Mobile 2012 1.0
 */

get_header(); ?>
<div class="wrapper">
	<section class="content content-left">
		<?php get_template_part( 'loop', 'single' ); ?>
	</section>
	
	<div class="sidebar-right">
		<div class="container-right">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
