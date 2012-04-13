<?php
/**
 * @package SEO
 * @author Mervin Praison
 * @version 1.0
 */
/*
    Plugin Name: Wordpress SEO Plugin
    Plugin URI: http://mervin.info/wordpress-seo-plugin/
    Description: Wordpress SEO Plugin by Mervin Praison
    Author: Mervin Praison
    Version: 1.0
    License: GPL
    Author URI: http://mervin.info/
    Last change: 13.04.2012
*/


define( 'SEO_URL', plugin_dir_url(__FILE__) );
define( 'SEO_PATH', plugin_dir_path(__FILE__) );
define( 'SEO_BASENAME', plugin_basename( __FILE__ ) );
define( 'SEO_ADMIN_DIRECTORY', 'wordpress-seo-plugin/admin');

global $post;

require_once ( 'seo-data-class.php');
require_once ( 'seo-metabox-class.php');
require_once ( 'seo-metafunctions.php');
require_once ( 'seo-rewritetitle-class.php');
require_once ( 'seo-authorship.php');
require_once ( 'seo-authorship-badge.php');
require_once ( 'seo-authorship-icon.php');
// include (SEO_URL.'/wordpress-seo-plugin/authorship/seo-authorship.php');

register_activation_hook(__FILE__, 'zeo_activate');


$zeo = new seo_metabox_class();


add_action( 'wp_head', array( $zeo, 'zeo_head') );




?>