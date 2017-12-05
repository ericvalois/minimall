<?php
/*
* Create Contact Form 7 Panels
*/
Minimall_Kirki::add_section( 'cf7_performance', array(
    'title'      => esc_attr__( 'Contact Form 7', 'minimall' ),
    'priority'   => 60,
    'panel'		 => 'performance',
    'capability' => 'edit_theme_options',
) );

/*
* Create Contact Form 7 Controls
*/
Minimall_Kirki::add_field( 'minimall', array(
    'type'        => 'checkbox',
    'settings'    => 'cf7_optimization',
    'label'       => __( 'Activate Contact Form 7 Optimization', 'minimall' ),
    'description' => __( 'This option removes scripts and stylesheets when there is no contact form.', 'minimall' ),
    'section'     => 'cf7_performance',
    'default'     => '0',
    'priority'    => 10,
) );

/*
* Disable contact form 7 scripts and styles
*/
add_action('wp', 'minimall_optimiazation_contact_form_7');
function minimall_optimiazation_contact_form_7(){
    global $post;
    
    if( !is_object( $post ) ){ return false; }
    
    if( get_theme_mod('cf7_optimization',false) &&
    !has_shortcode( $post->post_content, 'contact-form-7') ):
        
        add_filter( 'wpcf7_load_js', '__return_false' );
        add_filter( 'wpcf7_load_css', '__return_false' );
    endif;
    
}