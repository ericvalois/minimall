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
		'services',
		'brands',
		'blog'
	),
	'choices'     => array(
		'service' => esc_attr__( 'Services', 'minimall' ),
        'brands' => esc_attr__( 'Brands', 'minimall' ),
        //'features' => esc_attr__( 'Features', 'minimall' ),
		//'testimonials' => esc_attr__( 'Testimonials', 'minimall' ),
		'blog' => esc_attr__( 'Blog', 'minimall' ),
        'banner' => esc_attr__( 'Banner', 'minimall' ),
        //'editor' => esc_attr__( 'Editor', 'minimall' ), // show content from a page
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
    /*'partial_refresh' => array(
		'home_hero_title' => array(
			'selector'        => '.hero_title',
            'render_callback' => 'minimal_get_homepage_hero_title', 
		),
    ),*/
    
) );

Minimall_Kirki::add_field( 'minimall', array(
    'type'     => 'editor',
    'settings' => 'home_hero_desc',
    'label'    => __( 'Hero Description', 'minimall' ),
    'section'  => 'homepage_hero',
    'priority' => 20,
    /*'partial_refresh' => array(
		'home_hero_desc' => array(
			'selector'        => '.hero_desc',
            'render_callback' => 'minimal_get_homepage_hero_title', 
		),
    ),*/
    
) );

Minimall_Kirki::add_field( 'minimall', array(
    'type'        => 'image',
    'settings'    => 'home_hero_img',
    'label'       => __( 'Image', 'minimall' ),
    'description' => __( 'Background image', 'minimall' ),
    'section'     => 'homepage_hero',
    'priority'    => 30,
    'transport' => 'postMessage',
	'js_vars'   => array(
		array(
			'element'  => '#home-hero .main_image',
			'function' => 'css',
            'property' => 'background-image',
            'suffix'   => '!important',
		),
	)
    
) );

/**
 * Homepage section helper
 */
include( get_template_directory() . '/includes/admin/customizer/modules/homepage-section-helper.php' );

/**
 * Create Services section
 */
$section_args = array(
    'title' => 'Services',
    'description' => '',
    'slug' => 'service',
    'header' => true,
    'content_layout' => true,
    'content_type' => 'minimall_homepage_content_type_list',
);
minimall_homepage_create_section( $section_args );

/**
 * Create Brands section
 */
$section_args = array(
    'title' => 'Brands',
    'description' => '',
    'slug' => 'brands',
    'header' => true,
    'content_layout' => true,
    'content_type' => 'minimall_homepage_content_type_img',
);
minimall_homepage_create_section( $section_args );

/**
 * Create Blog section
 */
$section_args = array(
    'title' => 'Blog',
    'description' => '',
    'slug' => 'blog',
    'header' => true,
    'content_layout' => true,
    'content_type' => 'minimall_homepage_content_type_blog',
);
minimall_homepage_create_section( $section_args );

