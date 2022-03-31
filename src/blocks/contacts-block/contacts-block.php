<?php
function contacts_block( $className = '' ) {
  global $tel, $tel_clean, $api_email, $hr_email;
  $className = $className ? ' ' . $className : '' ?>
  <div class="contacts-block<?php echo $className ?>"> <?php
    if ( $tel ) : ?>
      <div class="contacts-block__contact">
        <span class="contacts-block__contact-title">Call us:</span>
        <a href="tel:<?php echo $tel_clean ?>" class="contacts-block__contact-tel contacts-block__contact-link"><?php echo $tel ?></a>
      </div> <?php
    endif;
    if ( $api_email || $hr_email ) : ?>
      <div class="contacts-block__contact">
        <span class="contacts-block__contact-title">Write to e-mail:</span> <?php
        if ( $api_email ) : ?>
          <a href="mailto:<?php echo $api_email ?>" class="contacts-block__contact-email contacts-block__contact-link"><?php echo $api_email ?></a> <?php
        endif;
        if ( $hr_email ) : ?>
          <a href="mailto:<?php echo $hr_email ?>" class="contacts-block__contact-email contacts-block__contact-link"><?php echo $hr_email ?></a> <?php
        endif ?>
      </div> <?php
    endif ?>
  </div> <?php
}