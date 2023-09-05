<?php
/*

* Plugin Name: Product Plugin

* Description:The Product Plugin is for Demo Purpose.

* Version: 1.0.0

* Author: Zehntech Technologies Pvt. Ltd.

* Author URI: https://www.zehntech.com/

* License: GPL2

* License URI: https://www.gnu.org/licenses/gpl-2.0.html

* Text Domain: smart-agreements


*/

defined('ABSPATH') || exit;


class CustomPlugin{

function __construct(){

          $this->require_files();
           
    // Add the custom CSS file and wordpress JQuery File in our Plugin
         wp_enqueue_script('jquery');

         $path_style = plugins_url('css/style.css', __FILE__);
         $ver_style = filemtime(plugin_dir_path(__FILE__) . 'css/style.css');
         wp_enqueue_style('my-custom-style', $path_style, '', $ver_style);


    //  On Activation Create the Product Page (Code in Post-type.php)
         add_action( 'init', 'custom_product_post_type' );
         register_activation_hook(__FILE__, 'create_product_page');



}


private function require_files()
    {
      // Create the Custom Post Type (Product) 
        require_once __DIR__ . '/includes/post-type.php';

    }


}

$obj = new CustomPlugin();
