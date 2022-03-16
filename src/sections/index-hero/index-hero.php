<section class="index-hero container"<?php echo $section_id ?>> <?php
  $images_url = $template_directory_uri . '/img' ?>
  <picture class="index-hero__pic">
    <source type="image/webp" media="(max-width:575.98px)" srcset="<?php echo $images_url ?>/index-hero-img.webp, <?php echo $images_url ?>/index-hero-img@2x.webp 2x">
    <source type="image/jpeg" media="(max-width:575.98px)" srcset="<?php echo $images_url ?>/index-hero-img.jpg, <?php echo $images_url ?>/index-hero-img@2x.jpg 2x">

    <source type="image/webp" media="(min-width:575.98px) and (max-width:767.98px)" srcset="<?php echo $images_url ?>/index-hero-img.576.webp, <?php echo $images_url ?>/index-hero-img.576@2x.webp 2x">
    <source type="image/jpeg" media="(min-width:575.98px) and (max-width:767.98px)" srcset="<?php echo $images_url ?>/index-hero-img.576.jpg, <?php echo $images_url ?>/index-hero-img@.5762x.jpg 2x">

    <source type="image/webp" media="(min-width:767.98px) and (max-width:1023.98px)" srcset="<?php echo $images_url ?>/index-hero-img.768.webp, <?php echo $images_url ?>/index-hero-img.768@2x.webp 2x">
    <source type="image/jpeg" media="(min-width:767.98px) and (max-width:1023.98px)" srcset="<?php echo $images_url ?>/index-hero-img.768.jpg, <?php echo $images_url ?>/index-hero-img@.768.jpg 2x">

    <source type="image/webp" media="(min-width:1023.98px) and (max-width:1279.98px)" srcset="<?php echo $images_url ?>/index-hero-img.1024.webp, <?php echo $images_url ?>/index-hero-img.1024@2x.webp 2x">
    <source type="image/jpeg" media="(min-width:1023.98px) and (max-width:1279.98px)" srcset="<?php echo $images_url ?>/index-hero-img.1024.jpg, <?php echo $images_url ?>/index-hero-img@.1024.jpg 2x">

    <source type="image/webp" media="(min-width:1279.98px)" srcset="<?php echo $images_url ?>/index-hero-img.1280.webp, <?php echo $images_url ?>/index-hero-img.1280@2x.webp 2x">
    <source type="image/jpeg" media="(min-width:1279.98px)" srcset="<?php echo $images_url ?>/index-hero-img.1280.jpg, <?php echo $images_url ?>/index-hero-img@.1280.jpg 2x">
    <img src="<?php echo $images_url ?>/index-hero-img.jpg" alt="hero image" class="index-hero__img">
  </picture>
  <h1 class="index-hero__title sect-h1"><?php echo $section['title'] ?></h1>
  <p class="index-hero__descr"><?php echo $section['descr'] ?></p> <?php
  $index_hero_blue_btn_text = $section['blue_btn_text'];
  $index_hero_ol_btn_text = $section['ol_btn_text'];
  if ( $index_hero_blue_btn_text || $index_hero_ol_btn_text ) : ?>
    <div class="index-hero__btns">
      <button type="button" class="index-hero__btn btn btn-primary" data-scroll-target="<?php echo $section['blue_btn_target'] ?>"><?php echo $index_hero_blue_btn_text ?></button>
      <button type="button" class="index-hero__btn btn btn-ol-primary" data-scroll-target="<?php echo $section['ol_btn_target'] ?>"><?php echo $index_hero_ol_btn_text ?></button>
    </div> <?php
  endif ?>
</section>