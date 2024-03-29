/* -------------------------------------------
Name: 		Ronby
Author:		Fluent Themes
------------------------------------------- */

(function($) {

    "use strict";

    var lastScrollTop = 0;
	jQuery(window).scroll(function(event){
		var st = jQuery(this).scrollTop();
		var scroll = jQuery(window).scrollTop();
		
        if (scroll >= 500) {
		if (st > lastScrollTop){
            jQuery(".navbar").removeClass("bg-scroll vshow").addClass("vhidden");
			jQuery("#header .header-nav").removeClass("bg-scroll vshow").addClass("vhidden");
        } else {
            jQuery(".navbar").addClass("bg-scroll vshow").removeClass("vhidden");
			jQuery("#header .header-nav").addClass("bg-scroll vshow").removeClass("vhidden");
        }
		lastScrollTop = st;
		}
		
		if (scroll == 0) {
            jQuery(".navbar").removeClass("bg-scroll vshow vhidden");
			jQuery("#header .header-nav").removeClass("bg-scroll vshow vhidden");
        }
    });

})(jQuery);