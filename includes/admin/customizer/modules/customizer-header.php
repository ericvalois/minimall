<?php
/**
 * Add the typography section
 */
Minimall_Kirki::add_section( 'header', array(
	'title'      => esc_attr__( 'Header Image', 'minimall' ),
    'priority'   => 35,
    'panel'		 => 'minimall_options',
	'capability' => 'edit_theme_options',
) );

Minimall_Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'default_hero_img',
	'label'       => esc_attr__( 'Header image', 'minimall' ),
	'description' => esc_attr__( 'At least 1024px by 450px', 'minimall' ),
	'section'     => 'header',
	'default'     => '',
	'choices'     => array(
		'save_as' => 'id',
	),
) );