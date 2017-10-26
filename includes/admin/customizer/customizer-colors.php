<?php
Minimal_Kirki::add_field( 'minimal', array(
	'type'        => 'color',
	'settings'    => 'primary_color',
	'label'       => __( 'Primary Color', 'minimal' ),
	'section'     => 'colors',
	'default'     => '#1078ff',
	'priority'    => 1,
	'choices'     => array(
		'alpha' => true,
    ),
    'output' => array(
		array(
			'element'  => array('a','a.black:hover','.btn-outline:hover','.btn-outline:active','#home-hero .content a'),
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
	),
) );