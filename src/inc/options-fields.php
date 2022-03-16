<?php

function options_inp_html ( $id ) {
  echo "<input type='text' name='{$id}' value='" . esc_attr( get_option( $id ) ) . "'>";
}

// Add options fields
add_action( 'admin_init', function() {
  $options = [
    'tel'     =>  'Tel',
    'api_email'   =>  'Api E-mail',
    'hr_email'   =>  'hr E-mail'
    // 'address' =>  'Адрес',
    // 'coords'  =>  'Координаты маркера на карте',
    // 'zoom'    =>  'Увеличение карты'
  ];

  foreach ($options as $id => $name) {
    $my_id = "contacts_{$id}";

    add_settings_field( $id, $name, 'options_inp_html', 'general', 'default', $my_id );
    register_setting( 'general', $my_id );
  }
} );