<?php
/*
* title @string 
* description @string
* slug @string
* header bool
* content_type @string
*/
function minimall_homepage_create_section( $args ){
    Minimall_Kirki::add_section( 'homepage_'.$args['slug'], array(
        'title'		 => __( $args['title'], 'minimall' ),
        'panel'		 => 'homepage',
        'description'    => $args['description'],
        'priority'	 => 30,
    ) );
    
    Minimall_Kirki::add_field( 'minimall', array(
        'type'     => 'minimall_notice',
        'settings' => 'home_'.$args['slug'].'_header_notice',
        'label'    => __( 'Section Header', 'minimall' ),
        'section'  => 'homepage_'.$args['slug'],
        'priority' => 9,
    ) );
    
    if( true === $args['header'] ){

        Minimall_Kirki::add_field( 'minimall', array(
            'type'        => 'toggle',
            'settings'    => 'home_'.$args['slug'].'_header',
            'label'       => __( 'Display Header', 'minimall' ),
            'section'     => 'homepage_'.$args['slug'],
            'default'     => '0',
            'priority'    => 10,
        ) );
        
        Minimall_Kirki::add_field( 'minimall', array(
            'type'     => 'textarea',
            'settings' => 'home_'.$args['slug'].'_title',
            'label'    => __( 'Section Title', 'minimall' ),
            'section'  => 'homepage_'.$args['slug'],
            'priority' => 20,
            'active_callback'    => array(
                array(
                    'setting'  => 'home_'.$args['slug'].'_header',
                    'operator' => '==',
                    'value'    => true,
                ),
            ),
            
        ) );
        
        Minimall_Kirki::add_field( 'minimall', array(
            'type'     => 'editor',
            'settings' => 'home_'.$args['slug'].'_desc',
            'label'    => __( 'Section Description', 'minimall' ),
            'section'  => 'homepage_'.$args['slug'],
            'priority' => 30,
            'active_callback'    => array(
                array(
                    'setting'  => 'home_'.$args['slug'].'_header',
                    'operator' => '==',
                    'value'    => true,
                ),
            ),
            
        ) );

    }
    
    Minimall_Kirki::add_field( 'minimall', array(
        'type'     => 'minimall_notice',
        'settings' => 'home_'.$args['slug'].'_style_notice',
        'label'    => __( 'Section  Style', 'minimall' ),
        'description'    => __( 'Adding an image will automatically display white text and a dark background.', 'minimall' ),
        'section'  => 'homepage_'.$args['slug'],
        'priority' => 60,
    ) );
    
    Minimall_Kirki::add_field( 'minimall', array(
        'type'        => 'image',
        'settings'    => 'home_'.$args['slug'].'_img',
        'label'       => __( 'Background', 'minimall' ),
        'description'       => __( 'Section background image', 'minimall' ),
        'section'     => 'homepage_'.$args['slug'],
        'priority'    => 80,
    ) );

    $args['content_type']( $args );

}

/*
* Content type : Content list
*/
function minimall_homepage_content_type_list( $section_args ){

    Minimall_Kirki::add_field( 'minimall', array(
        'type'     => 'minimall_notice',
        'settings' => 'home_'.$section_args['slug'].'_layout_notice',
        'label'    => $section_args['title'] . esc_html__(' List', 'minimal'),
        'section'  => 'homepage_'.$section_args['slug'],
        'priority' => 39,
    ) );
    
    Minimall_Kirki::add_field( 'minimall', array(
        'type'        => 'radio-image',
        'settings'    => 'home_'.$section_args['slug'].'_layout',
        'label'       => $section_args['title'] . esc_html__( ' Layout', 'minimall' ),
        'section'     => 'homepage_'.$section_args['slug'],
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
        'label'       => $section_args['title'],
        'section'     => 'homepage_'.$section_args['slug'],
        'priority'    => 50,
        'row_label' => array(
            'type' => 'text',
            'value' => $section_args['slug'],
        ),
        'settings'    => 'home_'.$section_args['slug'].'_list',
        'fields' => array(
            'title' => array(
                'type'        => 'textarea',
                'label'       => esc_attr__( 'Title', 'minimall' ),
                'default'     => '',
            ),
            'desc' => array(
                'type'        => 'textarea',
                'label'       => esc_attr__( 'Description', 'minimall' ),
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
        ),
    ) );
    
}

/*
* Content type : Content image
*/
function minimall_homepage_content_type_img( $section_args ){
    
    Minimall_Kirki::add_field( 'minimall', array(
        'type'     => 'minimall_notice',
        'settings' => 'home_'.$section_args['slug'].'_layout_notice',
        'label'    => $section_args['title'] . esc_html__(' List', 'minimal'),
        'section'  => 'homepage_'.$section_args['slug'],
        'priority' => 39,
    ) );
    
    Minimall_Kirki::add_field( 'minimall', array(
        'type'        => 'radio-image',
        'settings'    => 'home_'.$section_args['slug'].'_layout',
        'label'       => $section_args['title'] . esc_html__( ' Layout', 'minimall' ),
        'section'     => 'homepage_'.$section_args['slug'],
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
        'label'       => $section_args['title'],
        'section'     => 'homepage_'.$section_args['slug'],
        'priority'    => 50,
        'row_label' => array(
            'type' => 'text',
            'value' => $section_args['slug'],
        ),
        'settings'    => 'home_'.$section_args['slug'].'_list',
        'fields' => array(
            'image' => array(
                'type'        => 'image',
                'label'       => esc_attr__( 'Image', 'minimall' ),
                'default'     => '',
            ),
            'link_url' => array(
                'type'        => 'text',
                'label'       => esc_attr__( 'Link URL', 'minimall' ),
                'description' => esc_attr__( 'http://yourlink.com', 'minimall' ),
                'default'     => '',
                'attribute' => '',
            ),
        ),
    ) );
    
}

/*
* Content type : Content blog
*/
function minimall_homepage_content_type_blog( $section_args ){
    
    Minimall_Kirki::add_field( 'minimall', array(
        'type'     => 'minimall_notice',
        'settings' => 'home_'.$section_args['slug'].'_layout_notice',
        'label'    => $section_args['title'] . esc_html__(' Posts', 'minimal'),
        'section'  => 'homepage_'.$section_args['slug'],
        'priority' => 39,
    ) );
    
    Minimall_Kirki::add_field( 'minimall', array(
        'type'        => 'radio-image',
        'settings'    => 'home_'.$section_args['slug'].'_layout',
        'label'       => $section_args['title'] . esc_html__( ' Layout', 'minimall' ),
        'section'     => 'homepage_'.$section_args['slug'],
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
        'type'        => 'slider',
        'settings'    => 'home_'.$section_args['slug'].'_quantity',
        'label'       => esc_attr__( 'Number of posts', 'minimall' ),
        'section'     => 'homepage_'.$section_args['slug'],
        'default'     => 12,
        'choices'     => array(
            'min'  => '1',
            'max'  => '12',
            'step' => '1',
        ),
    ) );

    Minimall_Kirki::add_field( 'minimall', array(
        'type'        => 'checkbox',
        'settings'    => 'home_'.$section_args['slug'].'_thumb',
        'label'       => __( 'Display post thumbnails', 'minimall' ),
        'section'     => 'homepage_'.$section_args['slug'],
        'default'     => '1',
        'priority'    => 42,
    ) );
    
}