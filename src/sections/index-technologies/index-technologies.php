<section class="index-technologies sect container"<?php echo $section_id ?>>
  <h2 class="index-technologies__title sect-h2"><?php echo $section['title'] ?></h2>
  <ul class="index-technologies__list"> <?php
    foreach ( $section['items'] as $item ) : ?>
      <li class="technologies__item"> <?php
        create_logotype_image( $item['icon'], 'technology' ) ?>
      </li> <?php
    endforeach;
    unset( $item, $img_alt ) ?>
  </ul>
</section>