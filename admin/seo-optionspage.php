

<div class="wrap">
<h1>Wordpress SEO Plugin Settings</h1>
<?php if ( $_POST['update_zeooptions'] == 'true' ) { zeooptions_update(); }  

function zeooptions_update(){
	
	update_option('zeo_common_home_title', $_POST['zeo_common_home_title']); 
	update_option('zeo_common_frontpage_title', $_POST['zeo_common_frontpage_title']); 
	update_option('zeo_common_page_title', $_POST['zeo_common_page_title']); 
	update_option('zeo_common_post_title', $_POST['zeo_common_post_title']); 
	update_option('zeo_common_category_title', $_POST['zeo_common_category_title']); 
	update_option('zeo_common_archive_title', $_POST['zeo_common_archive_title']); 
	update_option('zeo_common_tag_title', $_POST['zeo_common_tag_title']); 
	update_option('zeo_common_search_title', $_POST['zeo_common_search_title']); 
	update_option('zeo_common_error_title', $_POST['zeo_common_error_title']); 
	
	
	echo '<div class="updated">
		<p>
			<strong>Options saved</strong>
		</p>
	</div>'; 
	
}
?>

<br />
<form method="POST" action="">  
            <input type="hidden" name="update_zeooptions" value="true" />  
            <table cellpadding="2">
	            <tr style="background-color:#CCC;"><td>
				<b>Titles</b> </td><td><b>Title Prefix</b>
				</td><td>
            	<b>Title Suffix</b>
            	</td></tr>
                <tr><td>
				Home Page Title: </td><td>
				</td><td>
            	<input size="50" type="text" value="<?php echo get_option('zeo_common_home_title'); ?>" name="zeo_common_home_title"  />  
            	</td></tr>
                <tr><td>
				Blog Page Title: </td><td> Blog Page Title
				</td><td>
            	<input size="50" type="text" value="<?php echo get_option('zeo_common_frontpage_title'); ?>" name="zeo_common_frontpage_title"  />  
            	</td></tr>
				<tr><td>
				Page Title: </td><td> Individual Page Title
				</td><td>
            	<input size="50" type="text" value="<?php echo get_option('zeo_common_page_title'); ?>" name="zeo_common_page_title"  />  
            	</td></tr>
                <tr><td>
				Post Title: </td><td> Individual Post Title
				</td><td>
            	<input size="50" type="text" value="<?php echo get_option('zeo_common_post_title'); ?>" name="zeo_common_post_title"  />  
            	</td></tr>
                <tr><td>
				Category Title: </td><td> Individual Category Title
				</td><td>
            	<input size="50" type="text" value="<?php echo get_option('zeo_common_category_title'); ?>" name="zeo_common_category_title"  />  
            	</td></tr>                
                <tr><td>
				Archive Title: </td><td> Individual Archive Title
				</td><td>
            	<input size="50" type="text" value="<?php echo get_option('zeo_common_archive_title'); ?>" name="zeo_common_archive_title"  />  
            	</td></tr>
                
                <tr><td>
				Tag Title: </td><td> Individual Tag Title
				</td><td>
            	<input size="50" type="text" value="<?php echo get_option('zeo_common_tag_title'); ?>" name="zeo_common_tag_title"  />  
            	</td></tr>
                <tr><td>
				Search Title: </td><td> Individual Search Title
				</td><td>
            	<input size="50" type="text" value="<?php echo get_option('zeo_common_search_title'); ?>" name="zeo_common_search_title"  />  
            	</td></tr>
                <tr><td>
				404 Page Title: </td><td> Individual 404 Page Title
				</td><td>
            	<input size="50" type="text" value="<?php echo get_option('zeo_common_error_title'); ?>" name="zeo_common_error_title"  />  
            	</td></tr>

                
                
                
			</table>
            <p><input type="submit" name="search" value="Update Options" class="button" /></p>  
        </form> 
        
  <?php if ( $_POST['update_analyticsoptions'] == 'true' ) { analyticsoptions_update(); }  

function analyticsoptions_update(){
	
	
	update_option('zeo_analytics_id', $_POST['zeo_analytics_id']); 
	
	echo '<div class="updated">
		<p>
			<strong>Options saved</strong>
		</p>
	</div>'; 
	
}
?>      
        <br />
        <h1>Google Analytics Settings</h1>
        <form method="POST" action="">  
        <input type="hidden" name="update_analyticsoptions" value="true" />
        <table cellpadding="2">
        <tr style="background-color:#CCC;">
        <td width="230"><b>Analytics</b></td>
        <td><b>ID</b></td>
        </tr>
        <tr>
        <td>Please Enter your Tracking ID</td>
        <td><input size="48" type="text" value="<?php echo get_option('zeo_analytics_id'); ?>" name="zeo_analytics_id"  /></td>
        </tr>
        
        
        </table>
            <p><input type="submit" name="search" value="Update Options" class="button" /></p>  
        </form> 
<br />
<h1>Google Authorship Settings</h1>
<table cellpadding="2">
        <tr style="background-color:#CCC;"><td width="230"><b>Function</b></td><td width="300"><b>Setup</b></td></tr>
		<tr>
        <td>Authorship Setup Location</td>
        <td>Users -> Your Profile -> (Bottom)</td>
        </tr>
</table>


</div>