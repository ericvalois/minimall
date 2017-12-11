<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Add Lazy load section
 * 
 */
Minimall_Kirki::add_section( 'performance_lazy_load', array(
    'title'      => esc_attr__( 'Lazy Load', 'minimall' ),
    'priority'   => 10,
    'panel'		 => 'performance',
    'capability' => 'edit_theme_options',
) );

Minimall_Kirki::add_field( 'minimall', array(
    'type'        => 'checkbox',
    'settings'    => 'performance_activate_lazyload_img',
    'label'       => __( 'Activate Image Lazy Load', 'minimall' ),
    'description' => __( 'By enabling this option, you will improve the loading time of your website.', 'minimall' ),
    'section'     => 'performance_lazy_load',
    'default'     => '0',
    'priority'    => 10,
) );

Minimall_Kirki::add_field( 'minimall', array(
    'type'        => 'checkbox',
    'settings'    => 'performance_activate_lazyload_iframe',
    'label'       => __( 'Activate Iframe Lazy Load', 'minimall' ),
    'description' => __( 'By enabling this option, you will improve the loading time of your website.', 'minimall' ),
    'section'     => 'performance_lazy_load',
    'default'     => '0',
    'priority'    => 20,
) );

Minimall_Kirki::add_field( 'theme_config_id', array(
	'type'        => 'custom',
	'settings'    => 'performance_lazy_load_notice',
	'label'       => __( 'Warning!', 'minimall' ),
	'section'     => 'performance_lazy_load',
	'default'     => '<p>' . esc_html__( 'In the case of any display errors, we recommend disabling lazy load options.','minimall') . '</p><p>' . esc_html__('The Lazy Load module defers loading of images and iframes until they become visible in the client’s viewport. This avoids blocking the download of other critical resources necessary for rendering the above the fold section of the page.', 'minimall' ) . '</p>',
	'priority'    => 30,
) );

/*
* AMP Detection
*/
add_action( 'wp', 'minimall_lazyload_disable_on_amp' );
function minimall_lazyload_disable_on_amp() {
	if ( defined( 'AMP_QUERY_VAR' ) && function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) {
		add_filter( 'do_minimall_lazyload', '__return_false' );
	}
}


/**
 * Lazy load module
 *
 * @package perfthemes
 * @since 1.0
 */
add_filter( 'get_avatar'			, 'minimall_lazy_load_image', PHP_INT_MAX );
add_filter( 'the_content'			, 'minimall_lazy_load_image', PHP_INT_MAX );
add_filter( 'widget_text'			, 'minimall_lazy_load_image', PHP_INT_MAX );
add_filter( 'get_image_tag'			, 'minimall_lazy_load_image', PHP_INT_MAX );
add_filter( 'post_thumbnail_html'	, 'minimall_lazy_load_image', PHP_INT_MAX );
function minimall_lazy_load_image( $content ){

    if ( ! get_theme_mod('performance_activate_lazyload_img', false) || 
            ! apply_filters( 'do_minimall_lazyload', true ) ||
            is_search() ||
            is_admin() ) {
        return $content;
    }
    
	global $post;

    
    $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
    $document = new DOMDocument();

    libxml_use_internal_errors(true);
    if( !empty($content) ){
        $document->loadHTML(utf8_decode($content));
    }else{
        return;
    }


    $imgs = $document->getElementsByTagName('img');
    foreach ($imgs as $img) {

        if( !$img->hasAttribute('data-src') ){
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
    
            // Set Lazyload Class
            $existing_class = $img->getAttribute('class');
            $img->setAttribute('class', "lazyload $existing_class");
    
    
            // noscript
            $noscript = $document->createElement('noscript');
            $img->parentNode->insertBefore($noscript);
    
            $image = $document->createElement('image');
            $imageAttribute = $document->createAttribute('src');
            $imageAttribute->value = $existing_src;
            $image->appendChild($imageAttribute);
    
            $noscript->appendChild($image);
        }

    }

    $html_fragment = preg_replace('/^<!DOCTYPE.+?>/', '', str_replace( array('<html>', '</html>', '<body>', '</body>'), array('', '', '', ''), $document->saveHTML()));
    
    return $html_fragment;
}

/**
 * Replace iframes by LazyLoad
 */
add_filter( 'the_content', 'minimall_lazyload_iframes', PHP_INT_MAX );
add_filter( 'widget_text', 'minimall_lazyload_iframes', PHP_INT_MAX );
function minimall_lazyload_iframes( $html ) {

    if ( ! get_theme_mod('performance_activate_lazyload_img', false) || 
        ! apply_filters( 'do_minimall_lazyload', true ) ||
        is_search() ||
        is_admin() ) {
    return $html;
    }

	global $post;

    $matches = array();
    preg_match_all( '/<iframe\s+.*?>/', $html, $matches );

    foreach ( $matches[0] as $k=>$iframe ) {

        // Don't mess with the Gravity Forms ajax iframe
        if ( strpos( $iframe, 'gform_ajax_frame' ) ) {
            continue;
        }

        $placeholder = 'data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=';

        $iframe = preg_replace( '/<iframe(.*?)src=/is', '<iframe$1src="' . $placeholder . '" class="lazyload blur-up" data-src=', $iframe );

        $html = str_replace( $matches[0][ $k ], $iframe, $html );

    }
	

	return $html;
}


add_action("wp_head","minimall_lazyload_picturefill");
function minimall_lazyload_picturefill(){
    if ( ( ! get_theme_mod('performance_activate_lazyload_img', false) && ! get_theme_mod('performance_activate_lazyload_iframe', false) ) || ! apply_filters( 'do_minimall_lazyload', true ) ) {
		return;
    }
?>
<script>
    // Lazyload picturefill
    function minimall_loadJS(u){var r=document.getElementsByTagName("script")[ 0 ],s=document.createElement("script");s.src=u;r.parentNode.insertBefore(s,r);}
    if (!window.HTMLPictureElement || document.msElementsFromPoint) {
        minimall_loadJS('<?php echo trailingslashit( get_template_directory_uri() ) . "includes/vendors/lazysizes/plugins/respimg/ls.respimg.min.js"; ?>');
    }
</script>
<?php
}