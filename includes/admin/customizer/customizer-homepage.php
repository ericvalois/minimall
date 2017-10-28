<?php
Minimall_Kirki::add_panel( 'homepage', array(
    'priority'	 => 290,
    'title'		 => __( 'Homepage Editor', 'minimall' ),
    'description'	 => __( 'Homepage section options', 'minimall' ),
) );

Minimall_Kirki::add_section( 'homepage_layout', array(
    'title'		 => __( 'Homepage Layout', 'minimall' ),
    'panel'		 => 'homepage',
    'priority'	 => 10,
) );

/**
 * Homepage Layout Builder
 */
Minimall_Kirki::add_field( 'minimall', array(
    'type'		 => 'repeater',
    'label'		 => __( 'Home Page Sections', 'minimall' ),
    'description' => __( 'If you edit above sections, you would have to refresh the page to display your changes.', 'minimall'),
    'section'	 => 'homepage_layout',
    'priority'	 => 10,
    'settings'	 => 'homepage_section',
    'tooltip'    =>  __( 'If you edit above sections, you would have to refresh the page to display your changes.', 'minimall'),
    /*'default'     => array(
		array(
			'sections_name' => esc_attr__( 'My section name 1', 'minimall' ),
			'sections_type'  => 'hero',
        ),
        array(
			'sections_name' => esc_attr__( 'My section name 2', 'minimall' ),
			'sections_type'  => 'hero',
		),
	),*/
    'fields'	 => array(
        'sections_name' => array(
            'type'		 => 'text',
            'label'		 => __( 'Section Name', 'minimall' ),
            'default'	 => '',
        ),
        'sections_type' => array(
            'type'		 => 'select',
            'label'		 => __( 'Section Type', 'minimall' ),
            'default'	 => 'services',
            'choices'     => array(
                'hero' => esc_attr__( 'Hero', 'minimall' ),
                'services' => esc_attr__( 'Services', 'minimall' ),
            ),
        ),
    ),
    'row_label'			 => array(
        'type'	 => 'field',
        'field'	 => 'sections_name',
    ),
) );

/**
 * Build Home page panels from the homepage builder
 */
$theme_options = minimall_theme_options();
if( isset( $theme_options['homepage_section'] ) ){ $home_sections = $theme_options['homepage_section']; }

if( !empty( $home_sections ) && is_array($home_sections) ){
    foreach ($home_sections as $key => $section) {
        $args = array(
            'panel'		 => 'homepage',
            'priority'	 => 30,
        );
        
        if( !empty( $section['sections_name'] ) ){
            $args['title'] = $section['sections_name'];
        }else{
            $args['title'] = __( 'Section '.$key, 'minimall' );
        }

        $unique_id = uniqid();

        $section_name = 'homepage_content_'.$key;

        // Create The Panel Section
        Minimall_Kirki::add_section( $section_name, $args );

        // Add fields to the panel
        if( 'hero' == $section['sections_type'] ){
            minimall_home_hero_section( $section_name, $unique_id );
        }else{
            minimall_home_content_section( $section_name, $unique_id );
        }
        
    }
}

/*
* Hero Controls
*/
function minimall_home_hero_section( $section_name, $key ){
    Minimall_Kirki::add_field( 'minimall', array(
        'type'     => 'textarea',
        'settings' => 'hero_title_'.$unique_id,
        'label'    => __( 'Hero Title', 'minimall' ),
        'section'  => $section_name,
        'priority' => 10,
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
        'settings' => 'hero_description_'.$unique_id,
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
        'type'        => 'image',
        'settings'    => 'hero_image_'.$unique_id,
        'label'       => __( 'Image', 'minimall' ),
        'description' => __( 'Background image', 'minimall' ),
        'section'     => $section_name,
        'priority'    => 30,
    ) );

    Minimall_Kirki::add_field( 'minimall', array(
        'type'		 => 'repeater',
        'label'		 => __( 'Links', 'minimall' ),
        'settings'	 => 'hero_links_'.$unique_id,
        'priority'	 => 40,
        'section'	 => $section_name,
        'default'	 => array(),
        'fields'	 => array(
            'link_url' => array(
                'type'		 => 'url',
                'label'		 => __( 'Link URL', 'minimall' ),
                'default'	 => '',
            ),
            'link_label' => array(
                'type'		 => 'text',
                'label'		 => __( 'Link Label', 'minimall' ),
                'default'	 => '',
            ),
            'link_class' => array(
                'type'		 => 'text',
                'label'		 => __( 'Link Class', 'minimall' ),
                'default'	 => '',
            ),
            'link_target' => array(
                'type'		 => 'checkbox',
                'label'		 => __( 'External Link', 'minimall' ),
            ),
            'link_nofollow' => array(
                'type'		 => 'checkbox',
                'label'		 => __( 'Nofollow Link', 'minimall' ),
            ),
            
        ),
    ) );
}

/*
* Content Controls
*/
function minimall_home_content_section( $section_name, $unique_id ){
    Minimall_Kirki::add_field( 'minimall', array(
        'type'     => 'toggle',
        'settings' => 'section_header_'.$unique_id,
        'label'    => __( 'Section Header', 'minimall' ),
        'section'  => $section_name,
        'default'  => 1,
        'priority' => 10,
    ) );

    Minimall_Kirki::add_field( 'minimall', array(
        'type'     => 'textarea',
        'settings' => 'section_title_'.$unique_id,
        'label'    => __( 'Section Title', 'minimall' ),
        'section'  => $section_name,
        'priority' => 20,
        'active_callback'    => array(
            array(
                'setting'  => 'section_header_'.$unique_id,
                'operator' => '==',
                'value'    => true,
            ),
        ),
        'transport'   => 'postMessage',
        'js_vars'     => array(
            array(
                'element'   => '#section_'.$unique_id.' .title',
                'function'  => 'html',
                ),  
        ),
    ) );

    Minimall_Kirki::add_field( 'minimall', array(
        'type'     => 'textarea',
        'settings' => 'section_description_'.$unique_id,
        'label'    => __( 'Section Description', 'minimall' ),
        'section'  => $section_name,
        'priority' => 30,
        'active_callback'    => array(
            array(
                'setting'  => 'section_header_'.$unique_id,
                'operator' => '==',
                'value'    => true,
            ),
        ),
        'transport'   => 'postMessage',
        'js_vars'     => array(
            array(
                'element'   => '#section_'.$unique_id.' .content',
                'function'  => 'html',
                ),  
        ),
    ) );



    Minimall_Kirki::add_field( 'minimall', array(
        'type'        => 'color',
        'settings'    => 'background_'.$unique_id,
        'label'       => __( 'Background Color', 'minimall' ),
        'section'     => $section_name,
        'default'     => '#ffffff',
        'priority'    => 40,
        'choices'     => array(
            'alpha' => true,
        ),
    ) );
}