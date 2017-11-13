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
    /*'output' => array(
		array(
			'element'  => array('a','a.black:hover','.btn-outline:hover','.btn-outline:active'),
			'property' => 'color',
		),
		array(
			'element'  => array('.btn-primary','.btn-black:hover','.btn-black:active','.btn-black:focus'),
			'property' => 'background-color',
        ),
        array(
			'element'  => array('.btn-outline:hover','.btn-outline:active'),
			'property' => 'border-color',
		),
	),*/
) );
/*
Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'tpfw_link',
	'settings'    => 'super_link',
	'label'       => __( 'Link', 'minimall' ),
	'section'     => 'colors',
	'priority'    => 20,
) );*/