<?php
/**
 * Add the Font Awesome section
 */
Minimall_Kirki::add_section( 'fontawesome', array(
	'title'      => esc_attr__( 'Font Awesome Icons', 'minimall' ),
    'priority'   => 80,
    'panel'		 => 'minimall_options',
	'capability' => 'edit_theme_options',
) );

Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'toggle',
	'settings'    => 'fontawesome',
	'label'       => __( 'Activate Font Awesome Icons', 'minimall' ),
    'section'     => 'fontawesome',
    'description'       => __( 'More than 600 icons', 'minimall' ),
	'default'     => '0',
	'priority'    => 10,
) );

Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'checkbox',
	'settings'    => 'fontawesome_brands',
    'label'       => __( 'Include Font Awesome Brands Icons', 'minimall' ),
    'description'       => __( 'Activate only if brands icons are necessary. (Facebook, Twitter, Dropbox)', 'minimall' ),
	'section'     => 'fontawesome',
	'default'     => '0',
    'priority'    => 20,
    'active_callback'    => array(
        array(
            'setting'  => 'fontawesome',
            'operator' => '==',
            'value'    => true,
        ),
    ),
) );



Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'fontawesome_type',
	'label'       => esc_html__( 'Icons Type', 'minimall' ),
	'section'     => 'fontawesome',
	'default'     => 'Light',
    'priority'    => 30,
    'active_callback'    => array(
        array(
            'setting'  => 'fontawesome',
            'operator' => '==',
            'value'    => true,
        ),
    ),
	'choices'     => array(
		'solid'   => esc_attr__( 'Solid', 'minimall' ),
		'regular' => esc_attr__( 'Regular', 'minimall' ),
		'light'  => esc_attr__( 'Light', 'minimall' ),
	),
) );

