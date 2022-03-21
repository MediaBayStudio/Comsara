<?php
add_action( 'save_post_page', function( $post_ID ) {
  if ( !function_exists( 'get_field' ) ) {
    return;
  }
  global $template_directory;

  $screen_widths = ['0', '576', '768', '1024', '1280'];

  $acf = $_REQUEST['acf'];

  $sections = [
    'header',
    'mobile-menu'
  ];

  foreach ( $acf as $fields ) {
    $continue = false;

    if ( is_array( $fields ) ) {
      foreach ( $fields as $field ) {
        if ( $field['acf_fc_layout'] ) {
          $sections[] = $field['acf_fc_layout'];
        } else {
          $continue = true;
          break;
        }
      }
    }

    if ( $continue ) {
      continue;
    }
  }

  $sections[] = 'footer';

  // JavaScript
  $javascript_content = 'document.addEventListener(\'DOMContentLoaded\', function() {';
  $javascript_content .= PHP_EOL;

  $template_slug = str_replace( '.php', '', get_page_template_slug( $post_ID ) );
  if ( !$template_slug ) {
    $page = get_post( $post_ID );
    $template_slug = $page->post_name;
  }
  $page_info_cnt[ $template_slug ] = [];

  foreach ( $sections as $section ) {
    // unique array
    if ( !in_array( $section, $page_info_cnt[ $template_slug ] ) ) {
      $page_info_cnt[ $template_slug ][] = $section;
    }

    // Combine javascript content
    $section_filename = $section . '.js';
    $section_fielpath = php_path_join( $template_directory, 'sections', $section, $section_filename );
    if ( file_exists( $section_fielpath ) ) {
      $section_content = file_get_contents( $section_fielpath );
      if ( $section_content ) {
        $javascript_content .= "\n// " . $section . "\n" . $section_content;
      }
    }
  } // endforeach $sections

  $javascript_destination = php_path_join( $template_directory, 'js', 'script-' . $template_slug . '.js' );

  if ( file_exists( $javascript_destination ) ) {
    unlink( $javascript_destination );
  }

  $javascript_content .= PHP_EOL . '});';

  file_put_contents( $javascript_destination, $javascript_content );

  // CSS
  foreach ( $screen_widths as $width ) {
    if ( !$template_slug ) {
      break;
    }

    $css_content = '';

    if ( $width === '0') {
      $slug = $template_slug;
    } else {
      $slug = $template_slug . '.' . $width;
    }

    foreach ( $sections as $section ) {
      if ( $width === '0' ) {
        $filename = $section . '.css';
      } else {
        $filename = $section . '.' . $width . '.css';
      }

      $filepath = php_path_join( $template_directory, 'sections', $section, $filename );

      if ( file_exists( $filepath ) ) {
        $css_content .= file_get_contents( $filepath );
      }
    } // endforeach $sections

    $css_destination = php_path_join( $template_directory, 'css', 'style-' . $slug . '.css' );

    if ( file_exists( $css_destination ) ) {
      unlink( $css_destination );
    }

    file_put_contents( $css_destination, $css_content );
  } // endforeach $screen_widths

  // Create template-directory-uri/pages-info.json
  build_pages_info( $page_info_cnt );

}, 10, 3 );