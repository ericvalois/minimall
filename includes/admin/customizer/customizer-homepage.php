<?php
Minimal_Kirki::add_panel( 'homepage', array(
    'priority'	 => 10,
    'title'		 => __( 'Homepage Settings', 'minimal' ),
  'description'	 => __( 'Homepage options for Eleganto theme', 'minimal' ),
) );

Minimal_Kirki::add_section( 'homepage_layout', array(
    'title'		 => __( 'Homepage Layout', 'minimal' ),
    'panel'		 => 'homepage',
    'priority'	 => 10,
) );

/**
 * Homepage Layout Builder
 */
Minimal_Kirki::add_field( 'minimal', array(
    'type'		 => 'repeater',
    'label'		 => __( 'Home Page Sections', 'minimal' ),
    'description' => __( 'If you edit above sections, you would have to refresh the page to display your changes.', 'minimal'),
    'section'	 => 'homepage_layout',
    'priority'	 => 10,
    'settings'	 => 'homepage_section',
    'tooltip'    =>  __( 'If you edit above sections, you would have to refresh the page to display your changes.', 'minimal'),
    'default'	 => array(),
    'fields'	 => array(
        'sections_name' => array(
            'type'		 => 'text',
            'label'		 => __( 'Section Name', 'minimal' ),
            'default'	 => '',
        ),
        'sections_type' => array(
            'type'		 => 'select',
            'label'		 => __( 'Section Type', 'minimal' ),
            'default'	 => 'content',
            'choices'     => array(
                'hero' => esc_attr__( 'Hero Section', 'minimal' ),
                'content' => esc_attr__( 'Simple Content', 'minimal' ),
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
$theme_options = minimal_theme_options();
$home_sections = $theme_options['homepage_section'];
if( !empty( $home_sections ) ){
    foreach ($home_sections as $key => $section) {
        $args = array(
            'panel'		 => 'homepage',
            'priority'	 => 30,
        );
        
        if( !empty( $section['sections_name'] ) ){
            $args['title'] = $section['sections_name'];
        }else{
            $args['title'] = __( 'Section '.$key, 'minimal' );
        }

        $section_name = 'homepage_content_'.$key;

        // Create The Panel Section
        Minimal_Kirki::add_section( $section_name, $args );

        // Add fields to the panel
        if( 'hero' === $section['sections_type'] ){
            minimal_home_hero_section( $section_name, $key );
        }else{
            minimal_home_content_section( $section_name, $key );
        }
        
    }
}

/*
* Hero Controls
*/
function minimal_home_hero_section( $section_name, $key ){
    Minimal_Kirki::add_field( 'minimal', array(
        'type'     => 'textarea',
        'settings' => 'hero_title_'.$key,
        'label'    => __( 'Hero Title', 'minimal' ),
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

    Minimal_Kirki::add_field( 'minimal', array(
        'type'     => 'textarea',
        'settings' => 'hero_description_'.$key,
        'label'    => __( 'Hero Description', 'minimal' ),
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

    Kirki::add_field( 'minimal', array(
        'type'        => 'image',
        'settings'    => 'hero_image_'.$key,
        'label'       => __( 'Image', 'minimal' ),
        'description' => __( 'background image', 'minimal' ),
        'section'     => $section_name,
        'priority'    => 30,
    ) );

    Minimal_Kirki::add_field( 'minimal', array(
        'type'		 => 'repeater',
        'label'		 => __( 'Links', 'minimal' ),
        'settings'	 => 'hero_links_'.$key,
        'priority'	 => 40,
        'section'	 => $section_name,
        'default'	 => array(),
        'fields'	 => array(
            'link_url' => array(
                'type'		 => 'url',
                'label'		 => __( 'Link URL', 'minimal' ),
                'default'	 => '',
            ),
            'link_label' => array(
                'type'		 => 'text',
                'label'		 => __( 'Link Label', 'minimal' ),
                'default'	 => '',
            ),
            'link_class' => array(
                'type'		 => 'text',
                'label'		 => __( 'Link Class', 'minimal' ),
                'default'	 => '',
            ),
            'link_target' => array(
                'type'		 => 'checkbox',
                'label'		 => __( 'External Link', 'minimal' ),
            ),
            'link_nofollow' => array(
                'type'		 => 'checkbox',
                'label'		 => __( 'Nofollow Link', 'minimal' ),
            ),
            
        ),
    ) );
}

/*
* Content Controls
*/
function minimal_home_content_section( $section_name, $key ){
    Minimal_Kirki::add_field( 'minimal', array(
        'type'     => 'toggle',
        'settings' => 'section_header_'.$key,
        'label'    => __( 'Section Header', 'minimal' ),
        'section'  => 'homepage_content_'.$key,
        'default'  => 1,
        'priority' => 10,
    ) );

    Minimal_Kirki::add_field( 'minimal', array(
        'type'     => 'textarea',
        'settings' => 'section_title_'.$key,
        'label'    => __( 'Section Title', 'minimal' ),
        'section'  => $section_name,
        'priority' => 20,
        'active_callback'    => array(
            array(
                'setting'  => 'section_header_'.$key,
                'operator' => '==',
                'value'    => true,
            ),
        ),
        'transport'   => 'postMessage',
        'js_vars'     => array(
            array(
                'element'   => '#section_'.$key.' .title',
                'function'  => 'html',
                ),  
        ),
    ) );

    Minimal_Kirki::add_field( 'minimal', array(
        'type'     => 'textarea',
        'settings' => 'section_description_'.$key,
        'label'    => __( 'Section Description', 'minimal' ),
        'section'  => $section_name,
        'priority' => 30,
        'active_callback'    => array(
            array(
                'setting'  => 'section_header_'.$key,
                'operator' => '==',
                'value'    => true,
            ),
        ),
        'transport'   => 'postMessage',
        'js_vars'     => array(
            array(
                'element'   => '#section_'.$key.' .content',
                'function'  => 'html',
                ),  
        ),
    ) );



    Minimal_Kirki::add_field( 'minimal', array(
        'type'        => 'color',
        'settings'    => 'background_'.$key,
        'label'       => __( 'Background Color', 'minimal' ),
        'section'     => 'homepage_content_'.$key,
        'default'     => '#ffffff',
        'priority'    => 40,
        'choices'     => array(
            'alpha' => true,
        ),
    ) );
}