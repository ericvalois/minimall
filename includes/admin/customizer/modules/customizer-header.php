<?php
/**
 * Add the typography section
 */
Minimall_Kirki::add_section( 'header', array(
	'title'      => esc_attr__( 'Header', 'minimall' ),
    'priority'   => 35,
    'panel'		 => 'ttfb_options',
	'capability' => 'edit_theme_options',
) );


Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'select',
	'settings'    => 'header_alignment',
    'label'       => __( 'Header alignment', 'minimall' ),
    'description' => __( 'Header content alignment', 'minimall' ),
	'section'     => 'header',
	'default'     => 'justify-end',
	'priority'    => 10,
	'multiple'    => 0,
	'choices'     => array(
		'justify-end' => esc_attr__( 'Right', 'minimall' ),
        'justify-start' => esc_attr__( 'Left', 'minimall' ),
        'justify-center' => esc_attr__( 'Center', 'minimall' ),
        'justify-between' => esc_attr__( 'Space between', 'minimall' ),
        'justify-around' => esc_attr__( 'Space around', 'minimall' ),
	),
) );

Minimall_Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
    'settings'    => 'default_hero_img',
    'priority'   => 20,
	'label'       => esc_attr__( 'Default hero image', 'minimall' ),
	'description' => esc_attr__( 'At least 1024px by 450px', 'minimall' ),
	'section'     => 'header',
	'default'     => '',
	'choices'     => array(
		'save_as' => 'id',
	),
) );