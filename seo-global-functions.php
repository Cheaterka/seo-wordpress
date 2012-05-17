<?php

function zeo_ischecked_global($chkname,$value)
    {
                  
                if(get_option($chkname) == $value)
                {
                    return true;
                } 
        	return false;
	}
	

/* Admin Menu */

add_action( 'admin_menu', 'zeo_options_menu' );
function zeo_options_menu(){
	
	 // add_options_page('Wordpress SEO Plugin' , 'Wordpress SEO', 9,  SEO_ADMIN_DIRECTORY.'/seo-dashboard.php');
	add_menu_page( 'Wordpress SEO','Wordpress SEO',	0, SEO_ADMIN_DIRECTORY.'/seo-dashboard.php', '', plugins_url('/images/icon.png', __FILE__));
	add_submenu_page( SEO_ADMIN_DIRECTORY.'/seo-dashboard.php', 'Dashboard ', 'Dashboard', 0,SEO_ADMIN_DIRECTORY.'/seo-dashboard.php' );
	add_submenu_page( SEO_ADMIN_DIRECTORY.'/seo-dashboard.php', 'Authorship, Analytics', 'Authorship, Analytics', 9, SEO_ADMIN_DIRECTORY.'/seo-authorship.php' );
	add_submenu_page( SEO_ADMIN_DIRECTORY.'/seo-dashboard.php', 'XMLsitemap', 'XMLsitemap', 9, SEO_ADMIN_DIRECTORY.'/seo-xml-sitemap.php' );
	// add_submenu_page( SEO_ADMIN_DIRECTORY.'/seo-dashboard.php', 'Import', 'Import', 9, SEO_ADMIN_DIRECTORY.'/seo-import-export.php' );
	
}
 add_action( 'admin_head', 'zeo_admin_header' );

/* Get option value function */

function zeo_get_value( $val, $postid = '' ) {
	if ( empty($postid) ) {
		global $post;
		if (isset($post))
			$postid = $post->ID;
		else 
			return false;
	}
	$custom = get_post_custom($postid);
	if (!empty($custom['_mervin_seo_'.$val][0]))
		return maybe_unserialize( $custom['_mervin_seo_'.$val][0] );
	else
		return false;
}

function get_zeo_options_arr() {
	$optarr = array('zeo','zeo_indexation', 'zeo_permalinks', 'zeo_titles', 'zeo_rss', 'zeo_internallinks', 'mervin_sitemap', 'zeo_social');
	return apply_filters( 'mervin_options', $optarr );
}


function get_mervin_options() {
	$options = array();
	foreach( get_zeo_options_arr() as $opt ) {
		$options = array_merge( $options, (array) get_option($opt) );
	}
	return $options;
}

function zeo_get_terms($id, $taxonomy) {
	// If we're on a specific tag, category or taxonomy page, return that and bail.
	if ( is_category() || is_tag() || is_tax() ) {
		global $wp_query;
		$term = $wp_query->get_queried_object();
		return $term->name;
	}
	
	$output = '';
	$terms = get_the_terms($id, $taxonomy);
	if ( $terms ) {
		foreach ($terms as $term) {
			$output .= $term->name.', ';
		}
		return rtrim( trim($output), ',' );
	}
	return '';
}

function zeo_get_term_meta( $term, $taxonomy, $meta ) {
	if ( is_string( $term ) ) 
		$term = get_term_by('slug', $term, $taxonomy);

	if ( is_object( $term ) )
		$term = $term->term_id;
	
	$tax_meta = get_option( 'zeo_taxonomy_meta' );
	if ( isset($tax_meta[$taxonomy][$term]) )
		$tax_meta = $tax_meta[$taxonomy][$term];
	else
		return false;
	
	return (isset($tax_meta['zeo_'.$meta])) ? $tax_meta['zeo_'.$meta] : false;
}


function admin_header($title, $expl = true, $form = true, $option = 'yoast_zeo_options', $optionshort = 'zeo', $contains_files = false) {
			?>
			<div class="wrap">
				<?php 
				if ( (isset($_GET['updated']) && $_GET['updated'] == 'true') || (isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true') ) {
					$msg = __('Settings updated', 'wordpress-seo' );

					if ( function_exists('w3tc_pgcache_flush') ) {
						w3tc_pgcache_flush();
						$msg .= __(' &amp; W3 Total Cache Page Cache flushed', 'wordpress-seo' );
					} else if (function_exists('wp_cache_clear_cache() ')) {
						wp_cache_clear_cache();
						$msg .= __(' &amp; WP Super Cache flushed', 'wordpress-seo' );
					}

					// flush rewrite rules if XML sitemap settings have been updated.
					if ( isset($_GET['page']) && 'zeo_xml' == $_GET['page'] )
						flush_rewrite_rules();

					echo '<div id="message" style="width:94%;" class="message updated"><p><strong>'.$msg.'.</strong></p></div>';
				}  
				?>
				<a href="http://yoast.com/"><div id="yoast-icon" style="background: url(<?php echo ZEO_URL; ?>images/wordpress-SEO-32x32.png) no-repeat;" class="icon32"><br /></div></a>
				<h2 id="zeo-title"><?php _e("Yoast WordPress SEO: ", 'wordpress-seo' ); echo $title; ?></h2>
				<div id="zeo_content_top" class="postbox-container" style="width:70%;">
					<div class="metabox-holder">	
						<div class="meta-box-sortables">
			<?php
			if ($form) {
				echo '<form action="'.admin_url('options.php').'" method="post" id="zeo-conf"' . ($contains_files ? ' enctype="multipart/form-data"' : '') . '>';
				settings_fields($option); 
				$this->currentoption = $optionshort;
				// Set some of the ignore booleans here to prevent unsetting.
				echo $this->hidden('ignore_blog_public_warning');
				echo $this->hidden('ignore_tour');
				echo $this->hidden('ignore_page_comments');
				echo $this->hidden('ignore_permalink');
				echo $this->hidden('ms_defaults_set');
			}
			if ($expl)
				$this->postbox('pluginsettings',__('Plugin Settings', 'wordpress-seo'),$this->checkbox('disableexplanation',__('Hide verbose explanations of settings', 'wordpress-seo'))); 
			
		}
		
		function admin_footer($title, $submit = true) {
			if ($submit) {
			?>
							<div class="submit"><input type="submit" class="button-primary" name="submit" value="<?php _e("Save Settings", 'wordpress-seo'); ?>" /></div>
			<?php } ?>
							</form>
						</div>
					</div>
				</div>
				<?php $this->admin_sidebar(); ?>
			</div>				
			<?php
		}

function postbox($id, $title, $content) {
		?>
			<div id="<?php echo $id; ?>" class="postbox">
				<div class="handlediv" title="Click to toggle"><br /></div>
				<h3 class="hndle"><span><?php echo $title; ?></span></h3>
				<div class="inside">
					<?php echo $content; ?>
				</div>
			</div>
		<?php

}
// register_setting( 'zeo_internallinks_options', 'zeo_internallinks' );

function internallinks_page() {
			$this->admin_header(__('Internal Links'), false, true, 'yoast_zeo_internallinks_options', 'zeo_internallinks');

			$content = $this->checkbox('breadcrumbs-enable',__('Enable Breadcrumbs', 'wordpress-seo' ));
			$content .= '<br/>';
			$content .= $this->textinput('breadcrumbs-sep',__('Separator between breadcrumbs', 'wordpress-seo' ));
			$content .= $this->textinput('breadcrumbs-home',__('Anchor text for the Homepage', 'wordpress-seo' ));
			$content .= $this->textinput('breadcrumbs-prefix',__('Prefix for the breadcrumb path', 'wordpress-seo' ));
			$content .= $this->textinput('breadcrumbs-archiveprefix',__('Prefix for Archive breadcrumbs', 'wordpress-seo' ));
			$content .= $this->textinput('breadcrumbs-searchprefix',__('Prefix for Search Page breadcrumbs', 'wordpress-seo' ));
			$content .= $this->textinput('breadcrumbs-404crumb',__('Breadcrumb for 404 Page', 'wordpress-seo' ));
			$content .= $this->checkbox('breadcrumbs-blog-remove',__('Remove Blog page from Breadcrumbs', 'wordpress-seo' ));
			$content .= '<br/><br/>';
			$content .= '<strong>'.__('Taxonomy to show in breadcrumbs for:', 'wordpress-seo' ).'</strong><br/>';
			foreach (get_post_types() as $pt) {
				if (in_array($pt, array('revision', 'attachment', 'nav_menu_item')))
					continue;

				$taxonomies = get_object_taxonomies($pt);
				if (count($taxonomies) > 0) {
					$values = array(0 => __('None','wordpress-seo') );
					foreach (get_object_taxonomies($pt) as $tax) {
						$taxobj = get_taxonomy($tax);
						$values[$tax] = $taxobj->labels->singular_name;
					}
					$ptobj = get_post_type_object($pt);
					$content .= $this->select('post_types-'.$pt.'-maintax', $ptobj->labels->name, $values);					
				}
			}
			$content .= '<br/>';
			
			$content .= '<strong>'.__('Post type archive to show in breadcrumbs for:', 'wordpress-seo' ).'</strong><br/>';
			foreach (get_taxonomies(array('public'=>true)) as $taxonomy) {
				if ( !in_array( $taxonomy, array('nav_menu','link_category','post_format', 'category', 'post_tag') ) ) {
					$tax = get_taxonomy($taxonomy);
					$values = array( '' => __( 'None', 'wordpress-seo' ) );
					if ( get_option('show_on_front') == 'page' )
						$values['post'] = __( 'Blog', 'wordpress-seo' );
					
					foreach (get_post_types( array('public' =>true) ) as $pt) {
						if (in_array($pt, array('revision', 'attachment', 'nav_menu_item')))
							continue;
						$ptobj = get_post_type_object($pt);
						if ($ptobj->has_archive)
							$values[$pt] = $ptobj->labels->name;
					}
					$content .= $this->select('taxonomy-'.$taxonomy.'-ptparent', $tax->labels->singular_name, $values);					
				}
			}
			
			$content .= $this->checkbox('breadcrumbs-boldlast',__('Bold the last page in the breadcrumb', 'wordpress-seo' ));
			$content .= $this->checkbox('breadcrumbs-trytheme',__('Try to add automatically', 'wordpress-seo' ));
			$content .= '<p class="desc">'.__('If you\'re using Hybrid, Thesis or Thematic, check this box for some lovely simple action', 'wordpress-seo' ).'.</p>';

			$content .= '<br class="clear"/>';
			$content .= '<h4>'.__('How to insert breadcrumbs in your theme', 'wordpress-seo' ).'</h4>';
			$content .= '<p>'.__('Usage of this breadcrumbs feature is explained <a href="http://yoast.com/wordpress/breadcrumbs/">here</a>. For the more code savvy, insert this in your theme:', 'wordpress-seo' ).'</p>';
			$content .= '<pre>&lt;?php if ( function_exists(&#x27;yoast_breadcrumb&#x27;) ) {
	yoast_breadcrumb(&#x27;&lt;p id=&quot;breadcrumbs&quot;&gt;&#x27;,&#x27;&lt;/p&gt;&#x27;);
} ?&gt;</pre>';
			$this->postbox('internallinks',__('Breadcrumbs Settings', 'wordpress-seo'),$content); 
			
			$this->admin_footer('Internal Links');
		}

function xml_sitemaps_page() {
			$this->admin_header('XML Sitemaps', false, true, 'yoast_zeo_xml_sitemap_options', 'zeo_xml');

			$options = get_option('zeo_xml');

			$base = $GLOBALS['wp_rewrite']->using_index_permalinks() ? 'index.php/' : '';

			$content = $this->checkbox('enablexmlsitemap',__('Check this box to enable XML sitemap functionality.', 'wordpress-seo' ), false);
			$content .= '<div id="sitemapinfo">';
			if ( $options['enablexmlsitemap'] )
				$content .= '<p>'.sprintf(__('You can find your XML Sitemap here: %sXML Sitemap%s', 'wordpress-seo' ), '<a target="_blank" class="button-secondary" href="'.home_url($base.'sitemap_index.xml').'">', '</a>').'<br/><br/>'.__( 'You do <strong>not</strong> need to generate the XML sitemap, nor will it take up time to generate after publishing a post.', 'wordpress-seo' ).'</p>';
			else
				$content .= '<p>'.__('Save your settings to activate XML Sitemaps.', 'wordpress-seo' ).'</p>';
			$content .= '<strong>'.__('General settings', 'wordpress-seo' ).'</strong><br/>';
			$content .= '<p>'.__('After content publication, the plugin automatically pings Google and Bing, do you need it to ping other search engines too? If so, check the box:', 'wordpress-seo' ).'</p>';
			$content .= $this->checkbox('xml_ping_yahoo', __("Ping Yahoo!.", 'wordpress-seo' ), false);
			$content .= $this->checkbox('xml_ping_ask', __("Ping Ask.com.", 'wordpress-seo' ), false);
			$content .= '<br/><strong>'.__('Exclude post types', 'wordpress-seo' ).'</strong><br/>';
			$content .= '<p>'.__('Please check the appropriate box below if there\'s a post type that you do <strong>NOT</strong> want to include in your sitemap:', 'wordpress-seo' ).'</p>';
			foreach (get_post_types() as $post_type) {
				if ( !in_array( $post_type, array('revision','nav_menu_item','attachment') ) ) {
					$pt = get_post_type_object($post_type);
					$content .= $this->checkbox('post_types-'.$post_type.'-not_in_sitemap', $pt->labels->name);
				}
			}

			$content .= '<br/>';
			$content .= '<strong>'.__('Exclude taxonomies', 'wordpress-seo' ).'</strong><br/>';
			$content .= '<p>'.__('Please check the appropriate box below if there\'s a taxonomy that you do <strong>NOT</strong> want to include in your sitemap:', 'wordpress-seo' ).'</p>';
			foreach (get_taxonomies() as $taxonomy) {
				if ( !in_array( $taxonomy, array('nav_menu','link_category','post_format') ) ) {
					$tax = get_taxonomy($taxonomy);
					if ( isset( $tax->labels->name ) && trim($tax->labels->name) != '' )
						$content .= $this->checkbox('taxonomies-'.$taxonomy.'-not_in_sitemap', $tax->labels->name);
				}
			}
			
			$content .= '<br class="clear"/>';
			$content .= '</div>';

			$this->postbox('xmlsitemaps',__('XML Sitemap', 'wordpress-seo'),$content);
			
			do_action('zeo_xmlsitemaps_config', $this);		
			
			$this->admin_footer('XML Sitemaps');
		}


/* Google Plus Icon Script */
function zeo_admin_header(){
  echo '<script type="text/javascript">
window.___gcfg = {lang: "en"};
(function() 
{var po = document.createElement("script");
po.type = "text/javascript"; po.async = true;po.src = "https://apis.google.com/js/plusone.js";
var s = document.getElementsByTagName("script")[0];
s.parentNode.insertBefore(po, s);
})();</script>';
}
?>