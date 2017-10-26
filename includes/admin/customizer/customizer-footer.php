<?php
/**
 * Add the typography section
 */
Minimal_Kirki::add_section( 'footer', array(
	'title'      => esc_attr__( 'Footer', 'minimal' ),
	'priority'   => 40,
	'capability' => 'edit_theme_options',
) );

Minimal_Kirki::add_field( 'minimal', array(
	'type'        => 'custom',
	'settings'    => 'footer_separator_1',
	'section'     => 'footer',
	'default'     => '<h2>Footer Hero</h2><hr style="">',
	'priority'    => 9,
) );

Minimal_Kirki::add_field( 'minimal', array(
	'type'        => 'toggle',
	'settings'    => 'footer_hero',
	'label'       => __( 'Activate Footer Hero', 'minimal' ),
	'section'     => 'footer',
	'default'     => '0',
	'priority'    => 10,
) );

Minimal_Kirki::add_field( 'minimal', array(
	'type'     => 'text',
	'settings' => 'footer_hero_label',
	'label'    => __( 'Top Label', 'minimal' ),
	'section'  => 'footer',
    'priority' => 20,
    'active_callback'    => array(
        array(
            'setting'  => 'footer_hero',
            'operator' => '==',
            'value'    => true,
        ),
    ),
) );

Minimal_Kirki::add_field( 'minimal', array(
	'type'     => 'textarea',
	'settings' => 'footer_hero_title',
	'label'    => __( 'Main Title', 'minimal' ),
	'section'  => 'footer',
    'priority' => 20,
    'active_callback'    => array(
        array(
            'setting'  => 'footer_hero',
            'operator' => '==',
            'value'    => true,
        ),
    ),
) );

Minimal_Kirki::add_field( 'minimal', array(
	'type'     => 'text',
	'settings' => 'footer_cta_url',
	'label'    => __( 'Call to action link', 'minimal' ),
	'section'  => 'footer',
    'priority' => 30,
    'default'  => esc_attr__( 'http://', 'minimal' ),
    'active_callback'    => array(
        array(
            'setting'  => 'footer_hero',
            'operator' => '==',
            'value'    => true,
        ),
    ),
) );

Minimal_Kirki::add_field( 'minimal', array(
	'type'     => 'text',
	'settings' => 'footer_cta_label',
	'label'    => __( 'Call to action label', 'minimal' ),
	'section'  => 'footer',
    'priority' => 40,
    'default'  => esc_attr__( 'Read more', 'minimal' ),
    'transport' => 'postMessage',
    'js_vars'   => array(
		array(
			'element'  => '.footer_cta_label',
			'function' => 'html',
		),
    ),
    'active_callback'    => array(
        array(
            'setting'  => 'footer_hero',
            'operator' => '==',
            'value'    => true,
        ),
    ),
) );

Minimal_Kirki::add_field( 'minimal', array(
	'type'     => 'fontawesome',
	'settings' => 'footer_cta_icon',
	'label'    => __( 'Call to action icon', 'minimal' ),
	'section'  => 'footer',
    'priority' => 45,
    'active_callback'    => array(
        array(
            'setting'  => 'footer_hero',
            'operator' => '==',
            'value'    => true,
        ),
        array(
            'setting'  => 'fontawesome',
            'operator' => '==',
            'value'    => true,
        ),
    ),
) );

Minimal_Kirki::add_field( 'minimal', array(
	'type'        => 'multicheck',
	'settings'    => 'footer_cta_options',
	'label'       => __( 'Call to action options', 'minimal' ),
	'section'     => 'footer',
    'priority'    => 50,
    'active_callback'    => array(
        array(
            'setting'  => 'footer_hero',
            'operator' => '==',
            'value'    => true,
        ),
    ),
    'choices'     => array(
		'blank' => esc_attr__( 'New window', 'minimal' ),
		'nofollow' => esc_attr__( 'Nofollow', 'minimal' ),
	),
) );

Minimal_Kirki::add_field( 'minimal', array(
	'type'        => 'custom',
	'settings'    => 'footer_separator_2',
	'section'     => 'footer',
	'default'     => '<h2>Footer Widgets Area</h2><hr style="">',
	'priority'    => 60,
) );

Minimal_Kirki::add_field( 'minimal', array(
	'type'        => 'radio-image',
	'settings'    => 'footer_widget_layout',
	'label'       => esc_html__( 'Layout', 'minimal' ),
	'section'     => 'footer',
	'default'     => '3',
	'priority'    => 69,
	'choices'     => array(
		'1'   => get_template_directory_uri() . '/includes/admin/images/one-column.png',
		'2' => get_template_directory_uri() . '/includes/admin/images/two-columns.png',
        '3'  => get_template_directory_uri() . '/includes/admin/images/three-columns.png',
        '4'  => get_template_directory_uri() . '/includes/admin/images/four-columns.png',
	),
) );

Minimal_Kirki::add_field( 'minimal', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'footer_widget_spacing',
    'label'       => __( 'Columns spacings', 'minimal' ),
    'description'       => __( 'Space between each columns', 'minimal' ),
	'section'     => 'footer',
	'default'     => 'px3',
	'priority'    => 70,
	'choices'     => array(
		'px1'   => esc_attr__( 'Small', 'minimal' ),
		'px2' => esc_attr__( 'Medium', 'minimal' ),
        'px3'  => esc_attr__( 'Large', 'minimal' ),
        'px4'  => esc_attr__( 'XLarge', 'minimal' ),
	),
) );

Minimal_Kirki::add_field( 'minimal', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'footer_widget_breakpoints',
    'label'       => __( 'Columns Breakpoints', 'minimal' ),
    'description'       => __( 'Mobile (≈640px) | Tablet (≈832px) | Desktop (≈1024px) | Large Desktop (≈1650px)', 'minimal' ),
	'section'     => 'footer',
	'default'     => 'lg',
	'priority'    => 80,
	'choices'     => array(
		'sm'   => esc_attr__( 'Mobile', 'minimal' ),
		'md' => esc_attr__( 'Tablet', 'minimal' ),
        'lg'  => esc_attr__( 'Desktop', 'minimal' ),
        'xlg'  => esc_attr__( 'Large Desktop', 'minimal' ),
	),
) );