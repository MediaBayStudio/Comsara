<section class="index-steps sect container"<?php echo $section_id ?>>
  <h2 class="index-steps__title sect-h2"><?php echo $section['title'] ?></h2>
  <ul class="index-steps__list"> <?php
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
          <button type="button" class="step__btn"><?php echo $item['btn_text'] ?></button> <?php
        endif ?>
      </li> <?php
    endforeach;
    unset( $item ) ?>
  </ul>
</section>