(function(jQuery) {
	jQuery(document).ready(function(){
		
		jQuery('.countdown-style-1').each(function(){
			jQuery(this).countdown(jQuery(this).attr('data-countdown-to')).on('update.countdown', function(event) {
			  var jQuerythis = jQuery(this).html(event.strftime(''
			   	+ '<li><div class="number">%D</div><div class="text">Days</div></li>'
			    + '<li><div class="number">%H</div><div class="text">Hours</div></li>'
			    + '<li><div class="number">%M</div><div class="text">Minutes</div></li>'
			    + '<li><div class="number">%S</div><div class="text">Seconds</div></li>'
			    ));
			});
		})
						
	});
})(jQuery);