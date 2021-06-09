<?php

/**
 * Criando custom post type para eventos da vortigo
 */

function vortigo_eventos_custom_post_type()
{
  $labels = array(
    'name' => __('Eventos', 'vortigo'),
    'singular_name' => __('Evento', 'vortigo'),
    'add_new_item' => __('Adicionando Evento', 'vortigo'),
    'all_items' => __('Todos os Eventos', 'vortigo'),
    'edit_item' => __('Editar Evento', 'vortigo'),
    'new_item' => __('Novo Evento', 'vortigo'),
    'view_item' => __('Novo Evento', 'vortigo'),
    'not_found' => __('Evento não encontrado', 'vortigo'),
    'not_found_in_trash' => __('Não existem eventosna lixeira', 'vortigo')
  );

  //defindo somente suportes necessários
  $supports = array('title');

  //enviando argumentos
  $args = array(
    'label' => __('Eventos', 'vortigo'),
    'labels' => $labels,
    'description' => __('Lista de eventos', 'vortigo'),
    'public' => true,
    'show_in_menu' => true,
    'menu_icon' => 'dashicons-calendar',
    'has_archive' => true,
    'rewrite' => true,
    'supports' => $supports
  );

  //registrando
  register_post_type('Eventos', $args);
}

//executando 
add_action('init', 'vortigo_eventos_custom_post_type');

/**
 * Configurando os metaboxes para o cliente gravar as informações 
 * no backend da aplicação
 */

function vortigo_eventos_metabox()
{
  add_meta_box(
    'vortigo-informacao-metabox',
    __('Informação', 'vortigo'),
    'vortigo_render_informacao_metabox',
    'Eventos'
  );
}
//executando 
add_action('add_meta_boxes', 'vortigo_eventos_metabox');


function vortigo_render_informacao_metabox($post)
{
  // para segurança registrando nonce fields
  wp_nonce_field(basename(__FILE__), 'vortigo-evento-informacao-nonce');

  // obtendo dados previamente salvos do banco de dados
  $evento_data = get_post_meta($post->ID, 'vortigo_evento_data', true);
  $evento_local = get_post_meta($post->ID, 'vortigo_evento_local', true);
  $evento_observacoes = get_post_meta($post->ID, 'vortigo_evento_observacoes', true);
?>

  <!-- gerando o frontend da aplicação -->
  <label for="vortigo-evento-data"><?php _e('Data:', 'vortigo-evento-data'); ?></label>
  <input class="widefat dataevento" id="vortigo-evento-data" type="date" name="vortigo-evento-data" value="<?php echo date('d/m/Y', $evento_data); ?>" />

  <label for="vortigo-evento-local"><?php _e('Local:', 'vortigo-evento-local'); ?></label>
  <input class="widefat" id="vortigo-evento-local" type="text" name="vortigo-evento-local" placeholder="Avenida Paulista, 300" value="<?php echo $evento_local; ?>" />

  <label for="vortigo-evento-observacoes"><?php _e('Observações:', 'vortigo-evento-observacoes'); ?></label>
  <input class="widefat" id="vortigo-evento-observacoes" type="text" name="vortigo-evento-observacoes" placeholder="Observações" value="<?php echo $evento_observacoes; ?>" />

<?php
}



/**
 * Realizando salvamento no banco de dados
 */

function vortigo_save_eventos($post_id)
{

  // por segurança se não estiver no post_type correto, de eventos não executa
  if ('eventos' != isset($_POST['post_type'])) {
    return;
  }

  // checking for the 'save' status
  $is_valid_nonce = (isset($_POST['vortigo-evento-informacao-nonce']) && (wp_verify_nonce($_POST['vortigo-evento-informacao-nonce'], basename(__FILE__)))) ? true : false;

  //verificando nonces, caso for falso não executa 
  if (!$is_valid_nonce) {
    return;
  }


  //caso a informação seja enviada, grava no banco realizando a sanitização

  if (isset($_POST['vortigo-evento-data'])) {
    update_post_meta($post_id, 'vortigo_evento_data', sanitize_text_field(strtotime($_POST['vortigo-evento-data'])));
  }

  if (isset($_POST['vortigo-evento-local'])) {
    update_post_meta($post_id, 'vortigo_evento_local', sanitize_text_field($_POST['vortigo-evento-local']));
  }

  if (isset($_POST['vortigo-evento-observacoes'])) {
    update_post_meta($post_id, 'vortigo_evento_observacoes', sanitize_text_field($_POST['vortigo-evento-observacoes']));
  }
}

add_action('save_post', 'vortigo_save_eventos');


/**
 * Adicionando colunas personalizadas
 */

function vortigo_custom_columns_head($defaults)
{

  //removendo coluna padrão do wordpress de data
  unset($defaults['date']);

  //adicionando colunas do importantes do evento
  $defaults['vortigo_evento_data'] = __('Data', 'vortigo');
  $defaults['vortigo_evento_local'] = __('Local', 'vortigo');
  $defaults['vortigo_evento_observacoes'] = __('Observações', 'vortigo');
  //mostra 
  return $defaults;
}


add_filter('manage_edit-eventos_columns', 'vortigo_custom_columns_head', 10);

/**
 * Personalizando as colunas do backend para cliente somente
 * visualizar os dados do evento 
 * Data do evento, local & observações
 */

function vertigo_eventos_columns_content($column_name, $post_id)
{

  if ('vortigo_evento_data' == $column_name) {
    $valor = get_post_meta($post_id, 'vortigo_evento_data', true);

    if (!empty($valor))
      echo date("d/m/Y", $valor);

    if (empty($valor))
      echo "A Definir";
  }

  if ('vortigo_evento_local' == $column_name) {
    $valor = get_post_meta($post_id, 'vortigo_evento_local', true);
    echo $valor;
  }

  if ('vortigo_evento_observacoes' == $column_name) {
    $valor = get_post_meta($post_id, 'vortigo_evento_observacoes', true);
    echo $valor;
  }
}
add_action('manage_eventos_posts_custom_column', 'vertigo_eventos_columns_content', 10, 2);

/**
 * Após salvar os dados no banco, redireciona para listagem
 */

function redirect_after_save_eventos($location)
{
  // Carrega apenas no post type de eventos
  if ('eventos' == get_post_type()) {
    if (isset($_POST['save']) || isset($_POST['publish']))
      return admin_url("edit.php?post_type=eventos");
  }
  return $location;
}

add_filter('redirect_post_location', 'redirect_after_save_eventos');
