<section class="index-clients sect container"<?php echo $section_id ?>>
  <h2 class="index-clients__title sect-h2"><?php echo $section['title'] ?></h2>
  <div class="index-clients__list"> <?php
    foreach ( $section['items'] as $item ) :
      $link_target = $item['link']['target'];
      if ( $link_target ) {
        $link_target = ' target="' . $link_target . '"';
      } else {
        $link_target = '';
      } ?>
      <a class="clients__item" href="<?php echo $item['link']['url'] ?>"<?php echo $link_target ?>> <?php
        create_logotype_image( $item['icon'], 'client' ) ?>
      </a> <?php
    endforeach;
    unset( $item, $item_img_alt ) ?>
  </div>
</section>