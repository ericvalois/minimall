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
	'type'        => 'checkbox',
	'settings'    => 'fontawesome',
	'label'       => __( 'Activate Font Awesome Icons', 'minimall' ),
	'section'     => 'fontawesome',
	'default'     => '0',
	'priority'    => 10,
) );



Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'fontawesome_type',
	'label'       => esc_html__( 'Icons Type', 'minimall' ),
	'section'     => 'fontawesome',
	'default'     => 'Light',
    'priority'    => 20,
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

