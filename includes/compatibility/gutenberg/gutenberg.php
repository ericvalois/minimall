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
            get_theme_mod('text_color','#3A4145'),
            '#fff',
        ),
    ) );
}