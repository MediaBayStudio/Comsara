<section class="index-forms"<?php echo $section_id ?>> <?php
  foreach ( $section['items'] as $form_sect ) : ?>
    <section class="form-sect container">
      <h2 class="form-sect__title sect-h2"><?php echo $form_sect['title'] ?></h2>
      <p class="form-sect__descr"><?php echo $form_sect['descr'] ?></p>
      <button type="button" class="form-sect__btn" data-form-id="<?php echo $form_sect['form'] ?>"><?php echo $form_sect['btn_text'] ?></button>
    </section> <?php
  endforeach;
  unset( $form_sect ) ?>
</section>