(function(jQuery) {
	jQuery(document).ready(function(){
			
		jQuery('.tesimonial-slider-1').owlCarousel({
			loop: true,
			autoplayHoverPause: true,
			margin:0,
			autoplay: true,					
			dots: false,
			nav:true,	
			navText: ['<i class="fas fa-caret-left background-primary"></i>','<i class="fas fa-caret-right background-primary"></i>'],
			autoplaySpeed: 1000,
			navSpeed: 1000,			
			items: 1
		});
		
	});
})(jQuery);