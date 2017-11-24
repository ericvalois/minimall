<?php
/**
 * Add the Social Share section
 */
Minimall_Kirki::add_section( 'social_share', array(
	'title'      => esc_attr__( 'Social Share', 'minimall' ),
    'priority'   => 40,
    'panel'		 => 'minimall_options',
	'capability' => 'edit_theme_options',
) );

Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'text',
	'settings'    => 'social_share_label',
    'label'       => __( 'Social share label', 'minimall' ),
	'section'     => 'social_share',
	'default'     => '',
    'priority'    => 30,
    'active_callback'    => array(
        array(
            'setting'  => 'activate_social_share',
            'operator' => '==',
            'value'    => '1',
        ),
    ),
) );

Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'multicheck',
	'settings'    => 'social_share',
	'label'       => __( 'Activated network', 'minimall' ),
	'description' => __( 'Uncheck network you don\'t want to display.', 'minimall' ),
    'section'     => 'social_share',
    'default'     => array('facebook', 'twitter', 'google', 'linkedin', 'pinterest'),
	'choices'     => array(
		'facebook' => esc_attr__( 'Facebook', 'minimall' ),
		'twitter' => esc_attr__( 'Twitter', 'minimall' ),
		'google' => esc_attr__( 'Google', 'minimall' ),
		'linkedin' => esc_attr__( 'Linkedin', 'minimall' ),
		'pinterest' => esc_attr__( 'Pinterest', 'minimall' ),
	),
    'priority'    => 40,
) );

Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'select',
	'settings'    => 'social_share_append',
    'label'       => __( 'Automatically append', 'minimall' ),
    'description' => __( 'Automatically append social share module to content. A widget is also available.', 'minimall' ),
	'section'     => 'social_share',
	'default'     => 'none',
	'priority'    => 50,
	'multiple'    => 0,
	'choices'     => array(
		'none' => esc_attr__( 'None', 'minimall' ),
		'top' => esc_attr__( 'At the top', 'minimall' ),
        'bottom' => esc_attr__( 'At the bottom', 'minimall' ),
        'both' => esc_attr__( 'Both', 'minimall' ),
	),
) );

Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'select',
	'settings'    => 'social_share_append_to',
    'label'       => __( 'Append to', 'minimall' ),
	'section'     => 'social_share',
	'default'     => 'all',
	'priority'    => 50,
    'multiple'    => 0,
    'active_callback'    => array(
        array(
            'setting'  => 'social_share_append',
            'operator' => '!=',
            'value'    => 'none',
        ),
    ),
	'choices'     => array(
		'all' => esc_attr__( 'Pages and Posts', 'minimall' ),
		'posts' => esc_attr__( 'Posts only', 'minimall' ),
		'pages' => esc_attr__( 'Pages only', 'minimall' ),
	),
) );