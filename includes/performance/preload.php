<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Add preload section
 * 
 */
/*
Minimall_Kirki::add_section( 'performance_preload', array(
    'title'      => esc_attr__( 'Preload', 'minimall' ),
    'priority'   => 10,
    'panel'		 => 'performance',
    'capability' => 'edit_theme_options',
) );

Minimall_Kirki::add_field( 'minimall', array(
    'type'        => 'checkbox',
    'settings'    => 'performance_activate_preload',
    'label'       => __( 'Activate Link Preload', 'minimall' ),
    'description' => __( 'By enabling this option, you will improve the loading time of your website.', 'minimall' ),
    'section'     => 'performance_preload',
    'default'     => '0',
    'priority'    => 10,
) );
*/

/*
* Preload
*/
add_action('minimall_head_open','minimall_do_preload',5);
function minimall_do_preload(){
    do_action('minimall_preload');
}