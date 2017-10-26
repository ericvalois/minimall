<?php
/**
 * Add the typography section
 */
Minimal_Kirki::add_section( 'typography', array(
	'title'      => esc_attr__( 'Typography', 'minimal' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
) );

Minimal_Kirki::add_field( 'minimal', array(
	'type'        => 'custom',
	'settings'    => 'warning_typography',
	'label'       => __( 'Speed Concerns', 'minimal' ),
	'section'     => 'typography',
    'default'     => '<div style="">'.esc_html__('Google Fonts may affect negatively your site performance.','minimal').'</div><hr style="margin: 15px 0;">',
	'priority'    => 9,
) );

/**
 * Add the body-typography control
 */
Minimal_Kirki::add_field( 'minimal', array(
	'type'        => 'typography',
	'settings'    => 'body_typography',
	'label'       => esc_attr__( 'Body Typography', 'minimal' ),
	'description' => esc_attr__( 'Select the main typography options for your site.', 'minimal' ),
	'help'        => esc_attr__( 'The typography options you set here apply to all content on your site.', 'minimal' ),
	'section'     => 'typography',
    'priority'    => 10,
	'default'     => array(
		'font-family'    => '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif',
		'variant'        => '400',
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
        'color'          => '',
        //'subsets'        => array( 'latin' ),
	),
	'output' => array(
		array(
			'element' => 'body',
		),
	),
) );

Minimal_Kirki::add_field( 'minimal', array(
	'type'        => 'switch',
	'settings'    => 'text_font',
	'label'       => __( 'Paragraph Typography', 'minimal' ),
	'section'     => 'typography',
	'default'     => '0',
	'priority'    => 40,
) );

/**
 * Add the text-typography control
 */
Minimal_Kirki::add_field( 'minimal', array(
	'type'        => 'typography',
	'settings'    => 'text_typography',
	'label'       => esc_attr__( 'Paragraph Typography', 'minimal' ),
	'description' => esc_attr__( 'Select the typography options for your headers.', 'minimal' ),
	'help'        => esc_attr__( 'The typography options you set here will override the Body Typography options for all headers on your site (post titles, widget titles etc).', 'minimal' ),
	'section'     => 'typography',
    'priority'    => 50,
    'active_callback'    => array(
        array(
            'setting'  => 'text_font',
            'operator' => '==',
            'value'    => true,
        ),
    ),
	'default'     => array(
		'font-family'    => 'Georgia,Times,"Times New Roman",serif',
		//'variant'        => '400',
		'font-size'      => '105%',
		//'line-height'    => '',
		//'letter-spacing' => '',
        //'color'          => '',
        //'subsets'        => array(),
	),
	'output' => array(
		array(
			'element' => array( '.entry-content p' ),
		),
	),
) );