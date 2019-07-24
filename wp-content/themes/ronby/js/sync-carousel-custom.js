(function(jQuery) {
	jQuery(document).ready(function(){
		jQuery('#sync1').owlCarousel({
			loop: true,
			autoplayHoverPause: true,
			margin:70,
			autoplay: false,					
			dots: false,
			nav: true,				
			autoplaySpeed: 1000,
			navText: ['<i class="fas fa-angle-left background-white"></i>','<i class="fas fa-angle-right background-white"></i>'],
			navSpeed: 1000,
			responsive: {
				0: {items: 1},
				1000: {items: 1}
			}
		});
			});
})(jQuery);