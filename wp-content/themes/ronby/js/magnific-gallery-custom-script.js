(function(jQuery) {
	jQuery(document).ready(function(){
		jQuery('.magnific-gallery').magnificPopup({
			delegate: 'a', // child items selector, by clicking on it popup will open
			type: 'image',		
			gallery: {
			  enabled: true, // set to true to enable gallery

			}
		});
	});
})(jQuery);