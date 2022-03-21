<?php
// Define template.php
add_filter( 'template_include', function( $template ) {
  global $post;

  $template_filename = pathinfo( $template )['filename'];

  if ( $template_filename === 'page' ) {
    $current_template = $post->post_name;
  } else {
    $current_template = $template_filename;
  }
  
  $GLOBALS['current_template'] = $current_template;

  if ( $post->post_type === 'page' ) {
    $page_template_id = $post->ID;
  } else {
    $page = get_pages( [
      'meta_key' => '_wp_page_template',
      'meta_value' => $GLOBALS['current_template'] . '.php'
    ] )[0];

    $page_template_id = $page->ID;
  }

  $GLOBALS['sections'] = get_field( 'sections', $page_template_id );
  return $template;
} );