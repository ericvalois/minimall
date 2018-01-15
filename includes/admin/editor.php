<?php

add_filter('tiny_mce_before_init','minimall_theme_editor_dynamic_styles');
function minimall_theme_editor_dynamic_styles( $mceInit ) {
    $custom_css = minimall_custom_styles();
    $custom_css = preg_replace( "/\r|\n/", "", $custom_css );
    $styles = esc_attr($custom_css);

    if ( isset( $mceInit['content_style'] ) ) {
        $mceInit['content_style'] .= ' ' . $styles . ' ';
    } else {
        $mceInit['content_style'] = $styles . ' ';
    }
    return $mceInit;
}
/**
 * Registers an editor stylesheet for the theme.
 */
add_action( 'init',          'minimall_add_editor_styles' );
add_action( 'pre_get_posts', 'minimall_add_editor_styles' );
function minimall_add_editor_styles() {
    global $post;

    if( !is_object( $post ) ){
        return;
    }

    add_editor_style( trailingslashit( get_template_directory_uri() ) . 'assets/css/editor.min.css' );

    if( get_page_template_slug( $post->ID ) != '' || get_post_type( $post->ID ) == 'download' ){
        add_editor_style( trailingslashit( get_template_directory_uri() ) . 'assets/css/editor-full-width.min.css' );
    }
}
