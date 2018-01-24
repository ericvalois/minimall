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
    'label'       => __( 'Main Navigation alignment', 'minimall' ),
    'description' => __( 'Main navigation content alignment', 'minimall' ),
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

Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'custom',
	'settings'    => 'hero',
	'section'     => 'header',
	'default'     => '<h2>Hero</h2><hr>',
	'priority'    => 19,
) );

Minimall_Kirki::add_field( 'minimall', array(
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

Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'checkbox',
	'settings'    => 'thumb_as_hero',
    'label'       => __( 'Overwrite hero image with post thumbnail', 'minimall' ),
    'description' => esc_attr__( 'If set, the current post thumbnail will overwrite the default hero image.', 'minimall' ),
	'section'     => 'header',
	'default'     => '0',
	'priority'    => 30,
) );