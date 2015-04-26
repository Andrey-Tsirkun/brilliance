(function ($) {
  $.fn.brillianceSlider = function (options) {
    var sliderWrap = $('.brilliance-slider ul'),
        sliderItem = $('.brilliance-slider li'),
        sliderItemWidth = $('.brilliance-slider li img').width(),
        prevButton = $('.prevButton'),
        nextButton = $('.nextButton');

    var make = function () {
      sliderWrap.width(sliderItem.size() * sliderItemWidth + 'px');
      $('.brilliance-slider li:last-child').after($('.brilliance-slider li:first-child'));
      sliderWrap.css({'left': -sliderItemWidth + 'px'});
      nextButton.click(function () {
        var nextScroll = parseInt(sliderWrap.css('left')) - sliderItem.width();
        sliderWrap.animate({
          'left': nextScroll
        }, {duration: 150,
            complete: function () {
              $('.brilliance-slider li:last-child').after($('.brilliance-slider li:first-child'));
              sliderWrap.css({'left': -sliderItemWidth + 'px'});
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
            }});
      });
    };

    return this.each(make);
  };
})(jQuery);
