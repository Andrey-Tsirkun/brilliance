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

  var menuLink = $('.expanded > a'),
      menuInnerList = menuLink.siblings('ul');

  //Remove click event for elements with dropdown children
  menuLink.click(false);

  function menuBehaviour () {
    if ($(window).width() <= 767) {
      menuLink.click(function() {
        $(this).toggleClass('activeUl');
        $(this).unbind('mouseenter mouseleave');
        $(this).siblings('ul').slideToggle(200);
      });
    }
    if ($(window).width() > 768) {
      menuInnerList.hover(function() {
        $(this).siblings('a').toggleClass('activeUl');
      });
    }
  }

  menuBehaviour();

  $(window).resize(function() {
    menuBehaviour();
  });


  $('.brilliance-slider').brillianceSlider();

})(jQuery);
