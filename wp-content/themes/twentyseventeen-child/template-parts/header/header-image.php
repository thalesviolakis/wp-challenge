<?php

/**
 * Displays header media
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */

?>
<div class="custom-header">


  <script type="text/javascript">
    jQuery(window).load(function() {
      jQuery('#jquery-slider-demo').nivoSlider();
    });
  </script>

  <div class="custom-header-media">
    <?php the_custom_header_markup();

    //echo get_theme_mod('theme_header_bg');
    $banners = get_uploaded_header_images();
    //var_dump(get_uploaded_header_images());

    ?>

    <div id="wrapper">
      <div class="slider-wrapper theme-default">
        <div id="jquery-slider-demo" class="nivoSlider">
          <?php
          foreach ($banners as $slides => $value) {
            echo '<img src=' . $value["url"] . '>';
          }
          ?>
        </div>
      </div>
    </div>

    <?php get_template_part('template-parts/header/site', 'branding');
    ?>

  </div><!-- .custom-header -->