(function(jQuery) {
	jQuery(document).ready(function(){		
		jQuery('.brand-carousel-slider').owlCarousel({
			loop: true,
			autoplayHoverPause: true,
			margin:70,
			autoplay: true,					
			dots: false,
			nav: false,				
			autoplaySpeed: 1000,
			navSpeed: 1000,
			//slideBy: 'page',
			responsive: {
				0: {items: 1},
				400: {items: 2},
				600: {items: 3},
				800: {items: 4},
				1000: {items: 5}
			}
		});
		
	});
})(jQuery);