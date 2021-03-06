<div class="wrap">
<h1>Wordpress SEO Plugin Settings</h1>
<br />
<?php 

function zeo_ischecked($chkname,$value)
    {
                  
                if(get_option($chkname) == $value)
                {
                    return true;
                } 
        	return false;
	}

if ( $_POST['update_zeooptions'] == 'true' ) { zeooptions_update(); }  

function zeooptions_update(){
	
	update_option('zeo_common_home_title', $_POST['zeo_common_home_title']);
	update_option('zeo_home_description', $_POST['zeo_home_description']);
	update_option('zeo_home_keywords', $_POST['zeo_home_keywords']); 
	update_option('zeo_common_frontpage_title', $_POST['zeo_common_frontpage_title']); 
	update_option('zeo_common_page_title', $_POST['zeo_common_page_title']); 
	update_option('zeo_common_post_title', $_POST['zeo_common_post_title']); 
	update_option('zeo_common_category_title', $_POST['zeo_common_category_title']); 
	update_option('zeo_common_archive_title', $_POST['zeo_common_archive_title']); 
	update_option('zeo_common_tag_title', $_POST['zeo_common_tag_title']); 
	update_option('zeo_common_search_title', $_POST['zeo_common_search_title']); 
	update_option('zeo_common_error_title', $_POST['zeo_common_error_title']);
	update_option('zeo_canonical_url', $_POST['zeo_canonical_url']);
	update_option('zeo_nofollow', $_POST['zeo_nofollow']);
	update_option('zeo_activate_title', $_POST['zeo_activate_title']);	
	
	echo '<div class="updated">
		<p>
			<strong>Options saved</strong>
		</p>
	</div>'; 
	
}

?>
 
<h3>Want more FREE Plugins? Encourage me by,<br />
LIKING ME and ADDING ME to your circles</h3>
<table>
<tr>
<td>
<iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fmervinpraisons&amp;width=250&amp;height=62&amp;colorscheme=light&amp;show_faces=false&amp;border_color&amp;stream=false&amp;header=true&amp;appId=252850214734670" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:250px; height:62px;" allowTransparency="true"></iframe>
</td>
<td>
<div class="g-plus" data-href="https://plus.google.com/101518602031253199279?rel=publisher" data-width="170" data-height="69" data-theme="light"></div>
</td>
</tr>
</table>
<form method="POST" action="">  
            <input type="hidden" name="update_zeooptions" value="true" />  
            <table cellpadding="2">
	            <h3>Home Page Settings</h3>
                <tr style="background-color:#CCC;">
        		<td width="210"><b>Home Page</b></td>
        		<td><b>Settings</b></td>
        		</tr>
                <tr><td>
				Home Page Title: 
				</td><td>
            	<input size="50" type="text" value="<?php echo get_option('zeo_common_home_title'); ?>" name="zeo_common_home_title"  />  
            	</td></tr>
                <tr><td>
				Home Page  Meta Description:
				</td><td>
            	<textarea size="50" rows="3" cols="52" name="zeo_home_description" ><?php echo get_option('zeo_home_description'); ?></textarea>  
            	</td></tr>
                <tr><td>
				Home Page  Meta Keywords:
				</td><td>
            	<input size="50" type="text" value="<?php echo get_option('zeo_home_keywords'); ?>" name="zeo_home_keywords"  />  
            	</td></tr></table><table>
                <h3>Other Page Title Settings</h3>
                <tr style="background-color:#CCC;"><td>
				<b>Titles</b> </td><td><b>Title Prefix</b>
				</td><td>
            	<b>Title Suffix</b>
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
                <table cellpadding="2">
                <h3>General Settings</h3>
                <tr style="background-color:#CCC;">
        		<td width="212"><b>Functions</b></td>
        		<td width="312"><b>Setup</b></td>
        		</tr>
                <tr><td>
				Activate Other Page title settings: 
				</td><td>
            	<input type="checkbox" name="zeo_activate_title" value="yes" <?php if(zeo_ischecked('zeo_activate_title', 'yes' )){echo "checked";}?>>  </input>
            	</td></tr>
                <tr><td>
				Canonical Link: 
				</td><td>
            	<input type="checkbox" name="zeo_canonical_url" value="yes" <?php if(zeo_ischecked('zeo_canonical_url', 'yes' )){echo "checked";}?>>  </input>
            	</td></tr>
                <tr><td>
				rel = NoFollow for Outbound Links: 
				</td><td>
            	<input type="checkbox" name="zeo_nofollow" value="yes" <?php if(zeo_ischecked('zeo_nofollow', 'yes' )){echo "checked";}?>>  </input>
            	</td></tr>
                
                
			</table>
            <p><input type="submit" name="search" value="Update Options" class="button" /></p>  
        </form>        
     
       

</div>