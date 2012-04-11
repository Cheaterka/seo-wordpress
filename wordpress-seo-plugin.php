<?php
/**
 * @package SEO
 * @author Mervin Praison
 * @version 1.0
 */
/*
    Plugin Name: Wordpress SEO Plugin
    Plugin URI: http://mervin.info/seo/
    Description: Wordpress SEO by Mervin Praison
    Author: Mervin Praison
    Version: 1.0
    License: GPL
    Author URI: http://mervin.info/
    Last change: 11.04.2012
*/


define( 'SEO_URL', plugin_dir_url(__FILE__) );
define( 'SEO_PATH', plugin_dir_path(__FILE__) );
define( 'SEO_BASENAME', plugin_basename( __FILE__ ) );

global $post;

require_once ( 'seo-data-class.php');
require_once ( 'seo-metabox-class.php');
require_once ( 'seo-functions.php');






/* shortcode test */

function shortfunc(){
	
$post_type = get_post_type(get_the_ID());
$seo_data_class = new seo_data_class();
	if($post_type=='page' || $post_type =='post'){
		add_action( 'admin_init', $seo_data_class->zeo_add_post_meta() );
	}

$seo_data_class->zeo_add_post_meta();
return $seo_data_class->zeo_get_post_meta();
}

add_shortcode( 'bartag', 'shortfunc' );

?>