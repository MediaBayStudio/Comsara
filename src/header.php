<?php
global
  $webp_support,
  $api_email,
  $hr_email,
  $tel,
  $tel_clean,
  $version,
  $site_url,
  $logo_url,
  $screen_widths,
  $template_directory,
  $template_directory_uri;

$preload = [ $logo_url ];
$preload[] = [
  'url' => $template_directory_uri . '/img/icon-burger.svg',
  'media' => '(max-width:767.98px)'
];

if ( is_front_page() ) {
  $script_name = 'script-index';
  $style_name = 'style-index';

  $first_screen_image_ending = $webp_support ? 'webp' : 'jpg';
  $first_screen_image_type = $webp_support ? 'image/webp' : 'image/jpeg';
  $first_screen_images = [
    [
      'url' => 'index-hero-img.1280',
      'imagesrcset' => 'index-hero-img.1280@2x',
      'media' => '(min-width:1279.98px)'
    ],
    [
      'url' => 'index-hero-img.1024',
      'imagesrcset' => 'index-hero-img.1024@2x',
      'media' => '(min-width:1023.98px) and (max-width:1279.98px)'
    ],
    [
      'url' => 'index-hero-img.768',
      'imagesrcset' => 'index-hero-img.768@2x',
      'media' => '(min-width:767.98px) and (max-width:1023.98px)'
    ],
    [
      'url' => 'index-hero-img.576',
      'imagesrcset' => 'index-hero-img.576@2x',
      'media' => '(min-width:575.98px) and (max-width:767.98px)'
    ],
    [
      'url' => 'index-hero-img',
      'imagesrcset' => 'index-hero-img@2x',
      'media' => '(max-width:575.98px)'
    ]
  ];

  foreach ( $first_screen_images as $first_screen_image ) {
    $preload[] = [
      'url' => "{$template_directory_uri}/img/{$first_screen_image['url']}.{$first_screen_image_ending}",
      'imagesrcset' => "{$template_directory_uri}/img/{$first_screen_image['imagesrcset']}.{$first_screen_image_ending} 2x",
      'type' => $first_screen_image_type,
      'media' => $first_screen_image['media']
    ];
  }

} else if ( is_404() ) {
  $script_name = '';
  $style_name = 'style-index';
 } else {
  if ( $current_template ) {
    $script_name = 'script-' . $GLOBALS['current_template'];
    $style_name = 'style-' . $GLOBALS['current_template'];
  } else {
    $script_name = '';
    $style_name = '';
  }
}

$GLOBALS['page_script_name'] = $script_name;
$GLOBALS['page_style_name'] = $style_name ?>

<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=CustomEvent%2CIntersectionObserver%2CIntersectionObserverEntry%2CElement.prototype.closest%2CElement.prototype.dataset%2CHTMLPictureElement"></script>
  <meta charset="<?php bloginfo('charset') ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- styles preload -->
  <link rel="preload" as="style" href="<?php echo $template_directory_uri ?>/style.css"> <?php
if ( $style_name ) :
	foreach ( $screen_widths as $screen_width ) :
		$suffix = $screen_width === '0' ? '' : '.' . $screen_width ?>
		<link rel="preload" as="style" href="<?php echo "{$template_directory_uri}/css/{$style_name}{$suffix}.css?={$version}" ?>" /> <?php
  endforeach;
endif;
echo PHP_EOL ?>
  <!-- fonts preload --> <?php
	$fonts = [
		'Prompt-Medium.woff',
		'Prompt-Light.woff'
	];
foreach ( $fonts as $font ) : 
  echo PHP_EOL ?>
 <link rel="preload" href="<?php echo "$template_directory_uri/fonts/$font" ?>" as="font" type="font/woff" crossorigin="anonymous" /> <?php
endforeach;
echo PHP_EOL ?>
  <!-- other preload --> <?php
  echo PHP_EOL;
  if ( $preload ) {
    foreach ( $preload as $item ) {
      create_link_preload( $item );
    }
    unset( $item );
  echo PHP_EOL;
  } ?>
  <!-- favicons --> <?php
  echo PHP_EOL;
  wp_head() ?>
</head>

<body <?php body_class() ?>> <?php
  wp_body_open() ?>
  <noscript>
    <!-- <noindex> -->Для полноценного использования сайта включите JavaScript в настройках вашего браузера.
    <!-- </noindex> -->
  </noscript>
  <div id="page-wrapper">
    <header class="hdr container">
      <img src="<?php echo $logo_url ?>" alt="Logo" width="130" height="30" data-scroll-target="0" class="hdr__logo-img"> <?php
      wp_nav_menu( [
        'theme_location'  => 'header_menu',
        'container'       => 'nav',
        'container_class' => 'hdr__nav',
        'menu_class'      => 'hdr__nav-list',
        'items_wrap'      => '<ul class="%2$s">%3$s</ul>'
      ] ) ?>
      <button type="button" class="hdr__burger"></button> <?php
      require 'template-parts/mobile-menu.php' ?>
    </header>