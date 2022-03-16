<?php
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-logo' );

// Remove standart thumbnails
add_filter( 'intermediate_image_sizes', function ( $sizes ){
  return array_diff( $sizes, [
    'medium',
    'medium_large',
    'large',
    '1536x1536',
    '2048x2048',
  ] );
} );

// add_filter( 'big_image_size_threshold', function() {
	// return 1200;
// } );