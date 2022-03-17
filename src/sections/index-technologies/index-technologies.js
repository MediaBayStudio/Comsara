;
(function() {
  const sliders = qa('.index-technologies__list');
  if (sliders.length > 0) {
    const buildTechnologiesSlider = function(slider, slides) {
      console.log('buildTechnologiesSlider');
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
          rows: 2,
          slidesPerRow: 2,
          dotsClass: 'index-technologies__dots dots',
          customPaging: function() {
            return SLIDER.dot;
          },
          mobileFirst: true,
          responsive: [{
            breakpoint: 767.98,
            settings: 'unslick'
          }]
        });
      }
    };
    for (let i = sliders.length - 1; i >= 0; i--) {
      const slider = sliders[i];
      const slides = qa('.technologies__item', slider);

      if (slides.length && slides.length > 1) {
        if (slider.classList.contains('lazy')) {
          slider.addEventListener('lazyloaded', function() {
            console.log('lazyloaded');
            buildTechnologiesSlider(slider, slides);
          });
        } else {
          buildTechnologiesSlider(slider, slides);
        }
      }
    }
  }
})();