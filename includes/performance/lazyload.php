<?php
/**
 * Lazy load module
 *
 * @package perfthemes
 * @since 1.0
 */
$page_options = minimall_page_options();
$perf_options = minimall_perf_options();

if ( isset( $perf_options['active_img_lazy'] ) && $perf_options['active_img_lazy'] == 1 && !is_admin() ) {

	add_filter( 'get_avatar'			, 'minimall_lazy_load_image', PHP_INT_MAX );
	add_filter( 'the_content'			, 'minimall_lazy_load_image', PHP_INT_MAX );
	add_filter( 'widget_text'			, 'minimall_lazy_load_image', PHP_INT_MAX );
	add_filter( 'get_image_tag'			, 'minimall_lazy_load_image', PHP_INT_MAX );
	add_filter( 'post_thumbnail_html'	, 'minimall_lazy_load_image', PHP_INT_MAX );

}

if ( isset( $perf_options['active_iframe_lazy'] ) && $perf_options['active_iframe_lazy'] == 1 && !is_admin() ) {
	add_filter( 'the_content', 'minimall_lazyload_iframes', PHP_INT_MAX );
	add_filter( 'widget_text', 'minimall_lazyload_iframes', PHP_INT_MAX );
}

function minimall_lazy_load_image( $content ){

    $page_options = minimall_page_options();

	if( !is_search() && !$page_options['disable_lazyload'] ){
		$minimall_content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
	    $minimall_document = new DOMDocument();

	    libxml_use_internal_errors(true);
	    if( !empty($minimall_content) ){
	    	$minimall_document->loadHTML(utf8_decode($minimall_content));
	    }else{
	    	return;
	    }


	    $imgs = $minimall_document->getElementsByTagName('img');
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
			$noscript = $minimall_document->createElement('noscript');
			$img->parentNode->insertBefore($noscript);

			$image = $minimall_document->createElement('image');
			$imageAttribute = $minimall_document->createAttribute('src');
			$imageAttribute->value = $existing_src;
			$image->appendChild($imageAttribute);

			$noscript->appendChild($image);

	    }

	    $html_fragment = preg_replace('/^<!DOCTYPE.+?>/', '', str_replace( array('<html>', '</html>', '<body>', '</body>'), array('', '', '', ''), $minimall_document->saveHTML()));
	    return $html_fragment;
	}else{
		return $content;
	}
}  

/**
 * Replace iframes by LazyLoad
 */
function minimall_lazyload_iframes( $html ) {

	$page_options = minimall_page_options();

	if( !is_search() && !$page_options['disable_lazyload'] ){

		$minimall_matches = array();
		preg_match_all( '/<iframe\s+.*?>/', $html, $minimall_matches );

		foreach ( $minimall_matches[0] as $k=>$minimall_iframe ) {

			// Don't mess with the Gravity Forms ajax iframe
			if ( strpos( $minimall_iframe, 'gform_ajax_frame' ) ) {
				continue;
			}

			$minimall_placeholder = 'data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=';

			$minimall_iframe = preg_replace( '/<iframe(.*?)src=/is', '<iframe$1src="' . $minimall_placeholder . '" class="lazyload blur-up" data-src=', $minimall_iframe );

			$html = str_replace( $minimall_matches[0][ $k ], $minimall_iframe, $html );

		}
	}

	return $html;
}

add_action("wp_head","minimall_img_picturefill");
function minimall_img_picturefill(){
?>
<script>
    // Lazyload picturefill
    function minimall_loadJS(u){var r=document.getElementsByTagName("script")[ 0 ],s=document.createElement("script");s.src=u;r.parentNode.insertBefore(s,r);}
    if (!window.HTMLPictureElement || document.msElementsFromPoint) {
        minimall_loadJS('<?php echo plugins_url( "/vendors/lazysizes/plugins/respimg/ls.respimg.min.js" , __FILE__ ); ?>');
    }
</script>
<?php
}