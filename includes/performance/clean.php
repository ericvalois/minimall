<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Add Clean Up section
 * 
 */
Minimall_Kirki::add_section( 'performance_clean', array(
    'title'      => esc_attr__( 'Clean Up', 'minimall' ),
    'priority'   => 10,
    'panel'		 => 'performance',
    'capability' => 'edit_theme_options',
) );

Minimall_Kirki::add_field( 'minimall', array(
    'type'        => 'checkbox',
    'settings'    => 'performance_disable_emojijs',
    'label'       => __( 'Disable Emojis', 'minimall' ),
    'description' => __( 'Removes the extra code bloat used to add support for emoji’s', 'minimall' ),
    'section'     => 'performance_clean',
    'default'     => '0',
    'priority'    => 10,
) );

Minimall_Kirki::add_field( 'minimall', array(
    'type'        => 'checkbox',
    'settings'    => 'performance_disable_embed',
    'label'       => __( 'Disable Embeds', 'minimall' ),
    'description' => __( 'Remove the wp-embed script added by WordPress.', 'minimall' ),
    'section'     => 'performance_clean',
    'default'     => '0',
    'priority'    => 20,
) );

Minimall_Kirki::add_field( 'theme_config_id', array(
	'type'        => 'checkbox',
	'settings'    => 'performance_disable_query_string',
	'label'       => __( 'Remove Query Strings', 'minimall' ),
	'section'     => 'performance_clean',
	'description'     => __( 'Remove query strings from static resources like CSS & JS files to improve your scores in Pingdom, GTmetrix, PageSpeed and YSlow.','minimall'),
    'default'     => '0',
    'priority'    => 30,
) );

function minimall_get_clean_options(){
    $clean_options = minimall_get_field('minimall_clean', 'option');
    if( !isset($clean_options['emojis']) ){ $clean_options['emojis'] = false; }
    if( !isset($clean_options['embeds']) ){ $clean_options['embeds'] = false; }
    if( !isset($clean_options['query_strings']) ){ $clean_options['query_strings'] = false; }

    return $clean_options;
}


/*
* Remove everything emoji related
*/
add_action( 'init', 'minimall_disable_emojis' );
function minimall_disable_emojis() {

    if( get_theme_mod('performance_disable_emojijs', false) && 
    !is_admin() ){
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );	
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        add_filter( 'tiny_mce_plugins', 'minimall_disable_emojis_tinymce' );
        add_filter( 'wp_resource_hints', 'minimall_disable_emojis_remove_dns_prefetch', 10, 2 );
    }
}

/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param    array  $plugins  
 * @return   array             Difference betwen the two arrays
 */
function minimall_disable_emojis_tinymce( $plugins ) {
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
function minimall_disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
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
add_filter( 'style_loader_src', 'minimall_remove_wp_ver_css_js', 15, 1 ); 
add_filter( 'script_loader_src', 'minimall_remove_wp_ver_css_js', 15, 1 );
function minimall_remove_wp_ver_css_js( $src ) {

    if( !is_admin() &&
    get_theme_mod('performance_disable_query_string',false)){
        $rqs = explode( '?ver', $src );
        return $rqs[0];
    }else{
        return $src;
    }
}

/**
 * Remove wp-embed
 */
add_action( 'wp_footer', 'minimall_deregister_embeds' );
function minimall_deregister_embeds(){
    
    if( !is_admin() &&
    get_theme_mod('performance_disable_embed',false)){
        wp_dequeue_script( 'wp-embed' );
    }
}