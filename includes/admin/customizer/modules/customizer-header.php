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
	'default'     => 'lg-right',
	'priority'    => 10,
	'multiple'    => 0,
	'choices'     => array(
		'lg-right' => esc_attr__( 'Right', 'minimall' ),
		'lg-left' => esc_attr__( 'Left', 'minimall' ),
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