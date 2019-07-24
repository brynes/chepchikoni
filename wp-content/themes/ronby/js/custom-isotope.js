(function(jQuery) {
	jQuery(window).on('load', function(){
		// init Isotope
		var $grid = jQuery('.grid').isotope({
		  itemSelector: '.element-item',
		  layoutMode: 'fitRows',
		  getSortData: {
			name: '.name',
			symbol: '.symbol',
			number: '.number parseInt',
			category: '[data-category]',
			weight: function( itemElem ) {
			  var weight = jQuery( itemElem ).find('.weight').text();
			  return parseFloat( weight.replace( /[\(\)]/g, '') );
			}
		  }
		});

		// filter functions
		var filterFns = {
		  // show if number is greater than 50
		  numberGreaterThan50: function() {
			var number = jQuery(this).find('.number').text();
			return parseInt( number, 10 ) > 50;
		  },
		  // show if name ends with -ium
		  ium: function() {
			var name = jQuery(this).find('.name').text();
			return name.match( /ium$/ );
		  }
		};

		// bind filter button click
		jQuery('#filters').on( 'click', 'li', function() {
		  var filterValue = jQuery( this ).attr('data-filter');
		  // use filterFn if matches value
		  filterValue = filterFns[ filterValue ] || filterValue;
		  $grid.isotope({ filter: filterValue });
		});

		// bind sort button click
		jQuery('#sorts').on( 'click', 'li', function() {
		  var sortByValue = jQuery(this).attr('data-sort-by');
		  $grid.isotope({ sortBy: sortByValue });
		});

		// change is-checked class on buttons
		jQuery('.filter-nav-3').each( function( i, buttonGroup ) {
		  var $buttonGroup = jQuery( buttonGroup );
		  $buttonGroup.on( 'click', 'li', function() {
			$buttonGroup.find('.is-checked').removeClass('is-checked');
			jQuery( this ).addClass('is-checked');
		  });
		});
	});
})(jQuery);