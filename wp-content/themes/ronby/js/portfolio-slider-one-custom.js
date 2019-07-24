(function($, window, document) {

    "use strict"; // a stric mode 

    // initiall functions  ...
    var tp_obj = {

        // Portfolio Carousel Layout 2
        portfolio_owl: function() {
            var powl = $('body').find('.portfolio-owl');
            if (powl.length) {
                powl.each(function() {
                    var _powl = $(this);
                    var to_show, dots, nav, loop;
                    to_show = _powl.data('show');
                    to_show = (to_show !== 'undefined') ? parseInt(to_show, 10) : 3;
                    dots = _powl.data('dots');
                    dots = (dots !== 'off') ? true : false;
                    nav = _powl.data('nav');
                    nav = (nav !== 'off') ? true : false;
                    loop = _powl.data('loop');
                    loop = (loop !== 'no') ? true : false;
                    var to_show_576 = (to_show === 1) ? 1 : 2;
                    var to_show_768 = (to_show === 1) ? 1 : 2;

                    _powl.owlCarousel({
                        items: to_show,
                        autoplay: true,
                        autoplayTimeout: 7000,
                        autoplayHoverPause: true,
                        responsiveClass: true,
                        nav: nav,
                        dots: dots,
                        responsive: {
                            0: {
                                items: 1,
                                loop: loop
                            },
                            576: {
                                items: to_show_576,
                                loop: loop

                            },
                            768: {
                                items: to_show_768,
                                loop: loop

                            },
                            1140: {
                                items: to_show,
                                nav: nav,
                                loop: loop
                            }
                        }
                    });
                });
            }
        },
    };

    // Dom Ready Function
    jQuery(document).ready(function() {

        (function($) {
            tp_obj.portfolio_owl();
        })(jQuery);
    });
    // end of use strict function
}(window.jQuery, window, document));