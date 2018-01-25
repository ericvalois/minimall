<?php
/*
* Dequeue webfont-loader from kirki
*/
add_action( 'wp_head', 'minimall_kirki_dequeue_webfont_loader', 999 );
function minimall_kirki_dequeue_webfont_loader() {
    wp_deregister_script('webfont-loader');
    wp_dequeue_script('webfont-loader');
 }

/*
* Dequeue kirki font awesome
*/
if( !function_exists('minimall_kirki_dequeue_font_awesome') ){
    add_action( 'wp_head', 'minimall_kirki_dequeue_font_awesome', 999 );
    function minimall_kirki_dequeue_font_awesome() {
        wp_deregister_script('kirki-fontawesome-font');
        wp_dequeue_script('kirki-fontawesome-font');
    }
}
 
/**
 * Remove Kirki font awesome prefetch
 */
if( !function_exists('minimall_kirki_font_awesome_dns_prefetch') ){
    add_filter( 'wp_resource_hints', 'minimall_kirki_font_awesome_dns_prefetch', 10, 2 );
    function minimall_kirki_font_awesome_dns_prefetch( $urls, $relation_type ) {
        if (($key = array_search("use.fontawesome.com", $urls)) !== false) {
            unset($urls[$key]);
        }
    
        return $urls;
    }
}

