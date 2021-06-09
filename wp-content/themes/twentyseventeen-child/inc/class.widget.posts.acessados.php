<?php

/**
 * Classe para criar o widget 
 */
class vertigo_widget extends WP_Widget
{

  function __construct()
  {
    parent::__construct(

      // Id do Widfet
      'vertigo_widget',

      // Nome que aparecerá no Admin
      __('Vertigo Posts Mais Acessados', 'vertigo_widget_domain'),

      // Descrição
      array('description' => __('Widget', 'vertigo_widget_domain'),)
    );
  }

  // Gerando o widget no frontend

  public function widget($args, $instance)
  {
    $title = apply_filters('widget_title', $instance['title']);

    //Gerando o título do widget no frontend
    echo "<h2 class='widget-title'>" . $title . "</h2>";

    $args = array(
      'post_type' => 'post',
      'showposts' => '5',
      'meta_key' => 'vertigo_post_views_count',
      'orderby' => 'meta_value_num',
      'order' => 'DESC',
    );

    /**
     * Query para gerar no frontend os posts mais acessados
     */

    $the_query = new WP_Query($args);

    echo "<section class='widget-posts-maisacessados'>";

    if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
        <article <?php post_class("post_item"); ?> id="post_item-<?= get_the_ID(); ?>">
          <?php
          if (has_post_thumbnail()) :
            the_post_thumbnail('post-thumbnail', ['class' => 'post_image']);
          endif;
          ?>
          <header>
            <h3>
              <a href="<?= the_permalink(); ?>"><?= get_the_title(); ?></a>
              <span><?= vertigo_get_post_views(get_the_ID()); ?> visualiações</span>
            </h3>
          </header>
        </article>
    <?php
      endwhile;
    else : endif;
    wp_reset_query();
    wp_reset_postdata();

    echo "</section>";
  }

  // Widget Backend 
  public function form($instance)
  {
    if (isset($instance['title'])) {
      $title = $instance['title'];
    } else {
      $title = __('New title', 'vertigo_widget_domain');
    }
    // Widget admin form
    ?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </p>
<?php
  }

  //Atualizando o textfield título
  public function update($new_instance, $old_instance)
  {
    $instance = array();
    $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
    return $instance;
  }

  // Fim da classe
}
