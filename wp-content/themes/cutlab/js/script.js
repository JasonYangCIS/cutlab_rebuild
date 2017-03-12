
jQuery(document).ready(function() { 

	if ( jQuery('.flexslider').length) {

		jQuery('.flexslider-container .flexslider').flexslider();
	}


	jQuery('.mobile_nav_btn #nav-toggle').click(function() {
		jQuery(this).parent().toggleClass('active');
		jQuery('.header-nav').toggleClass('open');
		jQuery('body').toggleClass('open');
		jQuery('.header-nav').height(jQuery('body').height() + 50);
	});

	if(jQuery('body.home').length > 0){
		jQuery(".menu-header-container a").click(function(event) {
			jQuery('.mobile_nav_btn').removeClass('active');
			jQuery('.header-nav').removeClass('open');
			jQuery('body').removeClass('open');
			event.preventDefault();
			var anchorId = jQuery(this).attr('href');
			anchorId = anchorId.split('#');
		    jQuery('html, body').animate({
		        scrollTop: jQuery('section#'+anchorId[1]).offset().top
		    }, 500);
		});
	}
});

