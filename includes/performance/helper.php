<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Add action hook to output inline javascript
 */
add_action("wp_footer","performance_module_custom_script", 99);
function performance_module_custom_script(){
    echo '<script>';

    do_action('light_bold_footer_scripts');

    echo '</script>';
}

/*
 * Check if stylesheets optimization is disabled
 * 
 * @return true or false from associate post meta
 */
function performance_module_is_stylesheets_optimization_disabled(){
    
    global $post;

    if( !is_object( $post ) || !empty( $post->ID ) ){
        return false;
    }

    return get_post_meta( $post->ID, 'perf_module_stylesheets', true );
}

/*
 * Check if javascripts optimization is disabled
 * 
 * @return true or false from associate post meta
 */
function performance_module_is_javascripts_optimization_disabled(){

    global $post;
    
    if( !is_object( $post ) || !empty( $post->ID ) ){
        return false;
    }

    return get_post_meta( $post->ID, 'perf_module_javascripts', true );
}
    
/**
* Gets scripts registered and enqueued.
*
* @return array(_WP_Dependency) A list of enqueued dependencies
*/
function performance_module_get_enqueued_scripts() {
    global $wp_scripts;
    $enqueued_scripts = array();
    foreach ( $wp_scripts->queue as $handle ) {
        $enqueued_scripts[] = $wp_scripts->registered[ $handle ];
    }
    return $enqueued_scripts;
}
    
/**
* Gets a script dependency for a handle
*
* @param string $handle The handle
* @return _WP_Dependency associated with input handle
*/
/*function performance_module_get_dep_for_handle( $handle ) {
    global $wp_scripts;
    return $wp_scripts->registered[ $handle ];
}*/
    
/**
* Gets the source URL given a script handle.
*
* @param string $handle The handle
* @return URL associated with handle, or empty string
*/
/*function get_src_for_handle( $handle ) {
    $dep = get_dep_for_handle( $handle );
    $suffix = ( $dep->src && $dep->ver )
        ? "?ver={$dep->ver}"
        : '';
    return "{$dep->src}{$suffix}";
}*/

/**
* Gets all dependencies for a given handle.
*
* @param string $handle The handle
*/
/*function get_deps_for_handle( $handle ) {
    $dep = get_dep_for_handle( $handle );
    return $dep->deps;
}*/