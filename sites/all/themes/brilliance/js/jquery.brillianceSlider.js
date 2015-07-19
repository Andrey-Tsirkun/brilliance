(function ($) {
  $.fn.brillianceSlider = function (options) {
    var sliderWrap = $('.brilliance-slider ul'),
        sliderItem = $('.brilliance-slider li'),
        sliderItemImg = $('.brilliance-slider li img'),
        sliderItemImgWidth = sliderItemImg.width(),
        prevButton = $('.prevButton'),
        nextButton = $('.nextButton'),
        maxWidth = 1140;

    if($(window).width() < maxWidth) {
      sliderItem.width($(window).width());
    }

    var make = function () {
      sliderWrap.width(sliderItemImg.size() * sliderItemImgWidth + 'px');
      sliderWrap.css({'left': -sliderItemImgWidth + 'px'});

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
        var nextScroll = parseInt(sliderWrap.css('left')) - sliderItemImg.width();
        sliderWrap.animate({
          'left': nextScroll
        }, {duration: 150,
          complete: function () {
            $('.brilliance-slider li:last-child').after($('.brilliance-slider li:first-child'));
            sliderWrap.css({'left': -sliderItemImgWidth + 'px'});
            addActiveClass();
          }});
      });
      prevButton.click(function () {
        var prevScroll = parseInt(sliderWrap.css('left')) + sliderItemImg.width();
        sliderWrap.animate({
          'left': prevScroll
        }, {duration: 150,
            complete: function () {
              $('.brilliance-slider li:first-child').before($('.brilliance-slider li:last-child'));
              sliderWrap.css({'left': -sliderItemImgWidth + 'px'});
              addActiveClass();
            }});
      });

      $(window).resize(function(){

      });
    };

    return this.each(make);
  };
})(jQuery);
