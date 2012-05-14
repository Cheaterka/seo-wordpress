<div class="wrap">
<h1>XML Sitemap Settings</h1>
<?php

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

function checkbox($id, $label, $label_left = false, $option = '') {
			
				
			$output_label = '<label for="'.$id.'">'.$label.'</label>';
			$output_input = '<input class="checkbox" type="checkbox" id="'.$id.'" name="'.$option.'['.$id.']"'. checked($options[$id],'on',false).'/> ';
			
			if( $label_left ) {
				$output = $output_label . $output_input;
			} else {
				$output = $output_input . $output_label;
			}
			return $output . '<br class="clear" />';
		}

function xml_sitemaps_page() {
			

			$options = get_option('wpseo_xml');

			$base = $GLOBALS['wp_rewrite']->using_index_permalinks() ? 'index.php/' : '';

			$content = checkbox('enablexmlsitemap',__('Check this box to enable XML sitemap functionality.', 'wordpress-seo' ), false);
			$content .= '<div id="sitemapinfo">';

				$content .= '<p>'.sprintf(__('You can find your XML Sitemap here: %sXML Sitemap%s', 'wordpress-seo' ), '<a target="_blank" class="button-secondary" href="'.home_url($base.'sitemap_index.xml').'">', '</a>').'<br/><br/>'.__( 'You do <strong>not</strong> need to generate the XML sitemap, nor will it take up time to generate after publishing a post.', 'wordpress-seo' ).'</p>';

				$content .= '<p>'.__('Save your settings to activate XML Sitemaps.', 'wordpress-seo' ).'</p>';
			$content .= '<strong>'.__('General settings', 'wordpress-seo' ).'</strong><br/>';
			$content .= '<p>'.__('After content publication, the plugin automatically pings Google and Bing, do you need it to ping other search engines too? If so, check the box:', 'wordpress-seo' ).'</p>';
			$content .= checkbox('xml_ping_yahoo', __("Ping Yahoo!.", 'wordpress-seo' ), false);
			$content .= checkbox('xml_ping_ask', __("Ping Ask.com.", 'wordpress-seo' ), false);
			$content .= '<br/><strong>'.__('Exclude post types', 'wordpress-seo' ).'</strong><br/>';
			$content .= '<p>'.__('Please check the appropriate box below if there\'s a post type that you do <strong>NOT</strong> want to include in your sitemap:', 'wordpress-seo' ).'</p>';
			foreach (get_post_types() as $post_type) {
				if ( !in_array( $post_type, array('revision','nav_menu_item','attachment') ) ) {
					$pt = get_post_type_object($post_type);
					$content .= checkbox('post_types-'.$post_type.'-not_in_sitemap', $pt->labels->name);
				}
			}

			$content .= '<br/>';
			$content .= '<strong>'.__('Exclude taxonomies', 'wordpress-seo' ).'</strong><br/>';
			$content .= '<p>'.__('Please check the appropriate box below if there\'s a taxonomy that you do <strong>NOT</strong> want to include in your sitemap:', 'wordpress-seo' ).'</p>';
			foreach (get_taxonomies() as $taxonomy) {
				if ( !in_array( $taxonomy, array('nav_menu','link_category','post_format') ) ) {
					$tax = get_taxonomy($taxonomy);
					if ( isset( $tax->labels->name ) && trim($tax->labels->name) != '' )
						$content .= checkbox('taxonomies-'.$taxonomy.'-not_in_sitemap', $tax->labels->name);
				}
			}
			
			$content .= '<br class="clear"/>';
			$content .= '</div>';

			postbox('xmlsitemaps',__('XML Sitemap', 'wordpress-seo'),$content);
			
			do_action('wpseo_xmlsitemaps_config', xml_sitemaps_page());		
			

		}

?>
</div>