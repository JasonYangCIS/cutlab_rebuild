
jQuery(document).ready(function() { 

	if ( jQuery('.flexslider').length) {

		jQuery('.flexslider-container .flexslider').flexslider();
	}


	jQuery('.mobile_nav_btn #nav-toggle').click(function() {
		jQuery(this).parent().toggleClass('active');
		jQuery('.header-nav').toggleClass('open');
		jQuery('body').toggleClass('open');
	});
});

