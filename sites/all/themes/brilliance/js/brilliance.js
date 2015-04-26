(function ($) {
    if (Drupal.settings.navFixed) {
      var stickyRibbonTop = $('.navigation').offset().top;
      $(window).scroll(function(){
        if(($(window).scrollTop() > stickyRibbonTop) && $(window).width() > 768) {
          $('.navigation').css({position: 'fixed', top: '0px'});
        } else {
          $('.navigation').css({position: 'static', top: '0px'});
        }
      });
    }

  if ($(window).width() <= 767) {
    console.log(1);
    $('.expanded a').click(function() {
      $(this).siblings('ul').slideToggle(200);
    });
  }

  $('.brilliance-slider').brillianceSlider();

  //Remove click event for elements with dropdown children
  $('.expanded > a').click(false);
})(jQuery);
