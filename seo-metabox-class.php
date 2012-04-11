<?php

function call_seo_metabox_class() {

	return new seo_metabox_class();
	
}
if ( is_admin() ){
add_action( 'load-post.php', 'call_seo_metabox_class' );
}


class seo_metabox_class {
	



	public function __construct(){	
		
		add_action( 'add_meta_boxes', array( &$this, 'add_some_meta_box' ) );
		add_action( 'save_post', array( &$this, 'myplugin_save_postdata' ));
		
	}
		
	public function add_some_meta_box()
    {
        add_meta_box( 
             'some_meta_box_name'
            ,__( 'Some Meta Box Headline')
            ,array( &$this, 'render_meta_box_content' )
            ,'post' 
            ,'advanced'
            ,'high'
        );
		add_meta_box( 
             'some_meta_box_name'
            ,__( 'Some Meta Box Headline')
            ,array( &$this, 'render_meta_box_content' )
            ,'page' 
            ,'advanced'
            ,'high'
        );
    }

	public function render_meta_box_content($post) 
    {
		
		// Use nonce for verification
		wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename' );
		$uniqueid = 'zeo_metatitle';
		$seo_data_class = new seo_data_class();
		$titlevalue = $seo_data_class->zeo_get_post_meta($uniqueid);
		
        echo '<table>
		<tr>
		<td>Title</td>
		<td><input type="text" name="zeo_metatitle" value="';
		echo $titlevalue;
		
		echo '" ></input></td>
		
		</tr>
		
		
		</table>';
    }
	
	public function myplugin_save_postdata( $post_id ) {
		
 		 if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
   	   return;
	
 		 if ( !wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename( __FILE__ ) ) )
    	  return;
	  
 		 if ( 'page' == $_POST['post_type'] ) 
		  {
 		   if ( !current_user_can( 'edit_page', $post_id ) )
     	   return;
 		 }
	 	 else
 		 {
 		   if ( !current_user_can( 'edit_post', $post_id ) )
     	   return;
 		 }

 	 // OK, we're authenticated: we need to find and save the data

 	$mydata = $_POST['zeo_metatitle'];
	

 	 	
		$uniqueid = 'zeo_metatitle';
		$seo_data_class = new seo_data_class();
		$checkvalue = $seo_data_class->zeo_get_post_meta($uniqueid);
		if($mydata!=NULL){
		if(isset($checkvalue)){
			$seo_data_class->zeo_update_post_meta($uniqueid, $mydata);
		}
		else{
			$seo_data_class->zeo_add_post_meta($uniqueid, $mydata);	
			
		}
		}
		else{
		$seo_data_class->zeo_delete_post_meta($uniqueid, $mydata);	
		
		}
		
		
	}
	
	
	
	
	/* Substraction Function for testing process */
	
	public function sub($a,$b){
		
	return $a-$b;	
		
	}
	

	
	
}


?>