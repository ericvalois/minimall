<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Create customizer Lazy load panel and controls
 *
 * @param WP_Customize_Manager 
 */
add_action( "customize_register", "minimall_customizer_edd_gutenberg_support");
function minimall_customizer_edd_gutenberg_support( $wp_customize ) {
    
    if( minimall_is_edd_active() && minimall_is_gutenberg_active() ):
        /*
        * Controls for EDD Gutenberg support
        */
        $wp_customize->add_setting( 'edd_gutenberg', array(
            'default' => '',
            //'type' => 'option',
            'capability' => 'edit_theme_options',
        ) );

        $wp_customize->add_control( 'edd_gutenberg', array(
            'type' => 'checkbox',
            'priority' => 150,
            'section' => 'edd_single',
            'label' => __( 'Activate Gutenberg Support to EDD', 'ttfb-toolkit' ),
        ) );
    endif;

}

if( get_theme_mod('edd_gutenberg',false) ):
    add_action( 'init', 'minimall_edd_gutenberg_support' );
    add_action( 'init', 'minimall_edd_rest_support', 25 );
endif;

/*
* Add editor support to EDD
*/
function minimall_edd_gutenberg_support() {
    add_post_type_support( 'download', 'editor' );
}

/*
* Add rest api support to EDD
*/
function minimall_edd_rest_support() {
    global $wp_post_types;

    $post_type_name = 'download';
    if( isset( $wp_post_types[ $post_type_name ] ) ) {
        $wp_post_types[$post_type_name]->show_in_rest = true;
        // Optionally customize the rest_base or controller class
        $wp_post_types[$post_type_name]->rest_base = $post_type_name;
        $wp_post_types[$post_type_name]->rest_controller_class = 'WP_REST_Posts_Controller';
    }
}