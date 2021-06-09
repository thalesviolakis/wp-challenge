<?php
/*
 * Plugin Name: Cadastrar Eventos
 * Description: Plugin para cadastrar eventos da empresa
 * Version: 1.0.0
 * Author: Thales Violakis
 */

if (!defined('ABSPATH')) {
  die;
}
require_once plugin_dir_path(__FILE__) . '/inc/vortigo_eventos_widgets.php';
require_once plugin_dir_path(__FILE__) . '/inc/vortigo_eventos_settings.php';
require_once plugin_dir_path(__FILE__) . '/inc/vortigo_eventos_shortcode.php';
require_once plugin_dir_path(__FILE__) . '/inc/vortigo_eventos_scripts.php';
