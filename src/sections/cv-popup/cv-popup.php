<div class="cv-popup popup">
  <div class="cv-popup__cnt popup__cnt">
    <button type="button" class="cv-popup__close popup__close close-icon"></button> <?php
    echo do_shortcode( '[contact-form-7 id="' . $section['form'] . '" html_class="cv-popup__form popup__form"]' );
    success_block();
    fail_block(); ?>
  </div>
</div>