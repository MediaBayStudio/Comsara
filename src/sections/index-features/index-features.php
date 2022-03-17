<section class="index-features container sect"<?php echo $section_id ?>> <?php
if ( $section['title'] ) : ?>
  <h2 class="index-features__title sect-h2"><?php echo $section['title'] ?></h2> <?php
endif ?>
<ul class="index-features__list"> <?php
  foreach ( $section['items'] as $item ) : ?>
    <li class="features__item">
      <div data-src="url(<?php echo $item['icon']['url'] ?>)" class="feature__img lazy"></div>
      <h3 class="feature__title sect-h3"><?php echo $item['title'] ?></h3>
      <p class="feature__descr"><?php echo $item['descr'] ?></p>
    </li> <?php
  endforeach;
  unset( $item, $item_img_alt ) ?>
</ul>
</section>