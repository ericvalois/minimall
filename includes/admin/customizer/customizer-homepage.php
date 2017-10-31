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
	'label'       => __( 'Reorder homepage sections', 'minimal' ),
	'section'     => 'homepage_layout',
	'default'     => array(
		'services1',
		'services2',
		'blog'
	),
	'choices'     => array(
		'services1' => esc_attr__( 'Services 1', 'minimall' ),
        'services2' => esc_attr__( 'Service 2', 'minimall' ),
        //'features' => esc_attr__( 'Features', 'minimall' ),
		//'testimonials' => esc_attr__( 'Testimonials', 'minimall' ),
		'blog' => esc_attr__( 'Blog', 'minimall' ),
        'banner' => esc_attr__( 'Banner', 'minimall' ),
        //'editor' => esc_attr__( 'Editor', 'minimall' ),
	),
    'priority'    => 10,
    
) );

/**
 * 
 * Hero 
 * 
 */
Minimall_Kirki::add_section( 'homepage_hero', array(
    'title'		 => __( 'Hero', 'minimall' ),
    'panel'		 => 'homepage',
    'priority'	 => 20,
) );

Minimall_Kirki::add_field( 'minimall', array(
    'type'     => 'textarea',
    'settings' => 'home_hero_title',
    'label'    => __( 'Hero Title', 'minimall' ),
    'section'  => 'homepage_hero',
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
    'settings' => 'home_hero_desc',
    'label'    => __( 'Hero Description', 'minimall' ),
    'section'  => 'homepage_hero',
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
    'type'        => 'image',
    'settings'    => 'home_hero_img',
    'label'       => __( 'Image', 'minimall' ),
    'description' => __( 'Background image', 'minimall' ),
    'section'     => 'homepage_hero',
    'priority'    => 30,
    'output' => array(),
    'transport' => 'auto',
    
) );

Minimall_Kirki::add_field( 'minimall', array(
    'type'     => 'tpfw_link',
    'settings' => 'home_hero_main_link',
    'label'    => __( 'Main Link', 'minimall' ),
    'section'  => 'homepage_hero',
    'priority' => 40,
    /*'partial_refresh' => array(
		'main_link' => array(
			'selector'        => '.main_link',
			'render_callback' => function() {
				return minimal_get_hero_link_partial('home_hero_main_link');
			},
		),
	),*/
    
) );

Minimall_Kirki::add_field( 'minimall', array(
	'type'     => 'fontawesome',
	'settings' => 'home_hero_main_link_icon',
	'label'    => __( 'Call to action icon', 'minimall' ),
	'section'  => 'homepage_hero',
    'priority' => 45,


) );





/**
 * 
 * Service 1 
 * 
 */
Minimall_Kirki::add_section( 'homepage_service1', array(
    'title'		 => __( 'Service 1', 'minimall' ),
    'panel'		 => 'homepage',
    'priority'	 => 30,
) );

Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'toggle',
	'settings'    => 'home_service1_header',
	'label'       => __( 'Display Header', 'minimall' ),
	'section'     => 'homepage_service1',
	'default'     => '1',
	'priority'    => 10,
) );

Minimall_Kirki::add_field( 'minimall', array(
    'type'     => 'textarea',
    'settings' => 'home_service1_title',
    'label'    => __( 'Section Title', 'minimall' ),
    'section'  => 'homepage_service1',
    'priority' => 20,
    'active_callback'    => array(
        array(
            'setting'  => 'home_service1_header',
            'operator' => '==',
            'value'    => true,
        ),
    ),
    
) );

Minimall_Kirki::add_field( 'minimall', array(
    'type'     => 'textarea',
    'settings' => 'home_service1_desc',
    'label'    => __( 'Section Description', 'minimall' ),
    'section'  => 'homepage_service1',
    'priority' => 30,
    'active_callback'    => array(
        array(
            'setting'  => 'home_service1_header',
            'operator' => '==',
            'value'    => true,
        ),
    ),
    
) );

Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'radio-image',
	'settings'    => 'home_service1_layout',
	'label'       => esc_html__( 'Services Layout', 'minimall' ),
	'section'     => 'homepage_service1',
	'default'     => '3',
	'priority'    => 40,
	'choices'     => array(
		'1'   => get_template_directory_uri() . '/includes/admin/images/one-column.png',
		'2' => get_template_directory_uri() . '/includes/admin/images/two-columns.png',
        '3'  => get_template_directory_uri() . '/includes/admin/images/three-columns.png',
        '4'  => get_template_directory_uri() . '/includes/admin/images/four-columns.png',
	),
) );

Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'repeater',
	'label'       => esc_attr__( 'Services', 'minimall' ),
	'section'     => 'homepage_service1',
	'priority'    => 50,
	'row_label' => array(
		'type' => 'text',
		'value' => esc_attr__('service', 'minimall' ),
	),
	'settings'    => 'home_service1_list',
	'fields' => array(
        'title' => array(
			'type'        => 'textarea',
			'label'       => esc_attr__( 'Title', 'minimall' ),
			//'description' => esc_attr__( 'This will be the label for your link', 'minimall' ),
			'default'     => '',
        ),
        'desc' => array(
			'type'        => 'textarea',
			'label'       => esc_attr__( 'Description', 'minimall' ),
			//'description' => esc_attr__( 'This will be the label for your link', 'minimall' ),
			'default'     => '',
		),
		'link_text' => array(
			'type'        => 'text',
			'label'       => esc_attr__( 'Link Text', 'minimall' ),
			'description' => esc_attr__( 'This will be the label for your link', 'minimall' ),
			'default'     => '',
		),
		'link_url' => array(
			'type'        => 'text',
			'label'       => esc_attr__( 'Link URL', 'minimall' ),
			'description' => esc_attr__( 'http://yourlink.com', 'minimall' ),
            'default'     => '',
            'attribute' => '',
		),
	)
) );