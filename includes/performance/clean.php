<?php
/*
* Remove everything emoji related
*/
add_action( 'init', 'minimal_disable_emojis' );
function minimal_disable_emojis() {

    $perf_options = minimal_perf_options();

    if( $perf_options['activate_emojis'] && !is_admin() ){
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );	
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        add_filter( 'tiny_mce_plugins', 'minimal_disable_emojis_tinymce' );
        add_filter( 'wp_resource_hints', 'minimal_disable_emojis_remove_dns_prefetch', 10, 2 );
    }
}

/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param    array  $plugins  
 * @return   array             Difference betwen the two arrays
 */
function minimal_disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param  array  $urls          URLs to print for resource hints.
 * @param  string $relation_type The relation type the URLs are printed for.
 * @return array                 Difference betwen the two arrays.
 */
function minimal_disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' == $relation_type ) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2.2.1/svg/' );

		$urls = array_diff( $urls, array( $emoji_svg_url ) );
	}

	return $urls;
}

/**
 * Remove query string
 */
add_filter( 'style_loader_src', 'minimal_remove_wp_ver_css_js', 15, 1 ); 
add_filter( 'script_loader_src', 'minimal_remove_wp_ver_css_js', 15, 1 );
function minimal_remove_wp_ver_css_js( $src ) {

    $perf_options = minimal_perf_options();

    if( $perf_options['activate_query_strings'] && !is_admin() ){
        $rqs = explode( '?ver', $src );
        return $rqs[0];
    }else{
        return $src;
    }
}