<?php
// Disable wordpress styles and scripts
add_action( 'init', function() {
  // remove editor on pages
  remove_post_type_support( 'page', 'editor' );
  // Disable wp-emoji
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  // Disable wp-embed
  remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
  remove_action( 'wp_head', 'wp_oembed_add_host_js' );
  // Disable gutenberg
  // if ( 'disable_gutenberg' ) {
  //   add_filter( 'use_block_editor_for_post_type', '__return_false', 100 );
  //   remove_action( 'wp_enqueue_scripts', 'wp_common_block_scripts_and_styles' );
  //   add_action( 'admin_init', function() {
  //     remove_action( 'admin_notices', ['WP_Privacy_Policy_Content', 'notice'] );
  //     add_action( 'edit_form_after_title', ['WP_Privacy_Policy_Content', 'notice'] );
  //   } );
  // }
} );

/* Contact Form 7 */
// Disable css CF7
add_filter( 'wpcf7_load_css', '__return_false' );

// Disable CF7 autop
add_filter( 'wpcf7_autop_or_not', '__return_false' );
add_filter('wpcf7_form_elements', function($content) {
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
    return $content;
});