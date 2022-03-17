<section class="index-services container sect"<?php echo $section_id ?>>
  <h2 class="index-services__title sect-h2"><?php echo $section['title'] ?></h2>
  <p class="index-services__descr"><?php echo $section['descr'] ?></p>
  <picture class="index-services__pic lazy"> <?php
    // $img_url declared in functions.php ?>
    <source type="image/webp" srcset="#" data-srcset="<?php echo $img_url ?>/index-services-img.webp, <?php echo $img_url ?>/index-services-img@2x.webp 2x" media="(min-width:1023.98px), (max-width:767.98px)">
    <source type="image/webp" srcset="#" data-srcset="<?php echo $img_url ?>/index-services-img.768.webp, <?php echo $img_url ?>/index-services-img.768@2x.webp 2x" media="(min-width:767.98px) and (max-width:1023.98px)">
    <source type="image/jpeg" srcset="#" data-srcset="<?php echo $img_url ?>/index-services-img.768.jpg, <?php echo $img_url ?>/index-services-img.768@2x.jpg 2x" media="(min-width:767.98px) and (max-width:1023.98px)">
    <img src="#" srcset="#" alt="Computer work" data-src="<?php echo $img_url ?>/index-services-img.jpg" data-srcset="<?php echo $img_url ?>/index-services-img@2x.jpg 2x" class="index-services__img">
  </picture>
  <ul class="index-services__list"> <?php
    foreach ( $section['items'] as $item ) : ?>
      <li class="services-list__item"><?php echo $item['title'] ?></li> <?php
    endforeach ?>
  </ul>
</section>