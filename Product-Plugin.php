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
         

         $path_style = plugins_url('css/bootstrap.css', __FILE__);
         $ver_style = filemtime(plugin_dir_path(__FILE__) . 'css/bootstrap.css');
         wp_enqueue_style('my-custom-bootstrap', $path_style, '', $ver_style);

         $path_style = plugins_url('css/slider.css', __FILE__);
         $ver_style = filemtime(plugin_dir_path(__FILE__) . 'css/slider.css');
         wp_enqueue_style('my-custom-slider', $path_style, '', $ver_style);

         $path_style = plugins_url('js/lightsider.js', __FILE__);
         $ver_style = filemtime(plugin_dir_path(__FILE__) . 'js/lightsider.js');
         wp_enqueue_script('my-custom-script', $path_style, '', $ver_style);


    //  On Activation Create the Product Page and custom Post type product(Code in Post-type.php)
         add_action( 'init', 'custom_product_post_type' );
         register_activation_hook(__FILE__, 'create_product_page');


    //  Add the meta box for Price (Code in meta-price.php)
          add_action('add_meta_boxes', 'custom_product_price_meta_box');
          add_action('save_post_product', 'custom_product_save_price');


   //  Product Short Code for Showing Products 6 in a row(Code in product-shortcode.php)
          add_shortcode('products_page', 'my_posts');

     
    // Add the meta gallery for every Product (Code in meta-gallery.php)
          add_action( 'admin_init', 'property_gallery_add_metabox' );
          add_action( 'admin_head-post.php', 'property_gallery_styles_scripts' );
          add_action( 'admin_head-post-new.php', 'property_gallery_styles_scripts' );
          add_action( 'save_post', 'property_gallery_save' );


    // Add the Product Description Custom meta field (Code in meta-description.php)
          add_action('add_meta_boxes', 'add_product_description_meta_box');
          add_action('save_post', 'save_product_description_meta_data');



    // override the single product page
          add_filter('single_template', array($this,'custom_single_post_template'));
}


private function require_files()
    {
      // Create the Custom Post Type (Product) 
          require_once __DIR__ . '/includes/post-type.php';

      // Create the Custom Meta Field Price
          require_once __DIR__ . '/includes/meta-price.php';

     // Show the all the Product  through shortcode
          require_once __DIR__ . '/includes/product-shortcode.php';

     // Create the Meta Gallery of Product 
          require_once __DIR__ . '/includes/meta-gallery.php';

     // Create the meta Description for Product
          require_once __DIR__ . '/includes/meta-description.php';

    }



    function custom_single_post_template($template) {
  if (is_single()) {
      $template = plugin_dir_path(__FILE__) . 'templates/single-product.php';
      
  }
  return $template;
}



}

$obj = new CustomPlugin();
