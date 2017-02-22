<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage ReadyMobile
 * @since Ready Mobile 2012 1.0
 */
?>

	<aside class="sidebar sidebar-social-media-footer">

	<?php
	if ( is_active_sidebar( 'sidebar-social-media-footer' ) ) : dynamic_sidebar( 'sidebar-social-media-footer' ); ?>
				
	<?php endif; ?>
	</aside>
