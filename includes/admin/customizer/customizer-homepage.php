<?php
Minimall_Kirki::add_panel( 'homepage', array(
    'priority'	 => 290,
    'title'		 => __( 'Homepage Editor', 'minimall' ),
    'description'	 => __( 'Homepage section options', 'minimall' ),
) );

/**
 * Homepage Layout
 */
Minimall_Kirki::add_section( 'homepage_layout', array(
    'title'		 => __( 'Homepage Layout', 'minimall' ),
    'panel'		 => 'homepage',
    'priority'	 => 10,
) );

Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'sortable',
	'settings'    => 'homepage_layout',
	'label'       => __( 'Reorder homepage sections', 'my_textdomain' ),
	'section'     => 'homepage_layout',
	'default'     => array(
		'services',
		'brands',
		'features'
	),
	'choices'     => array(
		'services' => esc_attr__( 'Services', 'minimall' ),
        'brands' => esc_attr__( 'Brands', 'minimall' ),
        'features' => esc_attr__( 'Features', 'minimall' ),
		'testimonials' => esc_attr__( 'Testimonials', 'minimall' ),
		'blog' => esc_attr__( 'Blog', 'minimall' ),
		'banner' => esc_attr__( 'Banner', 'minimall' ),
	),
	'priority'    => 10,
) );

/**
 * Hero 
 */
Minimall_Kirki::add_section( 'homepage_hero', array(
    'title'		 => __( 'Homepage Hero', 'minimall' ),
    'panel'		 => 'homepage',
    'priority'	 => 20,
) );

Minimall_Kirki::add_field( 'minimall', array(
    'type'     => 'textarea',
    'settings' => 'hero_title',
    'label'    => __( 'Hero Title', 'minimall' ),
    'section'  => $section_name,
    'priority' => 10,
    /*'active_callback'    => array(
        array(
            'setting'  => 'hero_section',
            'operator' => '==',
            'value'    => true,
        ),
    ),*/
    'transport'   => 'postMessage',
    'js_vars'     => array(
        array(
            'element'   => '#home-hero .title',
            'function'  => 'html',
            ),  
    ),
) );

Minimall_Kirki::add_field( 'minimall', array(
    'type'     => 'textarea',
    'settings' => 'hero_description',
    'label'    => __( 'Hero Description', 'minimall' ),
    'section'  => $section_name,
    'priority' => 20,
    'transport'   => 'postMessage',
    'js_vars'     => array(
        array(
            'element'   => '#home-hero .content',
            'function'  => 'html',
            ),  
    ),
) );

Minimall_Kirki::add_field( 'minimall', array(
    'type'        => 'background',
    'settings'    => 'hero_image',
    'label'       => __( 'Image', 'minimall' ),
    'description' => __( 'Background image', 'minimall' ),
    'section'     => $section_name,
    'priority'    => 30,
) );

    

