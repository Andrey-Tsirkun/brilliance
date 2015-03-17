(function ($) {
    if (Drupal.settings.navFixed) {
      var stickyRibbonTop = $('.navigation').offset().top;
      $(window).scroll(function(){
        if( $(window).scrollTop() > stickyRibbonTop ) {
          $('.navigation').css({position: 'fixed', top: '0px'});
        } else {
          $('.navigation').css({position: 'static', top: '0px'});
        }
      });
    }
})(jQuery);
