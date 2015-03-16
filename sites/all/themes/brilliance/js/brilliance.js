/**
 * Created by Banzai on 16.03.2015.
 */
jQuery(document).ready(function($) {
  $(function(){
    var stickyRibbonTop = $('.navigation.fixed').offset().top;

    $(window).scroll(function(){
      if( $(window).scrollTop() > stickyRibbonTop ) {
        $('.navigation.fixed').css({position: 'fixed', top: '0px'});
      } else {
        $('.navigation.fixed').css({position: 'static', top: '0px'});
      }
    });
  });

});
