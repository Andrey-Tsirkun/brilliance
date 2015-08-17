(function ($) {
  Drupal.behaviors.brilliance = {
    attach: function (context, settings) {
      $.fn.brillianceSlider = function (options) {
        var sliderWrap = $('.brilliance-slider ul'),
            sliderItem = $('.brilliance-slider li'),
            sliderItemWidth = sliderItem.width(),
            prevButton = $('.prevButton'),
            nextButton = $('.nextButton'),
            maxWidth = 1140;

        console.warn(11 + ' ' + sliderItemWidth);

        var make = function () {
          if($(window).width() < maxWidth) {
            console.warn(1 + ' ' + sliderItemWidth);
            var windowWidth = $(window).width();
            sliderItemWidth = windowWidth;
            sliderItem.find('a').width(windowWidth);
            sliderWrap.width(sliderItem.size() * windowWidth).css({'left': -windowWidth + 'px'});
          }
          else {
            console.warn(2 + ' ' + sliderItemWidth);
            sliderWrap.width(sliderItem.size() * sliderItemWidth).css({'left': -sliderItemWidth + 'px'});
          }

          function addActiveClass () {
            sliderItem.removeClass('active');
            sliderWrap.children('li').eq(1).addClass('active');
          }

          addActiveClass();

          if (Drupal.settings.sliderAnimation) {
            function sliderAutoscroll(){
              nextButton.trigger('click');
              setTimeout(sliderAutoscroll, 3000);
            }

            sliderAutoscroll();
          }

          nextButton.click(function () {
            var nextScroll = parseInt(sliderWrap.css('left')) - sliderItem.width();
            sliderWrap.animate({
              'left': nextScroll
            }, {duration: 150,
              complete: function () {
                $('.brilliance-slider li:last-child').after($('.brilliance-slider li:first-child'));
                sliderWrap.css({'left': -sliderItemWidth + 'px'});
                addActiveClass();
              }});
          });
          prevButton.click(function () {
            var prevScroll = parseInt(sliderWrap.css('left')) + sliderItem.width();
            sliderWrap.animate({
              'left': prevScroll
            }, {duration: 150,
              complete: function () {
                $('.brilliance-slider li:first-child').before($('.brilliance-slider li:last-child'));
                sliderWrap.css({'left': -sliderItemWidth + 'px'});
                addActiveClass();
              }});
          });

          $(window).resize(function(){

          });
        };

        return this.each(make);
      };
    }
  }

})(jQuery);
