(function(jQuery) {
	jQuery(document).ready(function(){
		jQuery('.testimonial-slider-3').owlCarousel({
			loop: true,
			autoplayHoverPause: true,
			autoplay: true,					
			dots: false,
			nav: true,
			navSpeed: 1000,		
			autoplaySpeed: 1000,
			slideBy: 'page',
			items: 1
		});		
			});
})(jQuery);