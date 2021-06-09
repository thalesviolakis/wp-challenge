<?php

add_action('widgets_init', 'vortigo_eventos_registrawidget');

//adiciona o widget no backend da aplicação

function vortigo_eventos_registrawidget()
{
  register_widget('EventosVortido');
}


//classe herda wp widget
class EventosVortido extends WP_Widget
{
  //adicionando construtor
  public function __construct()
  {
    //passa parametros de base
    parent::__construct(
      'vortigo_eventos_widget',
      'Eventos da Vortigo',
      array('description' => 'Mostra os eventos')
    );
  }

  /**
   * Para criar um formulário ou apresentar alguma mensagem dentro do Widget utilizamos a função form
   */

  public function form($instance)
  {
    echo '<p class="no-options-widget">' . __('Mostra automaticamente todos os eventos da empresa') . '</p>';
    return 'noform';
  }

  /**
   * A função utilizada para pegar os dados do formulário é a update, 
   * mas não haverá utilidade neste exemplo, pois não haverá um formulário.
   */

  /**
   * Mostrando no frontend da aplicação, utilizando a função widget
   */

  public function widget($args, $instance)
  {
?>

    <section class="eventos_principais">
      <h2 class="widget-title">Eventos da Vortigo</h3>
        <ul class="lista-Eventos">
          <?php
          /**
           * Organizando nossa query e buscando somente essencial
           */

          $args = array(
            'post_type' => 'eventos',
            'post_status' => 'publish',
            'posts_per_page' => 5,
            'orderby' => 'title',
            'order' => 'ASC',
          );

          /**
           * Realizando uma query para buscar os post_types relaciodos ao evento: Eventos
           * e montar o html no frontend da aplicação
           */

          $query = new WP_Query($args);

          while ($query->have_posts()) : $query->the_post();

            $dataBD = get_post_meta(get_the_ID(), 'vortigo_evento_data', true);
            strlen($dataBD) > 0 ? $data = date("d/m/Y", $dataBD) : $data = "A definir";

            $endereco = get_post_meta(get_the_ID(), 'vortigo_evento_local', true);
            echo "<li>";
            the_title('<span class="evento">', '</span>');
            echo "<span class='endereco'>" . $endereco . "</span>";
            echo "<span class='data'>" . $data . "</span>";
            echo "</li>";
          endwhile;
          wp_reset_postdata();
          ?>
        </ul>
    </section>
<?php
  }
}
