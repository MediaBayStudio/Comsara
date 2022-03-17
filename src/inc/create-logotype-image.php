<?php
function create_logotype_image( $image_object, $className = '' ) {
  $image_alt = $image_object['alt'];
  $image_url = $image_object['url'];

  if ( !$image_alt ) {
    $image_alt = 'Logotype';
  }

  $picture_class = 'class="';
  $image_class = 'class="';

  if ( $className ) {
    $picture_class .= $className . '__pic ';
    $image_class .= $className . '__img ';
  } else {
    $picture_class .= '';
    $image_class .= '';
  }

  $picture_class .= 'lazy"';
  $image_class .= 'lazy"';

  switch ( $image_object['mime_type'] ) {
    case 'image/png':
    case 'image/jpeg':
      $webp = image_get_intermediate_size( $image_object['id'], 'webp' );
      if ( $webp ) {
        $webp_html = '<source type="image/webp" srcset="#" data-srcset="' . $webp['url'] . '">'; 
      } else {
        $webp_html = '';
      }
      $image_html = "<img src=\"#\" alt=\"$image_alt\" data-src=\"$image_url\" $image_class>";
      $picture_html = "<picture $picture_class>$webp_html $image_html</picture>";
      echo $picture_html;
      break;
    default:
      echo "<img src=\"#\" alt=\"$image_alt\" data-src=\"$image_url\" $image_class>";
      break;
  } 
}