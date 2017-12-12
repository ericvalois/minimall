<?php
/*
* Create Jetpack Panels
*/
Minimall_Kirki::add_section( 'jetpack_performance', array(
    'title'      => esc_attr__( 'Jetpack', 'minimall' ),
    'priority'   => 60,
    'panel'		 => 'performance',
    'capability' => 'edit_theme_options',
) );

/*
* Create EDD Archive Controls
*/
Minimall_Kirki::add_field( 'minimall', array(
    'type'        => 'checkbox',
    'settings'    => 'jetpack_optimization',
    'label'       => __( 'Activate Jetpack Optimization', 'minimall' ),
    'description' => __( 'This option removes devicepx script and jetpack stylesheet. Activate only if you know what you are doing.', 'minimall' ),
    'section'     => 'jetpack_performance',
    'default'     => '0',
    'priority'    => 10,
) );

/*
* Disable Jetpack scripts and styles
*/
add_action('wp_enqueue_scripts', 'minimall_optimiazation_jetpack');
function minimall_optimiazation_jetpack(){
    if( get_theme_mod('jetpack_optimization',false) ):
        wp_dequeue_script( 'devicepx' );
    endif;
}

/*
* Remove comment from jetpack galleries
*/
add_filter( 'comments_open', 'minimall_remove_jetpack_gallery_comment', 10 , 2 );
function minimall_remove_jetpack_gallery_comment( $open, $post_id ) {
    if( is_singular('download') ){
        $post = get_post( $post_id );
        if( $post->post_type == 'attachment' ) {
            return false;
        }
    }
    
    return $open;
}