<?php


class zeo_rewrite_title {

	public function __construct(){
		
		
	}
	public function rewrite(&$content) {
    $title = false;

    $bloghome = get_settings('home');
    if (substr($bloghome, count($bloghome) - 1, 1) != '/') {
      $pattern = preg_quote($bloghome, '/');
      $content = preg_replace("/$pattern\"/", "$bloghome/\"", $content);
    }

    if (is_single()) {
      $title = trim(wp_title(false, false));
    } else if (is_archive()) {
      global $post, $posts;

      if (is_category()) {
        $title = trim(single_cat_title('', false));
      } else if (is_month()) {
        $title = get_the_time('F, Y');
      } else if (is_day()) {
        $title = get_the_time('F jS, Y');
      } else if (is_year()) {
        $title = get_the_time('Y');
      }
    } else if (is_search()) {
      $title = trim($_REQUEST[s]);
    }else if (is_page()) {
      $title ='test';
    }else if (is_home()) {
      $title = trim(wp_title(false, false));
    }else if (is_front_page()) {
      $title = trim(wp_title(false, false));
    }
    
    if ($title) {
      $blogname = get_settings('blogname');

      $content = preg_replace("/<title>.*<\/title>/", "<title>$title</title>", $content);
      $content = preg_replace("/>$blogname</", ">$title - $blogname<", $content);
    }
  }
  
  function wp_footer() {
    // Fetch the page (which is only missing some end tags)
    $content = ob_get_contents();

    // and erase the output buffer.
    ob_end_clean();

    // Actually rewrite the page.
    $this->rewrite($content);

    // Finally, echo the page so the browser can fetch it.
    echo($content);
  }
  
  function start() {
    ob_start();
  }

  


}

  	// Use object to avoid namespace collisions
	$zeo_rewrite_title = new zeo_rewrite_title();

	// We want to act when the page is 99% complete
	add_action('wp_footer', array(&$zeo_rewrite_title, 'wp_footer'));

	// There is no action hook for "start of processing",
	// so we use this implicitly.
	$zeo_rewrite_title->start();


?>