(function(jQuery) {
	jQuery(document).ready(function(){
			jQuery('.hidden-search-form-toggler').click(function(e){
			e.preventDefault();
			jQuery('.hidden-search-form').fadeIn();			
		});
		jQuery('.hidden-search-form .form-close').click(function(e){
			e.preventDefault();
			jQuery('.hidden-search-form').fadeOut();
		});
		jQuery( ".row-xtra-space" ).closest( ".vc_row" ).css( "overflow", "visible" );
		jQuery( "iframe" ).closest( "p" ).css( "text-align", "center" );
		jQuery( ".ft-box-sec" ).closest( ".vc_row" ).css( "background-position", "100% 100%" );
		jQuery( ".ft-box-sec" ).closest( ".vc_row" ).css( "background-repeat", "no-repeat" );
			});
		
		//Adding span for numbers of archive and category lists in sidebar
		jQuery(".widget.widget_categories li,.widget.widget_archive li").each(function(){var e= jQuery(this).contents();e.length>1&&(e.eq(1).wrap('<span class="widget-span"></span>'),e.eq(1).each(function(){}))}).contents();jQuery(".widget.widget_categories li .widget-span,.widget.widget_archive li .widget-span").each(function(){jQuery(this).html(jQuery(this).text().substring(2));jQuery(this).html(jQuery(this).text().replace(/\)/gi,""))});jQuery(".widget.widget_categories li").length&&jQuery(".widget.widget_categories li .widget-span");
})(jQuery);