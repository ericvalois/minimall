<?php
Minimall_Kirki::add_section( 'colors', array(
	'title'      => esc_attr__( 'Colors', 'minimall' ),
    'priority'   => 80,
    'panel'		 => 'minimall_options',
	'capability' => 'edit_theme_options',
) );

Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'color',
	'settings'    => 'primary_color',
	'label'       => __( 'Primary Color', 'minimall' ),
	'section'     => 'colors',
	'default'     => '#1078ff',
	'priority'    => 1,
	'choices'     => array(
		'alpha' => true,
    ),
) );

Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'color',
	'settings'    => 'text_color',
	'label'       => __( 'Text Color', 'minimall' ),
	'section'     => 'colors',
	'default'     => '#3A4145',
	'priority'    => 10,
	'choices'     => array(
		'alpha' => true,
    ),
) );