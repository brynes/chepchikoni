(function(jQuery) {
	jQuery(document).ready(function(){
		jQuery('.post-carousel-2 .owl-carousel').owlCarousel({
			loop: true,
			autoplayHoverPause: true,
			margin:30,
			autoplay: true,					
			dots: false,
			nav: true,
			navSpeed: 1000,			
			autoplaySpeed: 1000,
			navText: ['<i class="fas fa-angle-left"></i>','<i class="fas fa-angle-right"></i>'],
			responsive: {
				0: {items: 1},
				576: {items: 2},
				768: {items: 3},
				992: {items: 3},
				1200: {items: 4}
			}
		});		
			});
})(jQuery);