
jQuery(document).ready(function() { 

	//paste this code under the head tag or in a separate js file.
	// Wait for window load
	jQuery(window).load(function() {
		// Animate loader off screen
		jQuery(".se-pre-con").fadeOut("slow");;
	});

	if ( jQuery('.flexslider').length) {

		jQuery('.flexslider-container .flexslider').flexslider();
	}


	jQuery('.mobile_nav_btn #nav-toggle').click(function() {
		jQuery(this).parent().toggleClass('active');
		jQuery('.header-nav').toggleClass('open');
	});



	jQuery('a[href^="#"]').on('click',function (e) {
		e.preventDefault();

		var target = this.hash;
		var jQuerytarget = jQuery(target);

		jQuery('html, body').stop().animate({
			'scrollTop': jQuerytarget.offset().top
		}, 500, 'swing', function () {
			window.location.hash = target;
		});
	});

});

