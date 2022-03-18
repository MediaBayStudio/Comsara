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

add_action( 'wp_print_styles', function() {
  global $preload_styles, $version ?>
  <!-- styles preload --> <?php
if ( $preload_styles ) :
  foreach ( $preload_styles as $preload_style ) :
    echo PHP_EOL ?>
  <link rel="preload" as="style" href="<?php echo "{$preload_style['url']}?ver={$version}" ?>" media="<?php echo $preload_style['media'] ?>" /> <?php
  endforeach;
endif;
} );

function enqueue_style( $style_name, $widths, $uri = '', $dir = '' ) {
  global $template_directory, $version, $preload_styles;

  if ( !$version) {
    $version = null;
  }

  $template_dir = $template_directory . $dir;

  if ( is_string( $widths ) ) {
    wp_enqueue_style( "{$style_name}", "{$uri}/{$style_name}.css", [], $version );
  } else {
    foreach ( $widths as $width ) {
      $style_id = "{$style_name}";
      $style_url = "{$uri}/{$style_name}";
      $style_media_query = 'all';

      if ( $width !== "0" ) {
        $media = $width - 0.02;

        if ( filesize( "{$template_dir}/{$style_name}.{$width}.css" ) === 0 ) {
          continue;
        }

        $style_id .= "-{$width}px";
        $style_url .= ".{$width}";
        $style_media_query = "(min-width: {$media}px)";
      }

      $style_url .= '.css';
      wp_enqueue_style( $style_id, $style_url, [], $version, $style_media_query );
      $preload_styles[] = [
        'url' => $style_url,
        'media' => $style_media_query
      ];
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
    enqueue_style( $GLOBALS['page_style_name'], $screen_widths, $template_directory_uri . '/css', '/css' );
  }

  // Scripts
	$scripts = ['svg4everybody.min.js', 'lazyload.min.js', 'Popup.min.js', 'slick.min.js', 'script.js'];

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
      case 'slick.min.js':
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
    if ( $handle === 'dnd-upload-cf7' ) {
      return '';
    }
    $html = str_replace( " id='$handle-css' ", '', $html );
    $html = str_replace( " type='text/css'", '', $html );
    return $html;
  }, 10, 2 );