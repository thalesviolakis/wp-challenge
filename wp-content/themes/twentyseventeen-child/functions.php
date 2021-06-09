<?php

/**
 * Função para carregar o css sem afetar o core do template
 */

function childtheme_enqueue_styles()
{
  wp_enqueue_style(
    'parent-style',
    get_template_directory_uri() . '/style.css'
  );
}

//Adicionando Hook para carregar css
add_action('wp_enqueue_scripts', 'childtheme_enqueue_styles');


// Carregando nossos scripts e estilos
function load_scripts()
{
  //Adicionando Script a fila
  wp_enqueue_script(
    'nivoslider-js',
    get_stylesheet_directory_uri()  . '/assets/js/jquery.nivo.slider.js',
    array(),
    '1.0.0',
    true
  );
  //Adicionando CSS stylesheet a fila
  wp_enqueue_style(
    'nivoslider-css',
    get_stylesheet_directory_uri() . '/assets/css/nivoslider/nivoslider.css',
    array(),
    '3.2.0',
    'all'
  );

  //Adicionando CSS stylesheet a fila
  wp_enqueue_style(
    'nivoslider-default-css',
    get_stylesheet_directory_uri() . '/assets/css/nivoslider/default.min.css',
    array(),
    '3.2.0',
    'all'
  );

  //Adicionando CSS stylesheet a fila
  wp_enqueue_style(
    'nivoslider-bar-css',
    get_stylesheet_directory_uri() . '/assets/css/nivoslider/bar.css',
    array(),
    '3.2.0',
    'all'
  );
}

//Adicionando Hook para carregar os scripts
add_action('wp_enqueue_scripts', 'load_scripts');



/**
 * Carregando a classe que realiza o controle de contagem acessos
 */
require('inc/class.widget.posts.acessados.php');


/**
 * Funcionalidade para registrar as visitas de cada post
 */

//Setter
function vertigo_set_post_views($postID)
{
  $chave = 'vertigo_post_views_count';
  $acessos = get_post_meta($postID, $chave, true);
  if ($acessos == '') {
    $acessos = 0;
    delete_post_meta($postID, $chave);
    add_post_meta($postID, $chave, '0');
  } else {
    $acessos++;
    update_post_meta($postID, $chave, $acessos);
  }
}


//Getter
function vertigo_get_post_views($postID)
{
  $chave = 'vertigo_post_views_count';
  $acessos = get_post_meta($postID, $chave, true);
  if ($acessos == '') {
    return "0";
  }
  return $acessos;
}


/**
 * Registrando o widget que será utilizado 
 */

function vertigo_load_widget()
{
  register_widget('vertigo_widget');
}

add_action('widgets_init', 'vertigo_load_widget');
