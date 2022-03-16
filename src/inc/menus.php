<?php
add_action( 'after_setup_theme', function() {
  register_nav_menus( [
    'header_menu' =>  'header menu',
    // 'mobile_menu' =>  'mobile menu',
    // 'footer_menu' =>  'footer menu'
  ] );
} );

// Add classes to link <a>
add_filter( 'nav_menu_link_attributes', function( $atts, $item ) {
  $atts['class'] = 'nav-link';
  return $atts;
}, 10, 2);  

// All classes to list items <li>
add_filter( 'nav_menu_css_class', function( $classes, $item, $args, $depth ) {
  $container_class = $args->container_class;
  $li_class = '';

  switch ( $container_class ) {
    case 'hdr__nav':
      $li_class = 'hdr__nav-li';
      break;
    // case 'ftr__nav':
    //   $li_class = 'ftr__nav-li';
    //   break;
    case 'menu__nav':
      $li_class = 'menu__nav-li';
      break;
    default:
      $li_class = 'nav__li';
      break;
  }

  $classesArray = [ $li_class ];

  foreach ( $classes as $class ) {
    if ( $class === 'current-menu-item' ) {
      $classesArray[] = 'current';
    } else if ( $class === 'last' ) {
      $classesArray[] = 'last';
    }
  }
  return $classesArray;
}, 10, 4);

// Remove id
add_filter( 'nav_menu_item_id', function( $menu_id, $item, $args, $depth ) {
  return '';
}, 10, 4);