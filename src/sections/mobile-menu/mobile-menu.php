<aside class="menu" style="display:none">
  <div class="menu__cnt container">
    <div class="menu__hdr">
      <img src="<?php echo $logo_url ?>" alt="Logo" width="130" height="30" class="menu__logo-img">
      <button type="button" class="menu__close"></button>
    </div> <?php
    wp_nav_menu( [
      'theme_location'  => 'header_menu',
      'container'       => 'nav',
      'container_class' => 'menu__nav',
      'menu_class'      => 'menu__nav-list',
      'items_wrap'      => '<ul class="%2$s">%3$s</ul>'
    ] );
    contacts_block( 'menu__contacts' ) ?>
  </div>
</aside>