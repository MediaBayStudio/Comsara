;
(function() {
  let sliders = qa('.index-steps__list');
  if (sliders.length > 0) {
    const buildStepsSlider = function(slider, slides) {
      console.log('buildStepsSlider');
      const $slider = $(slider);
      if (media('(min-width:1023.98px)') && slides.length < 3) {
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
          dotsClass: 'index-steps__dots dots',
          customPaging: function() {
            return SLIDER.dot;
          },
          mobileFirst: true,
          responsive: [{
            breakpoint: 1023.98,
            settings: 'unslick'
          }]
        });
      }
    };
    for (let i = sliders.length - 1; i >= 0; i--) {
      const slider = sliders[i];
      const slides = qa('.step', slider);

      if (slides.length && slides.length > 1) {
        if (slider.classList.contains('lazy')) {
          slider.addEventListener('lazyloaded', function() {
            buildStepsSlider(slider, slides);
          });
        } else {
          buildStepsSlider(slider, slides);
        }
      }
    }
  }
})();