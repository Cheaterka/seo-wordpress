<?php


class seo_data_class {
	
	var $d=1;


	function _construct(){	
		
		
	}
	
		
	
	public function zeo_add_post_meta(){
	
		return add_post_meta(get_the_ID(), 'testingids', get_the_ID(), true);
			
	}
	public function zeo_update_post_meta(){
		
		return update_post_meta(get_the_ID(), 'testingid', get_the_ID());
	}
	public function zeo_delete_post_meta(){
		
		return delete_post_meta(get_the_ID(), 'testingid', get_the_ID());
		
	}
	
	public function zeo_get_post_meta(){		
		
		$meta_values = get_post_meta(get_the_ID(), 'testingids', true);
		return $meta_values;
	}
	
	
	/* Addition Function for testing process */
	
	public function add($a,$b){
		
	return $a+$b;	
		
	}
	
	
}


?>