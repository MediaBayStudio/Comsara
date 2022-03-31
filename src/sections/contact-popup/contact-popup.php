<div class="contact-popup popup">
  <div class="contact-popup__cnt popup__cnt">
    <button type="button" class="contact-popup__close popup__close close-icon"></button> <?php
    echo do_shortcode( '[contact-form-7 id="' . $section['form'] . '" html_class="contact-popup__form popup__form"]' );
    contacts_block('contact-popup__contacts-block');
    success_block();
    fail_block(); ?>
  </div>
</div>