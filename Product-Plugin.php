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

defined( 'ABSPATH' ) || exit;



// Add the custom CSS file and wordpress JQuery File in our Plugin
wp_enqueue_script( 'jquery' );

$path_style = plugins_url('css/style.css', __FILE__);
$ver_style = filemtime(plugin_dir_path(__FILE__).'css/style.css');
wp_enqueue_style('my-custom-style', $path_style, '' , $ver_style);
