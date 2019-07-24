(function(jQuery) {
	jQuery(document).ready(function(){
			jQuery('.countUpNumber').each(function () {
		    jQuery(this).prop('Counter',0).animate({
		        Counter: jQuery(this).text()
		    }, {
		        duration: 4000,
		        easing: 'swing',
		        step: function (now) {
		            jQuery(this).text(Math.ceil(now));
		        }
		    });
		});	
			});
})(jQuery);