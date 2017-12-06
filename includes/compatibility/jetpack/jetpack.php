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
add_action('init', 'minimall_optimiazation_jetpack');
function minimall_optimiazation_jetpack(){
    if( get_theme_mod('jetpack_performance',false) ):
        wp_dequeue_script( 'devicepx' );
        add_filter( 'jetpack_implode_frontend_css', '__return_false' );
    endif;
}
/*
add_filter( 'comments_open', 'tweakjp_rm_comments_att', 10 , 2 );
function tweakjp_rm_comments_att( $open, $post_id ) {
    $post = get_post( $post_id );
    if( $post->post_type == 'attachment' ) {
    return false;
    }
    return $open;
    }
    */

    function jeherve_custom_tiled_gallery_width() {
        return '543';
        }
        add_filter( 'tiled_gallery_content_width', 'jeherve_custom_tiled_gallery_width' );