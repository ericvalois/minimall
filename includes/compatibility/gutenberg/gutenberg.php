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

/* 
* Add gutenberg class
*/
function minimall_conditionnal_gutenberg_class( $is_class = "", $is_not_class = "" ){

    if( !is_page() && !is_single() ){ return false; }

    if (function_exists('the_gutenberg_project') && gutenberg_post_has_blocks( get_the_ID() ) ){
        return $is_class;
    }else{
        return $is_not_class;
    }

}