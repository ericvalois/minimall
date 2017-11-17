<?php
/**
 * Add the typography section
 */
Minimall_Kirki::add_section( 'typography', array(
	'title'      => esc_attr__( 'Typography', 'minimall' ),
    'priority'   => 20,
    'panel'		 => 'minimall_options',
	'capability' => 'edit_theme_options',
) );

Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'number',
	'settings'    => 'mobile_font_size',
	'label'       => esc_attr__( 'Mobile Font Size', 'minimall' ),
	'description' => esc_attr__( 'Generic value to generate the responsive typography.', 'minimall' ),
	'section'     => 'typography',
    'default'     => '16',
    'priority'    => 10,
	'choices'     => array(
		'min'  => 12,
		'max'  => 30,
		'step' => 1,
	),
) );

Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'number',
	'settings'    => 'desktop_font_size',
	'label'       => esc_attr__( 'Desktop Font Size', 'minimall' ),
	'description' => esc_attr__( 'Generic value to generate the responsive typography.', 'minimall' ),
	'section'     => 'typography',
    'default'     => '19',
    'priority'    => 20,
	'choices'     => array(
		'min'  => 12,
		'max'  => 30,
		'step' => 1,
	),
) );

/*Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'custom',
	'settings'    => 'warning_typography',
	'label'       => __( 'Speed Concerns', 'minimall' ),
	'section'     => 'typography',
    'default'     => '<div style="">'.esc_html__('Google Fonts may affect negatively your site performance.','minimall').'</div><hr style="margin: 15px 0;">',
	'priority'    => 30,
) );*/
