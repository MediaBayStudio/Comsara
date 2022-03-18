<?php
function success_block( $args = [] ) {
  global $template_directory_uri;

  $defaults = [
    'icon' => '/img/icon-ok.svg',
    'title' => 'Thank you for getting in touch!',
    'descr' => 'We appreciate you contacting us. One of our colleagues will get back in touch with you soon! Have a great day!',
    'btn' => 'Ok'
  ];

  $parsed_args = array_merge( $defaults, $args ) ?>

  <div class="success-block"> <?php
    if ( $parsed_args['icon'] ) : ?>
      <img src="#" alt="Success icon" dats-src="<?php echo $template_directory_uri . $parsed_args['icon'] ?>" class="success-block__title lazy"> <?php
    endif;
    if ( $parsed_args['title'] ) : ?>
      <h2 class="success-block__title sect-h2"><?php echo $parsed_args['title'] ?></h2> <?php
    endif;
    if ( $parsed_args['descr'] ) : ?>
      <p class="success-block__descr"><?php echo $parsed_args['descr'] ?></p> <?php
    endif;
    if ( $parsed_args['btn'] ) : ?>
      <button class="success-block__btn"><?php echo $parsed_args['btn'] ?></button> <?php
    endif ?>    
  </div>

}