(function(jQuery) {
	jQuery(document).ready(function(){
		jQuery('.testimonial-slider-4').owlCarousel({
			loop: true,
			autoplayHoverPause: true,
			autoplay: true,					
			dots: true,
			nav: false,
			dotsSpeed: 2000,		
			autoplaySpeed: 2000,
			//slideBy: 'page',
			items: 1
		});		
			});
})(jQuery);