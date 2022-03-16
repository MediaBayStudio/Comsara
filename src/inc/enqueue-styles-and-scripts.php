<?php

// Admin style and script
add_action( 'admin_enqueue_scripts', function() {
  global $template_directory_uri, $version;
  if ( !$version) {
    $version = null;
  }
  wp_enqueue_script( "script-admin", $template_directory_uri . "/js/script-admin.js", [], $version );
  wp_enqueue_style( "style-admin", $template_directory_uri . "/css/style-admin.css", [], $version );
} );

function enqueue_style( $style_name, $widths, $uri = '' ) {
  global $template_directory, $version;

  if ( !$version) {
    $version = null;
  }

  if ( is_string( $widths ) ) {
    wp_enqueue_style( "{$style_name}", "{$uri}/{$style_name}.css", [], $version );
  } else {
    foreach ( $widths as $width ) {
      if ( $width !== "0" ) {
        $media = $width - 0.02;
         // если размер файла равен 0, то не подключаем его
        if ( filesize( "{$template_directory}/{$style_name}.{$width}.css" ) === 0 ) {
          continue;
        }
        wp_enqueue_style( "{$style_name}-{$width}px", "{$uri}/{$style_name}.{$width}.css", [], $version, "(min-width: {$media}px)" );
      } else {
        wp_enqueue_style( "{$style_name}", "{$uri}/{$style_name}.css", [], $version );
      }
    }
  }
}

add_action( 'wp_enqueue_scripts', function() {
  global $template_directory_uri, $screen_widths, $version;
  if ( !$version) {
    $version = null;
  }

  // Theme style
  enqueue_style( 'style', $screen_widths, $template_directory_uri );

  // Page style
  if ( $GLOBALS['page_style_name'] ) {
    enqueue_style( $GLOBALS['page_style_name'], $screen_widths, $template_directory_uri . '/css' );
  }

  // Scripts
	$scripts = ['svg4everybody.min.js', 'lazyload.min.js', 'Popup.min.js', 'script.js'];

  if ( $GLOBALS['page_script_name'] ) {
    $scripts[] = $GLOBALS['page_script_name'] . '.js';
  }

  foreach ( $scripts as $script ) {
    wp_enqueue_script( "{$script}", "{$template_directory_uri}/js/{$script}", [], $version );
  }

  // Jquery
  wp_deregister_script( 'jquery-core' );
  wp_deregister_script( 'jquery' );
  wp_register_script( 'jquery-core', "{$template_directory_uri}/js/jquery-3.5.1.min.js", false, null, true );
  wp_register_script( 'jquery', false, ['jquery-core'], null, true );
  wp_enqueue_script( 'jquery' );

} );

// Remove id and type in <script>, add defer
  add_filter( 'script_loader_tag',   function( $html, $handle ) {
    switch ( $handle ) {
      case 'svg4everybody.min.js':
  		case 'lazyload.min.js':
  		case 'Popup.min.js':
  		case 'script.js':
      case $GLOBALS['page_script_name'] . '.js':
      case 'contact-form-7':
        $html = str_replace( ' src', ' defer src', $html );
        break;
    }

    $html = str_replace( " id='$handle.js-js' ", '', $html );
    $html = str_replace( " type='text/javascript'", '', $html );

     return $html;
  }, 10, 2);

// Remove id and type in <link>
  add_filter( 'style_loader_tag', function( $html, $handle ) {
    if ( !is_single() && !is_admin() && $handle === 'wp-block-library' ) {
      return '';
    }
    $html = str_replace( " id='$handle-css' ", '', $html );
    $html = str_replace( " type='text/css'", '', $html );
    return $html;
  }, 10, 2 );