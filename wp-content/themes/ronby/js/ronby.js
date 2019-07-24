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
		
		jQuery('.tesimonial-slider-1').owlCarousel({
			loop: true,
			autoplayHoverPause: true,
			margin:0,
			autoplay: true,					
			dots: false,
			nav:true,	
			navText: ['<i class="fas fa-caret-left background-primary"></i>','<i class="fas fa-caret-right background-primary"></i>'],
			autoplaySpeed: 1000,
			navSpeed: 1000,			
			items: 1
		});

		jQuery('.masonry').masonry({
			columnWidth: '.masonry-sizer',
			gutter: '.masonry-gutter',
			itemSelector: '.masonry-item',
			percentPosition: true
		});

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
		
		jQuery('.brand-carousel-slider').owlCarousel({
			loop: true,
			autoplayHoverPause: true,
			margin:70,
			autoplay: true,					
			dots: false,
			nav: false,				
			autoplaySpeed: 1000,
			navSpeed: 1000,
			//slideBy: 'page',
			responsive: {
				0: {items: 1},
				400: {items: 2},
				600: {items: 3},
				800: {items: 4},
				1000: {items: 5}
			}
		});
		jQuery('#sync1').owlCarousel({
			loop: true,
			autoplayHoverPause: true,
			margin:70,
			autoplay: false,					
			dots: false,
			nav: true,				
			autoplaySpeed: 1000,
			navText: ['<i class="fas fa-angle-left background-white"></i>','<i class="fas fa-angle-right background-white"></i>'],
			navSpeed: 1000,
			responsive: {
				0: {items: 1},
				1000: {items: 1}
			}
		});
		jQuery('.project-detail-carousel-slider').owlCarousel({
			loop: true,
			autoplayHoverPause: true,
			margin:20,
			autoplay: true,					
			dots: false,
			nav: false,
			navSpeed: 1000,			
			autoplaySpeed: 1000,
			//slideBy: 'page',
			responsive: {
				0: {items: 2},
				576: {items: 3},
				768: {items: 4},
				992: {items: 4},
				1200: {items: 5}
			}
		});
		jQuery('.testimonial-slider-2').owlCarousel({
			loop: true,
			autoplayHoverPause: true,
			autoplay: true,					
			dots: false,
			nav: true,
			navText: ['<i class="fas fa-angle-left background-white"></i>','<i class="fas fa-angle-right background-white"></i>'],
			navSpeed: 1000,		
			autoplaySpeed: 1000,
			//slideBy: 'page',
			items: 1
		});

		jQuery('.post-carousel-2 .owl-carousel').owlCarousel({
			loop: true,
			autoplayHoverPause: true,
			margin:30,
			autoplay: true,					
			dots: false,
			nav: true,
			navSpeed: 1000,			
			autoplaySpeed: 1000,
			navText: ['<i class="fas fa-angle-left"></i>','<i class="fas fa-angle-right"></i>'],
			responsive: {
				0: {items: 1},
				576: {items: 2},
				768: {items: 3},
				992: {items: 3},
				1200: {items: 4}
			}
		});

		jQuery('.post-carousel-3 .owl-carousel').owlCarousel({
			loop: true,
			autoplayHoverPause: true,
			margin:30,
			autoplay: true,					
			dots: false,
			nav: true,
			navSpeed: 1000,			
			autoplaySpeed: 1000,
			navText: ['<i class="fas fa-angle-left"></i>','<i class="fas fa-angle-right"></i>'],
			responsive: {
				0: {items: 1},				
				768: {items: 2},				
				1200: {items: 3}
			}
		});
	
		jQuery('.magnific-gallery').magnificPopup({
			delegate: 'a', // child items selector, by clicking on it popup will open
			type: 'image',		
			gallery: {
			  enabled: true, // set to true to enable gallery

			}
		});


		// Toggle styles customizer
		jQuery('#sc-toggle').click(function(e) {
			jQuery('#style-customizer').toggleClass('expanded');
		});
		jQuery('#sc-toggle-close').click(function(e) {
			jQuery('#style-customizer').removeClass('expanded');
		});
		

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

		jQuery('.testimonial-slider-3').owlCarousel({
			loop: true,
			autoplayHoverPause: true,
			autoplay: true,					
			dots: false,
			nav: true,
			navSpeed: 1000,		
			autoplaySpeed: 1000,
			slideBy: 'page',
			items: 1
		});

		jQuery('.hidden-search-form-toggler').click(function(e){
			e.preventDefault();
			jQuery('.hidden-search-form').fadeIn();			
		});
		jQuery('.hidden-search-form .form-close').click(function(e){
			e.preventDefault();
			jQuery('.hidden-search-form').fadeOut();
		});

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
		
		jQuery( ".clac-slider" ).closest( "vc_row" ).css( "background-color", "red" );
		
	});
})(jQuery);