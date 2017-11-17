<?php
/**
 * Add private dashboard options
 */

/*
* Create Private Dashboard Panels
*/
Minimall_Kirki::add_section( 'private_dashboard', array(
    'title'      => esc_attr__( 'Private Dashboard', 'minimall' ),
    'priority'   => 100,
    'panel'		 => 'minimall_options',
    'capability' => 'edit_theme_options',
) );

Minimall_Kirki::add_field( 'minimall', array(
    'type'        => 'checkbox',
    'settings'    => 'private_dashboard_private',
    'label'       => __( 'Redirect user not logged', 'minimall' ),
    'description' => __( 'Redirect users that try to access private dashboard pages.', 'minimall' ),
    'section'     => 'private_dashboard',
    'default'     => '0',
    'priority'    => 10,
) );

Minimall_Kirki::add_field( 'minimall', array(
    'type'        => 'generic',
    'settings'    => 'private_dashboard_login_url',
    'label'       => __( 'Login Url', 'minimall' ),
    'description' => __( 'URL where users are redirected if not logged. (default to wp-login.php)', 'minimall' ),
    'section'     => 'private_dashboard',
    'default'     => '',
    'active_callback'    => array(
        array(
            'setting'  => 'private_dashboard_private',
            'operator' => '==',
            'value'    => '1',
        ),
    ),
	'choices'     => array(
		'element'  => 'input',
		'type'     => 'url',
		'placeholder' => 'http://',
	),
    'priority'    => 20,
) );