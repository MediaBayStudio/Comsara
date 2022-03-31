<section class="index-steps sect container"<?php echo $section_id ?>>
  <h2 class="index-steps__title sect-h2"><?php echo $section['title'] ?></h2>
  <ul class="index-steps__list lazy"> <?php
    foreach ( $section['items'] as $item ) :
      $item_hint_title = $item['hint_title'];
      $item_hint_descr = $item['hint_descr'] ?>
      <li class="steps__item step"> <?php
        if ( $item_hint_title && $item_hint_descr ) : ?>
          <div class="step__hint">
            <span class="step__hint-title"><?php echo $item_hint_title ?></span>
            <span class="step__hint-descr"><?php echo $item_hint_descr ?></span>
          </div> <?php
        endif ?>
        <h3 class="step__title sect-h3"><?php echo $item['title'] ?></h3> <?php
        echo $item['descr'];
        if ( $item['btn_text'] ) : ?>
          <button type="button" class="step__btn contact-popup-open"><?php echo $item['btn_text'] ?>
            <span class="icon-arrow">
              <svg viewBox="0 0 18 15" xmlns="http://www.w3.org/2000/svg" class="icon-arrow__svg">
                <path class="icon-arrow__path" fill-rule="evenodd" clip-rule="evenodd" d="M15.5996 7.13156L9.79502 1.327L10.3081 0.813941L16.9779 7.48372L16.9662 7.49541L17.1891 7.7183L10.5193 14.3881L10.0062 13.875L16.0241 7.85713L0.362582 7.85713L0.362582 7.13156L15.5996 7.13156Z" fill="white"/>
              </svg>
            </span>
          </button> <?php
        endif ?>
      </li> <?php
    endforeach;
    unset( $item ) ?>
  </ul>
</section>