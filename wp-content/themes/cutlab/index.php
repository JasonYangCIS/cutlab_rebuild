<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage ReadyMobile
 * @since Ready Mobile 2012 1.0
 */

get_header(); ?>

<section cclass="content content-left">
	<div class="wrapper">
		<?php get_template_part( 'loop', 'index' ); ?>
	</div>
</section> 
<div class="sidebar-right"><?php get_sidebar(); ?></div>
<?php get_footer(); ?>
