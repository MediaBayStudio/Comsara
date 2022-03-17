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
    <button type="button" class="specialties__item specialties__item-btn index-specialties__btn" data-scroll-target="#contacts">Find staff</button>
  </div>
</section>