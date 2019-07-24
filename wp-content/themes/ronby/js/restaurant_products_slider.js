(function(jQuery) {
	jQuery(document).ready(function(){
		jQuery('.restaurant-product-slider').owlCarousel({
			loop: true,
			autoplayHoverPause: true,
			autoplay: true,					
			dots: true,
			nav: false,
			dotsSpeed: 2000,		
			autoplaySpeed: 2000,
			//slideBy: 'page',
			items: 4
		});		
			});
})(jQuery);