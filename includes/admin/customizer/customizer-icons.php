<?php
/**
 * Add the Font Awesome section
 */
Minimal_Kirki::add_section( 'fontawesome', array(
	'title'      => esc_attr__( 'Font Awesome Icons', 'minimal' ),
	'priority'   => 80,
	'capability' => 'edit_theme_options',
) );

Minimal_Kirki::add_field( 'minimal', array(
	'type'        => 'checkbox',
	'settings'    => 'fontawesome',
	'label'       => __( 'Activate Font Awesome Icons', 'minimal' ),
	'section'     => 'fontawesome',
	'default'     => '0',
	'priority'    => 10,
) );



Kirki::add_field( 'minimal', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'fontawesome_type',
	'label'       => esc_html__( 'Icons Type', 'minimal' ),
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
		'solid'   => esc_attr__( 'Solid', 'minimal' ),
		'regular' => esc_attr__( 'Regular', 'minimal' ),
		'light'  => esc_attr__( 'Light', 'minimal' ),
	),
) );
