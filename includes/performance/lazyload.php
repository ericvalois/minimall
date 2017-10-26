<?php
/**
 * Lazy load module
 *
 * @package perfthemes
 * @since 1.0
 */
$page_options = minimal_page_options();
$perf_options = minimal_perf_options();

if ( isset( $perf_options['active_img_lazy'] ) && $perf_options['active_img_lazy'] == 1 && !is_admin() ) {

	add_filter( 'get_avatar'			, 'minimal_lazy_load_image', PHP_INT_MAX );
	add_filter( 'the_content'			, 'minimal_lazy_load_image', PHP_INT_MAX );
	add_filter( 'widget_text'			, 'minimal_lazy_load_image', PHP_INT_MAX );
	add_filter( 'get_image_tag'			, 'minimal_lazy_load_image', PHP_INT_MAX );
	add_filter( 'post_thumbnail_html'	, 'minimal_lazy_load_image', PHP_INT_MAX );

}

if ( isset( $perf_options['active_iframe_lazy'] ) && $perf_options['active_iframe_lazy'] == 1 && !is_admin() ) {
	add_filter( 'the_content', 'minimal_lazyload_iframes', PHP_INT_MAX );
	add_filter( 'widget_text', 'minimal_lazyload_iframes', PHP_INT_MAX );
}

function minimal_lazy_load_image( $content ){

    $page_options = minimal_page_options();

	if( !is_search() && !$page_options['disable_lazyload'] ){
		$minimal_content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
	    $minimal_document = new DOMDocument();

	    libxml_use_internal_errors(true);
	    if( !empty($minimal_content) ){
	    	$minimal_document->loadHTML(utf8_decode($minimal_content));
	    }else{
	    	return;
	    }


	    $imgs = $minimal_document->getElementsByTagName('img');
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
			$noscript = $minimal_document->createElement('noscript');
			$img->parentNode->insertBefore($noscript);

			$image = $minimal_document->createElement('image');
			$imageAttribute = $minimal_document->createAttribute('src');
			$imageAttribute->value = $existing_src;
			$image->appendChild($imageAttribute);

			$noscript->appendChild($image);

	    }

	    $html_fragment = preg_replace('/^<!DOCTYPE.+?>/', '', str_replace( array('<html>', '</html>', '<body>', '</body>'), array('', '', '', ''), $minimal_document->saveHTML()));
	    return $html_fragment;
	}else{
		return $content;
	}
}  

/**
 * Replace iframes by LazyLoad
 */
function minimal_lazyload_iframes( $html ) {

	$page_options = minimal_page_options();

	if( !is_search() && !$page_options['disable_lazyload'] ){

		$minimal_matches = array();
		preg_match_all( '/<iframe\s+.*?>/', $html, $minimal_matches );

		foreach ( $minimal_matches[0] as $k=>$minimal_iframe ) {

			// Don't mess with the Gravity Forms ajax iframe
			if ( strpos( $minimal_iframe, 'gform_ajax_frame' ) ) {
				continue;
			}

			$minimal_placeholder = 'data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=';

			$minimal_iframe = preg_replace( '/<iframe(.*?)src=/is', '<iframe$1src="' . $minimal_placeholder . '" class="lazyload blur-up" data-src=', $minimal_iframe );

			$html = str_replace( $minimal_matches[0][ $k ], $minimal_iframe, $html );

		}
	}

	return $html;
}

add_action("wp_head","minimal_img_picturefill");
function minimal_img_picturefill(){
?>
<script>
    // Lazyload picturefill
    function minimal_loadJS(u){var r=document.getElementsByTagName("script")[ 0 ],s=document.createElement("script");s.src=u;r.parentNode.insertBefore(s,r);}
    if (!window.HTMLPictureElement || document.msElementsFromPoint) {
        minimal_loadJS('<?php echo plugins_url( "/vendors/lazysizes/plugins/respimg/ls.respimg.min.js" , __FILE__ ); ?>');
    }
</script>
<?php
}