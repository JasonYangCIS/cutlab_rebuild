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
	<section class="content content-full employees">
		<?php get_template_part( 'loop', 'employees' ); ?>
	</section>
</div>
<?php get_footer(); ?>
