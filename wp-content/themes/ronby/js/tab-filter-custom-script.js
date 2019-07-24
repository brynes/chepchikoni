(function(jQuery) {
	jQuery(document).ready(function(){
		jQuery('.tabs-filter').each(function(){
			var el = jQuery(this);
			el.on('click', '.tab', function(e){
				e.preventDefault();
				el.find('.tab.active').removeClass('active');
				jQuery(this).addClass('active');
				el.find('.content-tab.active').removeClass('active');
				el.find('.content-tab[data-tab="' + jQuery(this).attr('data-tab') + '"]').addClass('active');
			});
		});
				
	});
})(jQuery);