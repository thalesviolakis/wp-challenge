<?php


/**
 * Carrega os scripts necessários e as folhas de estilo do plugin
 */

function vortigo_front_script_style($hook)
{


  /* utilizando o datepicker nativo do wordpress */
  /*
  wp_enqueue_script(
    'vortigo-eventos-datepicker',
    plugins_url('vortigo-eventos') . '/js/main.js',
    array('jquery-ui-datepicker'),
    '1.0',
    true
  );*/

  //folha de estilo principal do plugin
  wp_enqueue_style(
    'vortigo-eventos-css',
    plugins_url('vortigo-eventos') . '/css/vortigo-eventos-style.css',
    false,
    '1.0',
    'all'
  );
}

add_action('wp_enqueue_scripts', 'vortigo_front_script_style');
