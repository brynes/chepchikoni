(function(jQuery) {
	jQuery(window).on('load', function(){
		jQuery('.fashion-cat-slider').owlCarousel({
			loop: true,
			autoplayHoverPause: true,
			autoplay: true,					
			dots: false,
			nav: false,
			dotsSpeed: 2000,		
			autoplaySpeed: 2000,
			//slideBy: 'page',
			items: 3
		});		
			});
})(jQuery);