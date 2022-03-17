<section class="index-outstaffing sect container"<?php echo $section_id ?>>
  <h2 class="index-outstaffing__title sect-h2"><?php echo $section['title'] ?></h2>
  <p class="index-outstaffing__descr"><?php echo $section['descr'] ?></p>
  <picture class="index-outstaffing__pic lazy"> <?php
    // $img_url declared in functions.php ?>
    <source type="image/webp" srcset="#" data-srcset="<?php echo $img_url ?>/index-outstaffing-img.webp, <?php echo $img_url ?>/index-outstaffing-img@2x.webp 2x">
    <img src="#" alt="Woman is writing on the whiteboard" srcset="#" data-src="<?php echo $img_url ?>/index-outstaffing-img.png" data-srcset="<?php echo $img_url ?>/index-outstaffing-img@2x.png 2x" class="index-outstaffing__img">
  </picture> <?php
  if ( $section['items'] ) : ?>
    <div class="index-outstaffing__other-text-block"> <?php
      foreach ( $section['items'] as $item ) : ?>
        <p class="index-outstaffing__other-text"><?php echo $item['descr'] ?></p> <?php
      endforeach;
      unset( $item ) ?>
    </div> <?php
  endif ?>
</section>