<?php
function fail_block( $args = [] ) {
  global $template_directory_uri;

  $defaults = [
    'icon' => '/img/icon-fail.svg',
    'title' => 'Failed to send your message. ',
    'descr' => 'Something wrong, try one more time.',
    'btn' => 'Try again'
  ];

  $parsed_args = array_merge( $defaults, $args ) ?>

  <div class="fail-block"> <?php
    if ( $parsed_args['icon'] ) : ?>
      <img src="#" alt="fail icon" data-src="<?php echo $template_directory_uri . $parsed_args['icon'] ?>" class="fail-block__status-img lazy"> <?php
    endif;
    if ( $parsed_args['title'] ) : ?>
      <h2 class="fail-block__title sect-h2"><?php echo $parsed_args['title'] ?></h2> <?php
    endif;
    if ( $parsed_args['descr'] ) : ?>
      <p class="fail-block__descr"><?php echo $parsed_args['descr'] ?></p> <?php
    endif;
    if ( $parsed_args['btn'] ) : ?>
      <button class="fail-block__btn btn btn-ol-primary"><?php echo $parsed_args['btn'] ?></button> <?php
    endif ?>    
  </div> <?php

}