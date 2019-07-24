jQuery(document).ready(function(){
var mainfooter = jQuery( ".main-footer" );
jQuery( ".height-applied" ).css( "height" , mainfooter.innerHeight() );
});

(function() {
  function inviewExample() {
    var $example = jQuery('.height-applied')
    var inview

    if ($example.length) {
      inview = new Waypoint.Inview({
        element: jQuery('.height-applied')[0],
        enter: function(direction) {
          jQuery('.main-footer').addClass('is-inview')
        },
        entered: function(direction) {
           //jQuery('.main-footer').addClass('is-inview')
        },
        exit: function(direction) {
         //jQuery('.main-footer').removeClass('is-inview')
        },
        exited: function(direction) {
          jQuery('.main-footer').removeClass('is-inview')
        }
      })
    }
  }
inviewExample();

}())