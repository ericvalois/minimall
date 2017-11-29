<?php
/*
* Create EDD Perforamnce Section
*/
Minimall_Kirki::add_section( 'edd_performance', array(
    'title'      => esc_attr__( 'Easy Digital Download', 'minimall' ),
    'priority'   => 30,
    'panel'		 => 'performance',
    'capability' => 'edit_theme_options',
) );

/*
* Create EDD Archive Controls
*/
Minimall_Kirki::add_field( 'minimall', array(
    'type'        => 'checkbox',
    'settings'    => 'edd_optimization',
    'label'       => __( 'Active EDD Optimization', 'minimall' ),
    'description' => __( 'This option disables EDD scripts on no-EDD pages.', 'minimall' ),
    'section'     => 'edd_performance',
    'default'     => '0',
    'priority'    => 10,
) );

/*
* EDD cleanup
*/
add_action( 'wp_print_scripts', 'minimall_edd_clean_up', 100 );
add_action( 'wp_enqueue_scripts', 'minimall_edd_clean_up', 100 );
function minimall_edd_clean_up(){
    global $post;

    if( get_theme_mod('edd_optimization',false) ):
        if( 
            ! is_singular( 'download' ) && 
            ! is_post_type_archive( 'download' ) &&
            ! is_tax( 'download_category' ) &&
            ! is_tax( 'download_tag' )  &&
            ! is_admin() &&
            ! wp_is_login() &&
            ! ( is_page() && has_shortcode( $post->post_content, 'downloads') ) &&
            ! ( is_page() && has_shortcode( $post->post_content, 'download_history') ) &&
            ! ( is_page() && has_shortcode( $post->post_content, 'download_discounts') ) &&
            ! ( is_page() && has_shortcode( $post->post_content, 'edd_receipt') ) &&
            ! ( is_page() && has_shortcode( $post->post_content, 'download_cart') ) &&
            ! ( is_page() && has_shortcode( $post->post_content, 'purchase_history') ) &&
            ! ( is_page() && has_shortcode( $post->post_content, 'download_checkout') ) &&
            ! ( is_page() && has_shortcode( $post->post_content, 'purchase_link') ) &&
            ! ( is_page() && has_shortcode( $post->post_content, 'edd_profile_editor') ) &&
            ! ( is_page() && has_shortcode( $post->post_content, 'edd_login') ) &&
            ! ( is_page() && has_shortcode( $post->post_content, 'edd_register') ) &&
            ! ( is_page() && has_shortcode( $post->post_content, 'edd_price') ) &&
            ! ( is_page() && has_shortcode( $post->post_content, 'purchase_collection') ) &&
            ! ( is_page() && has_shortcode( $post->post_content, 'edd_license_keys') ) &&
            ! edd_is_checkout()
        ){
            // Dequeue EDD Ajax script
            wp_dequeue_script( 'edd-ajax' );

            // Minimall EDD Script
            wp_dequeue_script( 'minimall-edd' );

            // Dequeue Stripe Script
            wp_dequeue_script( 'stripe-js' );
            wp_dequeue_script( 'stripe-checkout' );
            wp_dequeue_script( 'edd-stripe-js' );

            wp_dequeue_style( 'minimall-edd-reviews' );
        }
    endif;
}