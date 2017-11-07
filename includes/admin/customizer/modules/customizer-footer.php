<?php
/**
 * Add the typography section
 */
Minimall_Kirki::add_section( 'footer', array(
	'title'      => esc_attr__( 'Footer', 'minimall' ),
    'priority'   => 40,
    'panel'		 => 'minimall_options',
	'capability' => 'edit_theme_options',
) );

Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'custom',
	'settings'    => 'footer_separator_1',
	'section'     => 'footer',
	'default'     => '<h2>Footer Hero</h2><hr style="">',
	'priority'    => 9,
) );

Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'toggle',
	'settings'    => 'footer_hero',
	'label'       => __( 'Activate Footer Hero', 'minimall' ),
	'section'     => 'footer',
	'default'     => '0',
	'priority'    => 10,
) );

Minimall_Kirki::add_field( 'minimall', array(
	'type'     => 'text',
	'settings' => 'footer_hero_label',
	'label'    => __( 'Top Label', 'minimall' ),
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

Minimall_Kirki::add_field( 'minimall', array(
	'type'     => 'textarea',
	'settings' => 'footer_hero_title',
	'label'    => __( 'Main Title', 'minimall' ),
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

Minimall_Kirki::add_field( 'minimall', array(
	'type'     => 'tpfw_link',
	'settings' => 'footer_cta',
    'label'    => __( 'Button', 'minimall' ),
    'description' => esc_html__( 'Shortcodes are accepted', 'minimall' ),
	'section'  => 'footer',
    'priority' => 30,
    'default'  => esc_attr__( 'http://', 'minimall' ),
    'active_callback'    => array(
        array(
            'setting'  => 'footer_hero',
            'operator' => '==',
            'value'    => true,
        ),
    ),
) );

Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'custom',
	'settings'    => 'footer_separator_2',
	'section'     => 'footer',
	'default'     => '<h2>Footer Widgets Area</h2><hr style="">',
	'priority'    => 60,
) );

Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'radio-image',
	'settings'    => 'footer_widget_layout',
	'label'       => esc_html__( 'Layout', 'minimall' ),
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

Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'footer_widget_spacing',
    'label'       => __( 'Columns spacings', 'minimall' ),
    'description'       => __( 'Space between each columns', 'minimall' ),
	'section'     => 'footer',
	'default'     => 'px3',
	'priority'    => 70,
	'choices'     => array(
		'px1'   => esc_attr__( 'Small', 'minimall' ),
		'px2' => esc_attr__( 'Medium', 'minimall' ),
        'px3'  => esc_attr__( 'Large', 'minimall' ),
        'px4'  => esc_attr__( 'XLarge', 'minimall' ),
	),
) );

Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'footer_widget_breakpoints',
    'label'       => __( 'Columns Breakpoints', 'minimall' ),
    'description'       => __( 'Mobile (≈640px) | Tablet (≈832px) | Desktop (≈1024px) | Large Desktop (≈1650px)', 'minimall' ),
	'section'     => 'footer',
	'default'     => 'lg',
	'priority'    => 80,
	'choices'     => array(
		'sm'   => esc_attr__( 'Mobile', 'minimall' ),
		'md' => esc_attr__( 'Tablet', 'minimall' ),
        'lg'  => esc_attr__( 'Desktop', 'minimall' ),
        'xlg'  => esc_attr__( 'Large Desktop', 'minimall' ),
	),
) );