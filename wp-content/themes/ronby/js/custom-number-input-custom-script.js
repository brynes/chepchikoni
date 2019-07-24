(function(jQuery) {
	jQuery(document).ready(function(){
		jQuery('.custom-number-input , .custom-number-input-2').each(function(){
			var parent = jQuery(this);
			var input = jQuery(this).find('input');
			if (!input) return;

			var min = parseInt(input.attr('min'));
			var step = parseInt(input.attr('step')) || 1;

			function input_add (x) {
				current_value = parseInt(input.val());
				if (min && (current_value + x) < min ) {
					return;
				}
				input.val(current_value + x);
			}
			parent.on('click','.input-increase', function(){
				input_add(step);
			});
			parent.on('click','.input-decrease', function(){
				input_add(-step);
			});
		});		
			});
})(jQuery);