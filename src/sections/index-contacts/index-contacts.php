<section class="index-contacts sect container"<?php echo $section_id ?>>
  <h2 class="index-contacts__title sect-h2"><?php echo $section['title'] ?></h2>
  <div class="index-contacts__left">
    <p class="index-contacts__descr"><?php echo $section['descr'] ?></p> <?php
    echo contacts_block( 'index-contacts-block' ) ?>
  </div>
  <div class="index-contacts__right">
    <p class="index-contacts__form-title"><?php echo $section['form_title'] ?></p> <?php
    echo do_shortcode( '[contact-form-7 id="' . $section['form'] . '" html_class="form index-contacts__form" html_id="index-contacts-form"]' );
    success_block();
    fail_block();  ?>
  </div>
</section>