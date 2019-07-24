(function(jQuery) {
	jQuery(document).ready(function(){
		jQuery('.project-detail-carousel-slider').owlCarousel({
			loop: true,
			autoplayHoverPause: true,
			margin:20,
			autoplay: true,					
			dots: false,
			nav: false,
			navSpeed: 1000,			
			autoplaySpeed: 1000,
			//slideBy: 'page',
			responsive: {
				0: {items: 2},
				576: {items: 3},
				768: {items: 4},
				992: {items: 4},
				1200: {items: 5}
			}
		});		
			});
})(jQuery);