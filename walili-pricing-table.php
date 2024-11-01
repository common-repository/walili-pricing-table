<?php
/**
 * Plugin Name: Walili Pricing Table
 * Plugin URI: https://www.simplefbautoposter.com/?page_id=31
 * Description: This plugin adds a “Pricing Table” tab in the elementor panel which allows you to create pricing tables for your website in the easy way.
 * Version: 2.0.0
 * Author: Donate, Please buy me a coffee
 * Author URI: http://paypal.me/bibali1980
 * License: GPL2
 */

namespace Walili;

defined( 'ABSPATH' ) || exit;

class Widget_Loader{

  private static $_instance = null;

  public static function instance()
  {
    if (is_null(self::$_instance)) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }


  private function include_widgets_files(){
    require_once __DIR__ . '/controls/pricing-table/walili_pricing_table.php';
    wp_register_style( 'walili-pricing-table-stylesheet', plugins_url('controls/pricing-table/walili_pricing_table.css', __FILE__ ) );
  }

  public function register_widgets(){

    $this->include_widgets_files();

    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\walili_pricing_table());

  }

  function add_elementor_widget_categories( $elements_manager ) {
   $elements_manager->add_category(
     'walili',
     [
       'title' => __( 'Walili pricing table', 'walili' ),
       'icon' => 'fa fa-plug',
     ]
   );
  }

  public function __construct(){
    add_action('elementor/elements/categories_registered', [$this, 'add_elementor_widget_categories'], 99);
    add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets'], 99);
  }
}

// Instantiate Plugin Class
Widget_Loader::instance();
