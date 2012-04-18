<div class="wrap">
<h1>Google Authorship And Analytics Settings</h1>
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



?>
<?php if ( $_POST['update_authorshipoptions'] == 'true' ) { authorshipoptions_update(); }  

function authorshipoptions_update(){
	global $current_user;
	if ( !current_user_can( 'edit_user', $current_user->ID ) )
		return false;

	update_usermeta( $current_user->ID, 'zeoauthor', $_POST['zeoauthor'] );
	update_usermeta( $current_user->ID, 'zeopreferredname', $_POST['zeopreferredname'] );
	
	echo '<div class="updated">
		<p>
			<strong>Options saved</strong>
		</p>
	</div>'; 
	
}
?>
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
<!--
<h3>Want more Plugins? Encourage me by,<br />
LIKING ME and ADDING ME to your circles</h3>
-->
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
<h1>Google Authorship Settings</h1>
<form method="POST" action="">  
        <input type="hidden" name="update_authorshipoptions" value="true" />
<table cellpadding="2">
        <tr style="background-color:#CCC;"><td width="212"><b>Function</b></td><td width="310"><b>Setup</b></td></tr>
		

<?php
global $current_user;
	get_currentuserinfo();
    ?>
    


		<tr>
			<th align="left" style="font-weight:normal"><label for="mpgpauthor">Google Plus Profile URL (Required)</label></th>

			<td>
				<input size="54" type="text" name="zeoauthor" id="mpgpauthor" value="<?php echo esc_attr( get_the_author_meta( 'zeoauthor', $current_user->ID ) ); ?>" class="regular-text" />
                <!--<br />
				<span class="description">Please enter your Google Plus Profile URL. (with "https://plus.google.com/1234567890987654321")</span>
                -->
			</td>
		</tr>
		<tr>

			<th align="left" style="font-weight:normal"><label for="preferredname">Preferred Name</label></th>
			<td>
				<input size="54" type="text" name="zeopreferredname" id="preferredname" value="<?php echo esc_attr( get_the_author_meta( 'zeopreferredname', $current_user->ID ) ); ?>" class="regular-text" />
                <!--
                <br />
				<span class="description">Enter Your Preferred Name</span>
                -->
			</td>
		</tr>

	</table>
     <p><input type="submit" name="search" value="Update Options" class="button" /></p>  
</form>
<br />
<h1>Google Analytics Settings</h1>
        <form method="POST" action="">  
        <input type="hidden" name="update_analyticsoptions" value="true" />
        <table cellpadding="2">
        <tr style="background-color:#CCC;">
        <td width="210"><b>Analytics</b></td>
        <td width="310"><b>ID</b></td>
        </tr>
        <tr>
        <td>Please Enter your Tracking ID</td>
        <td><input size="51" type="text" value="<?php echo get_option('zeo_analytics_id'); ?>" name="zeo_analytics_id"  /></td>
        </tr>
        
        
        </table>
            <p><input type="submit" name="search" value="Update Options" class="button" /></p>  
        </form> 




</div>