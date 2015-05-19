(function ($) {
    if (Drupal.settings.navFixed) {
      var stickyRibbonTop = $('.navigation').offset().top;
      $(window).scroll(function(){
        if(($(window).scrollTop() > stickyRibbonTop) && $(window).width() > 768) {
          $('.navigation').addClass('fixedNav');
        } else {
          $('.navigation').removeClass('fixedNav');
        }
      });
    }

  var menuLink = $('.expanded > a'),
      menuInnerList = menuLink.siblings('ul');

  //Remove click event for elements with dropdown children
  //menuLink.click(false);

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

  Drupal.behaviors.themeName= {
    attach:function (context, settings) {

      // Здесь указываем ID блока с логином.
      var $login_block = $('#block-user-login');
      if ($login_block.length > 0) {

        // Далее при загрузке страницы
        // блок переместится в попап, но не покажется.
        $login_block.dialog({
          autoOpen: false,
          title: Drupal.t('Login'),
          resizable: false,
          modal: true,

          // Новые эффекты.
          show: 'fade',
          hide: 'puff',
          speed: 50
        });

        // По клику на ссылку логина - показываем попап.
        $('.user-login', context).click(function() {
          $login_block.dialog('open');
          return false;
        });
      }
    }
  };

})(jQuery);
