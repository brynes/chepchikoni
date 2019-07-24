(function(jQuery) {
	jQuery(document).ready(function(){
		jQuery('.testimonial-slider-2').owlCarousel({
			loop: true,
			autoplayHoverPause: true,
			autoplay: true,					
			dots: false,
			nav: true,
			navText: ['<i class="fas fa-angle-left background-white"></i>','<i class="fas fa-angle-right background-white"></i>'],
			navSpeed: 1000,		
			autoplaySpeed: 1000,
			//slideBy: 'page',
			items: 1
		});		
			});
})(jQuery);