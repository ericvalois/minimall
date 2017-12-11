<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Add preload section
 * 
 */
Minimall_Kirki::add_section( 'performance_preload', array(
    'title'      => esc_attr__( 'Preload Links', 'minimall' ),
    'priority'   => 10,
    'panel'		 => 'performance',
    'capability' => 'edit_theme_options',
) );

Minimall_Kirki::add_field( 'minimall', array(
    'type'        => 'checkbox',
    'settings'    => 'performance_activate_preload',
    'label'       => __( 'Activate Link Preload', 'minimall' ),
    'description' => __( 'By enabling this option, you will improve the loading time on modern browsers.', 'minimall' ),
    'section'     => 'performance_preload',
    'default'     => '0',
    'priority'    => 10,
) );

/*
* Preload
*/
add_action('minimall_head_open','minimall_do_preload',5);
function minimall_do_preload(){
    if( get_theme_mod('performance_activate_preload',false) ){
        do_action('minimall_preload');
    }
}

/*
* Inject Hero image preload
*/
add_action('minimall_preload','minimall_add_hero_img_preload',10);
function minimall_add_hero_img_preload(){
    if( get_theme_mod('performance_activate_preload',false) ){
        
        // hero images
        if( is_page_template('templates/homepage.php') ){
            $images = minimall_get_homepage_hero();
            echo '<link rel="preload" as="image" href="' . esc_url( $images['sm'] ) . '" media="(max-width: 40em)">' . PHP_EOL;
            echo '<link rel="preload" as="image" href="' . esc_url( $images['md'] ) . '" media="(min-width: 40em) and (max-width: 64em)">' . PHP_EOL;
            echo '<link rel="preload" as="image" href="' . esc_url( $images['lg'] ) . '" media="(min-width: 64em)">' . PHP_EOL;
        }elseif( ( !is_page_template() && is_page() ) || is_singular('post') ){
            $images = minimall_get_default_hero();
            echo '<link rel="preload" as="image" href="' . esc_url( $images['sm'] ) . '" media="(max-width: 40em)">' . PHP_EOL;
            echo '<link rel="preload" as="image" href="' . esc_url( $images['md'] ) . '" media="(min-width: 40em) and (max-width: 64em)">' . PHP_EOL;
            echo '<link rel="preload" as="image" href="' . esc_url( $images['lg'] ) . '" media="(min-width: 64em)">' . PHP_EOL;
        }

        // Logo
        if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ){
            $custom_logo_id = get_theme_mod( 'custom_logo' );
            $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
            echo '<link rel="preload" as="image" href="' . esc_url( $image[0] ) . '">' . PHP_EOL;
        }

    }
}

/*
* Preload jQuery if detected
*/
//add_action('minimall_preload','minimall_add_jquery_preload',10);
function minimall_add_jquery_preload(){
    if( get_theme_mod('performance_activate_preload',false) &&
    wp_script_is( 'jquery', 'enqueued' ) ){
        //echo '<link rel="preload" as="script" href="' . esc_url( $images['lg'] ) . '">' . PHP_EOL;
    }
}