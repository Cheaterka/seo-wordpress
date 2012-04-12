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
require_once ( 'seo-metafunctions.php');




$zeo = new seo_metabox_class();


add_action( 'wp_head', array( $zeo, 'zeo_head') );



/*
$seo_metabox_class = new seo_metabox_class();
if ( is_admin() ){
add_action( 'load-post.php', $seo_metabox_class->add_my_meta_box() );
}
*/


/* shortcode test */

function shortfunc(){
	
$post_type = get_post_type(get_the_ID());
$seo_data_class = new seo_data_class();
	if($post_type=='page' || $post_type =='post'){
		add_action( 'admin_init', $seo_data_class->zeo_add_post_meta() );
	}


$seo_metabox_class = new seo_metabox_class();
$uniqueid = 'zeo_metatitle';
$mydata='mydata';
//$seo_data_class->zeo_add_post_meta($uniqueid, $mydata);
//return $seo_data_class->zeo_get_post_meta($uniqueid);
return $seo_metabox_class->sub();
}

add_shortcode( 'bartag', 'shortfunc' );

?>