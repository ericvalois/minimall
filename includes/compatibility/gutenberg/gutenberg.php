<?php
/* 
* Gutenberg Support
*/
add_action( 'after_setup_theme', 'minimall_gutenberg_init' );
function minimall_gutenberg_init(){
    add_theme_support( 'gutenberg', array(
        'wide-images' => true,
        'align-wide' => true,
        'colors' => array(
            get_theme_mod('primary_color','#1078ff'),
            '#333',
            '#3a4145',
        ),
    ) );
}

/**
 * Enqueue scripts and styles for Gutenberg editor
 */
//add_action( 'enqueue_block_editor_assets', 'minimall_editor_styles' );
function minimall_editor_styles() {
    if ( is_child_theme() ) {
        wp_enqueue_style( 'minimall-parent-style', trailingslashit( get_template_directory_uri() ) . 'style.css' );
        wp_enqueue_style( 'minimall-stylesheet', get_stylesheet_uri()  );
    }else{
    	wp_enqueue_style( 'minimall-stylesheet', trailingslashit( get_template_directory_uri() ) . 'style.css' );
    }
}

