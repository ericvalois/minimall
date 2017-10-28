<?php
/**
* Gets scripts registered and enqueued.
*
* @return array(_WP_Dependency) A list of enqueued dependencies
*/
function minimall_get_enqueued_scripts() {
    global $wp_scripts;
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
function minimall_get_dep_for_handle( $handle ) {
    global $wp_scripts;
    return $wp_scripts->registered[ $handle ];
}

/**
* Gets the source URL given a script handle.
*
* @param string $handle The handle
* @return URL associated with handle, or empty string
*/
function minimall_get_src_for_handle( $handle ) {
    $dep = get_dep_for_handle( $handle );
    $suffix = ( $dep->src && $dep->ver )
        ? "?ver={$dep->ver}"
        : '';
    return "{$dep->src}{$suffix}";
}

/**
* Gets all dependencies for a given handle.
*
* @param string $handle The handle
*/
function minimall_get_deps_for_handle( $handle ) {
    $dep = get_dep_for_handle( $handle );
    return $dep->deps;
}