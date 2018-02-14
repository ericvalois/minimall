<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/*
* Inject Hero image preload
*/
add_action('ttfb_toolkit_preload','minimall_add_preload',10);
function minimall_add_preload(){
    if( get_option('ttfb_toolkit_perf_preload',false) ){
        
        // hero images
        if( is_page_template('templates/homepage.php') ){
            $images = minimall_get_homepage_hero();
            echo '<link rel="preload" as="image" href="' . esc_url( $images['sm'] ) . '" media="(max-width: 40em)">' . PHP_EOL;
            echo '<link rel="preload" as="image" href="' . esc_url( $images['md'] ) . '" media="(min-width: 40em) and (max-width: 64em)">' . PHP_EOL;
            echo '<link rel="preload" as="image" href="' . esc_url( $images['lg'] ) . '" media="(min-width: 64em)">' . PHP_EOL;
        }elseif( ( is_single() || is_page() ) && 
                 !is_page_template() &&
                 !is_singular('download')
        ){
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