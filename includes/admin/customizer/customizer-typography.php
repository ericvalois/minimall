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
	'type'        => 'custom',
	'settings'    => 'warning_typography',
	'label'       => __( 'Speed Concerns', 'minimall' ),
	'section'     => 'typography',
    'default'     => '<div style="">'.esc_html__('Google Fonts may affect negatively your site performance.','minimall').'</div><hr style="margin: 15px 0;">',
	'priority'    => 9,
) );

/**
 * Add the body-typography control
 */
Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'typography',
	'settings'    => 'body_typography',
	'label'       => esc_attr__( 'Body Typography', 'minimall' ),
	'description' => esc_attr__( 'Select the main typography options for your site.', 'minimall' ),
	'help'        => esc_attr__( 'The typography options you set here apply to all content on your site.', 'minimall' ),
	'section'     => 'typography',
    'priority'    => 10,
	'default'     => array(
		'font-family'    => '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif',
		'variant'        => '400',
		'font-size'      => '100%',
		'line-height'    => '1.8',
		'letter-spacing' => '0.01rem',
        'color'          => '#3A4145',
        'subsets'        => array( 'latin' ),
	),
	'output' => array(
		array(
			'element' => 'body',
		),
	),
) );

/*Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'switch',
	'settings'    => 'text_font',
	'label'       => __( 'Paragraph Typography', 'minimall' ),
	'section'     => 'typography',
	'default'     => '0',
	'priority'    => 40,
) );*/

/**
 * Add the text-typography control
 */
Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'typography',
	'settings'    => 'text_typography',
	'label'       => esc_attr__( 'Paragraph Typography', 'minimall' ),
	'description' => esc_attr__( 'Select the typography options for your headers.', 'minimall' ),
	'help'        => esc_attr__( 'The typography options you set here will override the Body Typography options for all headers on your site (post titles, widget titles etc).', 'minimall' ),
	'section'     => 'typography',
    'priority'    => 50,
    /*'active_callback'    => array(
        array(
            'setting'  => 'text_font',
            'operator' => '==',
            'value'    => true,
        ),
    ),*/
	'default'     => array(
		'font-family'    => 'Georgia,Times,"Times New Roman",serif',
		'variant'        => '400',
		'font-size'      => '105%',
		'line-height'    => '1.8',
		'letter-spacing' => '0.01rem',
        'color'          => '#3A4145',
        'subsets'        => array( 'latin' ),
	),
	'output' => array(
		array(
			'element' => array( '.entry-content p' ),
		),
	),
) );