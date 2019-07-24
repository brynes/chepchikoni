(function(jQuery) {
	jQuery(document).ready(function(){
		// Toggle styles customizer
		jQuery('#sc-toggle').click(function(e) {
			jQuery('#style-customizer').toggleClass('expanded');
		});
		jQuery('#sc-toggle-close').click(function(e) {
			jQuery('#style-customizer').removeClass('expanded');
		});		
			});



})(jQuery);