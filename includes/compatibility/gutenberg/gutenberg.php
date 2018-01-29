<?php
/* 
* Gutenberg Support
*/
add_action( 'after_setup_theme', 'minimall_gutenberg_init' );
function minimall_gutenberg_init(){
    add_theme_support( 'editor-color-palette',
        get_theme_mod('primary_color','#1078ff'),
        get_theme_mod('text_color','#3A4145'),
        '#fff',
        '#eee',
        '#444'
    );
    add_theme_support( 'align-wide' );
}

/*
* Gutenberg Editor Styles
*/
add_action( 'enqueue_block_editor_assets', 'minimall_gutenberg_editor_styles' );
function minimall_gutenberg_editor_styles() {
    wp_enqueue_style( 'minimall-blocks-style', get_template_directory_uri() . '/includes/compatibility/gutenberg/gutenberg-editor.css');
}


/**
 * Enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', 'minimall_gutenberg_styles' );
function minimall_gutenberg_styles() {
    wp_enqueue_style( 'minimall-gutenberg-style', trailingslashit( get_template_directory_uri() ) . '/includes/compatibility/gutenberg/gutenberg.css' );
}