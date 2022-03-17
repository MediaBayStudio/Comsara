<section class="index-technologies sect container"<?php echo $section_id ?>>
  <h2 class="index-technologies__title sect-h2"><?php echo $section['title'] ?></h2>
  <ul class="index-technologies__list"> <?php
    foreach ( $section['items'] as $item ) :
      $img_alt = $item['icon']['alt'];
      if ( !$img_alt ) {
        $img_alt = 'Logotype';
      } ?>
      <li class="technologies__item">
        <img src="#" alt="<?php echo $img_alt ?>" data-src="<?php echo $item['icon']['url'] ?>" class="technology__img lazy">
      </li> <?php
    endforeach;
    unset( $item, $img_alt ) ?>
  </ul>
</section>