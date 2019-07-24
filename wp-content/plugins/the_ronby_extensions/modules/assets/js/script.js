(function(jQuery) {
 	jQuery('.ronby-image-widget-block').each(function(index, el) {
 		var options = { hideCaption : 0 };
 		if( jQuery(this).data('hidecaption')==1 ) options.hideCaption = 1;
 		var id = jQuery( this).attr('id');
 		jQuery('#'+id+' a').swipebox(options);	
 	});
}(jQuery));
