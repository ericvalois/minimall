<?php
/**
 * Lazy load module
 *
 * @package perfthemes
 * @since 1.0
 */
$perf_img_lazyload_active = perf_get_field("perf_img_lazyload_active","option");
$perf_iframe_lazyload_active = perf_get_field("perf_iframe_lazyload_active","option");

if ( $perf_img_lazyload_active && !is_admin() ) {

	add_filter( 'get_avatar'			, 'perf_lazy_load_image', PHP_INT_MAX );
	add_filter( 'the_content'			, 'perf_lazy_load_image', PHP_INT_MAX );
	add_filter( 'widget_text'			, 'perf_lazy_load_image', PHP_INT_MAX );
	add_filter( 'get_image_tag'			, 'perf_lazy_load_image', PHP_INT_MAX );
	add_filter( 'post_thumbnail_html'	, 'perf_lazy_load_image', PHP_INT_MAX );

}

if ( $perf_iframe_lazyload_active && !is_admin() ) {
	add_filter( 'the_content', 'perf_lazyload_iframes', PHP_INT_MAX );
	add_filter( 'widget_text', 'perf_lazyload_iframes', PHP_INT_MAX );
}


add_action( 'wp_enqueue_scripts', 'perf_lazysizes_script' );
function perf_lazysizes_script() {
	wp_enqueue_script( 'perf-lazysizes', plugins_url( '/vendors/lazysizes/lazysizes-all.min.js', __FILE__ ), '', '', true );
}

function perf_lazy_load_image( $content ){

	global $post;

	if( is_object( $post ) ){
        $perf_on_page_lazyload_disabled = perf_get_field('perf_on_page_lazyload_disabled', $post->ID);
    }else{
        $perf_on_page_lazyload_disabled = false;
    }



	if( !is_search() && !$perf_on_page_lazyload_disabled ){
		$perf_content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
	    $perf_document = new DOMDocument();

	    libxml_use_internal_errors(true);
	    if( !empty($perf_content) ){
	    	$perf_document->loadHTML(utf8_decode($perf_content));
	    }else{
	    	return;
	    }


	    $imgs = $perf_document->getElementsByTagName('img');
	    foreach ($imgs as $img) {

	    	// add data-sizes
	    	$img->setAttribute('data-size', "auto");

	    	// remove sizes
	    	$img->removeAttribute('sizes');

	    	// src
	    	if($img->hasAttribute('src')){
	    		$existing_src = $img->getAttribute('src');
	    		$img->setAttribute('src', "data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=");

				$img->setAttribute('data-src', $existing_src);
            }
            
            // Aspect ratio for better smoohtness
	    	if( $img->hasAttribute('width') && $img->hasAttribute('height')){
                $width = $img->getAttribute('width');
                $height = $img->getAttribute('height');
                $aspectratio = $width . '/' . $height;
                $img->setAttribute('data-aspectratio', $aspectratio);
	        }

	    	// srcset
	    	if($img->hasAttribute('srcset')){
	    		$existing_srcset = $img->getAttribute('srcset');
	    		$img->removeAttribute('srcset');
	    		$img->setAttribute('data-srcset', "$existing_srcset");
	        }

	    	// Class
	       	$existing_class = $img->getAttribute('class');
			$img->setAttribute('class', "lazyload $existing_class");


			// noscript
			$noscript = $perf_document->createElement('noscript');
			$img->parentNode->insertBefore($noscript);

			$image = $perf_document->createElement('image');
			$imageAttribute = $perf_document->createAttribute('src');
			$imageAttribute->value = $existing_src;
			$image->appendChild($imageAttribute);

			$noscript->appendChild($image);

	    }

	    $html_fragment = preg_replace('/^<!DOCTYPE.+?>/', '', str_replace( array('<html>', '</html>', '<body>', '</body>'), array('', '', '', ''), $perf_document->saveHTML()));
	    return $html_fragment;
	}else{
		return $content;
	}
}

/**
 * Replace iframes by LazyLoad
 */
function perf_lazyload_iframes( $html ) {

	global $post;

	if( is_object( $post ) ){
        $perf_on_page_lazyload_disabled = perf_get_field('perf_on_page_lazyload_disabled', $post->ID);
    }else{
        $perf_on_page_lazyload_disabled = false;
    }

	if( !is_search() && !$perf_on_page_lazyload_disabled ){

		$perf_matches = array();
		preg_match_all( '/<iframe\s+.*?>/', $html, $perf_matches );

		foreach ( $perf_matches[0] as $k=>$perf_iframe ) {

			// Don't mess with the Gravity Forms ajax iframe
			if ( strpos( $perf_iframe, 'gform_ajax_frame' ) ) {
				continue;
			}

			$perf_placeholder = 'data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=';

			$perf_iframe = preg_replace( '/<iframe(.*?)src=/is', '<iframe$1src="' . $perf_placeholder . '" class="lazyload blur-up" data-src=', $perf_iframe );

			$html = str_replace( $perf_matches[0][ $k ], $perf_iframe, $html );

		}
	}

	return $html;
}

add_action("wp_head","perf_img_picturefill");
function perf_img_picturefill(){
?>
<script>
    // Lazyload picturefill
    function perf_loadJS(u){var r=document.getElementsByTagName("script")[ 0 ],s=document.createElement("script");s.src=u;r.parentNode.insertBefore(s,r);}
    if (!window.HTMLPictureElement || document.msElementsFromPoint) {
        perf_loadJS('<?php echo plugins_url( "/vendors/lazysizes/plugins/respimg/ls.respimg.min.js" , __FILE__ ); ?>');
    }
</script>
<?php
}

/*
By enabling this option, you will improve the loading time of your website.
By enabling this option, you will improve the loading time of your website.
Warning!
In the case of any display errors, we recommend disabling those options.
The Lazy Load module defers loading of images and iframes until they become visible in the client’s viewport. This avoids blocking the download of other critical resources necessary for rendering the above the fold section of the page.
*/