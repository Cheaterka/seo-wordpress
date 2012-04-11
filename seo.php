<?php
/**
 * @package SEO
 * @author Mervin Praison
 * @version 1.0
 */
/*
    Plugin Name: SEO
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

function finalfunc(){
$post_type = get_post_type( $id );
$seoclass = new seoclass();
	if($post_type=='page' || $post_type =='post'){
		add_action( 'admin_init', $seoclass->zeo_add_post_meta() );
	}

$seoclass->zeo_add_post_meta();
return $seoclass->zeo_get_post_meta();
}

add_shortcode( 'bartag', 'finalfunc' );

?>