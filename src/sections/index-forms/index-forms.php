<section class="index-forms"<?php echo $section_id ?>> <?php
  foreach ( $section['items'] as $form_sect ) : ?>
    <section class="form-sect container">
      <h2 class="form-sect__title sect-h2"><?php echo $form_sect['title'] ?></h2>
      <p class="form-sect__descr"><?php echo $form_sect['descr'] ?></p>
      <button type="button" class="form-sect__btn <?php echo $form_sect['popup'] ?>-popup-open"><?php echo $form_sect['btn_text'] ?>
        <span class="icon-arrow">
          <svg viewBox="0 0 18 15" xmlns="http://www.w3.org/2000/svg" class="icon-arrow__svg">
            <path class="icon-arrow__path" fill-rule="evenodd" clip-rule="evenodd" d="M15.5996 7.13156L9.79502 1.327L10.3081 0.813941L16.9779 7.48372L16.9662 7.49541L17.1891 7.7183L10.5193 14.3881L10.0062 13.875L16.0241 7.85713L0.362582 7.85713L0.362582 7.13156L15.5996 7.13156Z" fill="white"/>
          </svg>
        </span>
      </button>
    </section> <?php
  endforeach;
  unset( $form_sect ) ?>
</section>