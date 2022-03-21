<section class="index-specialties container sect"<?php echo $section_id ?>>
  <h2 class="index-specialties__title sect-h2"><?php echo $section['title'] ?></h2>
  <div class="index-specialties__block">
    <p class="index-specialties__descr specialties__item specialties__item-p"><?php echo $section['descr'] ?></p> <?php
    $index = 0;
    foreach ( $section['items'] as $item ) :
      if ( $index === 2) : ?>
        <div class=" specialties__item specialties__item-img lazy" data-src="url(<?php echo $img_url ?>/index-specialties-img-1.svg)"></div> <?php
      endif ?>
      <div class="specialties__item specialtiy" style="order: <?php echo $index ?>"><?php echo $item['title'] ?></div> <?php
      $index++;
    endforeach;
    unset( $item, $index ) ?>
    <picture class="specialties__item specialties__item-pic index-specialties__pic lazy">
      <source type="image/webp" srcset="#" data-srcset="<?php echo $img_url ?>/index-specialties-img-2.webp, <?php echo $img_url ?>/index-specialties-img-2@2x.webp 2x">
      <img src="#" srcset="#" alt="Laptop" data-src="<?php echo $img_url ?>/index-specialties-img-2.jpg"
      data-srcset="<?php echo $img_url ?>/index-specialties-img-2@2x.jpg 2x" class="index-specialties__img">
    </picture>
    <button type="button" class="specialties__item specialties__item-btn index-specialties__btn" data-scroll-target="#contacts">Find staff
      <span class="icon-arrow">
        <svg viewBox="0 0 18 15" xmlns="http://www.w3.org/2000/svg" class="icon-arrow__svg">
          <path class="icon-arrow__path" fill-rule="evenodd" clip-rule="evenodd" d="M15.5996 7.13156L9.79502 1.327L10.3081 0.813941L16.9779 7.48372L16.9662 7.49541L17.1891 7.7183L10.5193 14.3881L10.0062 13.875L16.0241 7.85713L0.362582 7.85713L0.362582 7.13156L15.5996 7.13156Z" fill="white"/>
        </svg>
      </span>
    </button>
  </div>
</section>