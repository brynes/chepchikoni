(function(jQuery) {
	jQuery(window).on('load', function(){			
		jQuery('.masonry').masonry({
			columnWidth: '.masonry-sizer',
			gutter: '.masonry-gutter',
			itemSelector: '.masonry-item',
			percentPosition: true
		});
	});
})(jQuery);