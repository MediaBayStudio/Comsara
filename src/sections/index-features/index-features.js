;
(function() {
  let sliders = qa('.index-features');
  if (sliders.length > 0) {
    const buildFeaturesSlider = function(slider, slides) {
      console.log('buildFeaturesSlider');
      const $slider = $(slider);
      if (media('(min-width:767.98px)') && slides.length < 3) {
        if (SLIDER.hasSlickClass($slider)) {
          SLIDER.unslick($slider);
        }
      } else if (media('(min-width:1023.98px)') && slides.length < 4) {
        if (SLIDER.hasSlickClass($slider)) {
          SLIDER.unslick($slider);
        }
      } else {
        if (SLIDER.hasSlickClass($slider)) {
          return;
        }
        $slider.slick({
          infinite: false,
          arrows: false,
          dots: true,
          dotsClass: 'index-features__dots dots',
          customPaging: function() {
            return SLIDER.dot;
          },
          mobileFirst: true,
          responsive: [{
            breakpoint: 767.98,
            settings: {
              slidesToShow: 2
            }
          }, {
            breakpoint: 1023.98,
            settings: {
              slidesToShow: 3
            }
          }]
        });
      }
    };
    for (let i = sliders.length - 1; i >= 0; i--) {
      const slider = q('.index-features__list', sliders[i]);
      const slides = qa('.features__item', slider);

      if (slides.length && slides.length > 1) {
        if (slider.classList.contains('lazy')) {
          slider.addEventListener('lazyloaded', function() {
            buildFeaturesSlider(slider, slides);
          });
        } else {
          buildFeaturesSlider(slider, slides);
        }
      }
    }
  }
})();