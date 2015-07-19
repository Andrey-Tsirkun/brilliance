(function ($) {
    if (Drupal.settings.navFixed) {
      var nav = $('.navigation'),
          logo = $('.logo'),
          menuBlock = $('.navigation .block-menu'),
          homeLink = '<a href="'
              + Drupal.settings.homeLinkURL +
              '" class="homelink" title="'
              + Drupal.t('Home') + '">'
              + Drupal.t('Home') + '</a>';
          stickyRibbonTop = nav.offset().top;
      menuBlock.before(homeLink);
      $(window).scroll(function(){
        if(($(window).scrollTop() > stickyRibbonTop) && $(window).width() > 768) {
          nav.addClass('fixedNav');
        } else {
          nav.removeClass('fixedNav');
        }
        logo.css('top', -$(window).scrollTop());
      });
    }

  var mobileMenuButton = $('.mobileMenuButton'),
      navigation = $('.navigation');

  mobileMenuButton.click(function() {
    navigation.toggleClass('active');
  });

  var menuLink = $('.expanded > a'),
      menuInnerList = menuLink.siblings('ul');

  //Remove click event for elements with dropdown children
  menuLink.click(false);
  menuLink.addClass('ololo');

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
      var $loginBlock = $('#block-user-login');
      if ($loginBlock.length > 0) {

        // Далее при загрузке страницы
        // блок переместится в попап, но не покажется.
        $loginBlock.dialog({
          autoOpen: false,
          resizable: false,
          modal: true,
          dialogClass: 'ui-login',
          show: 'fade',
          hide: 'fade',
          speed: 50,
          open: function(){
            $('.ui-widget-overlay').bind('click',function(){
              $loginBlock.dialog('close');
            })
          }
        });

        // По клику на ссылку логина - показываем попап.
        $('.user-login', context).click(function() {
          $loginBlock.dialog('open');
          return false;
        });
      }
    }
  };

})(jQuery);
