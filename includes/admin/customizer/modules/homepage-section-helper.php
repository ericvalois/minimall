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
        'label'    => __( 'Style Section', 'minimall' ),
        //'description'    => __( 'Adding an image will automatically display white text and a dark background.', 'minimall' ),
        'section'  => 'homepage_'.$args['slug'],
        'priority' => 60,
    ) );

    Minimall_Kirki::add_field( 'minimall', array(
        'type'        => 'radio-buttonset',
        'settings'    => 'home_'.$args['slug'].'_color',
        'label'       => __( 'Text color', 'minimall' ),
        'section'  => 'homepage_'.$args['slug'],
        'default'     => 'black',
        'priority'    => 70,
        'choices'     => array(
            'black'   => esc_attr__( 'Black', 'minimall' ),
            'white' => esc_attr__( 'White', 'minimall' ),
        ),
    ) );

    Minimall_Kirki::add_field( 'minimall', array(
        'type'        => 'background',
        'settings'    => 'home_'.$args['slug'].'_setting',
        'label'       => esc_attr__( 'Background Control', 'minimall' ),
        'description' => esc_attr__( 'Background conrols are pretty complex - but extremely useful if properly used.', 'minimall' ),
        'section'     => 'homepage_'.$args['slug'],
        'priority'    => 90,
        'default'     => array(
            'background-color'      => '#fff',
            'background-image'      => '',
            'background-repeat'     => 'no-repeat',
            'background-position'   => 'center center',
            'background-size'       => 'cover',
            'background-attachment' => 'scroll',
        ),
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
        'settings'    => 'home_'.$section_args['slug'].'_layout_desktop',
        'label'       => $section_args['title'] . esc_html__( ' layout desktop', 'minimall' ),
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
        'type'        => 'radio-image',
        'settings'    => 'home_'.$section_args['slug'].'_layout_tablet',
        'label'       => $section_args['title'] . esc_html__( ' layout tablet', 'minimall' ),
        'section'     => 'homepage_'.$section_args['slug'],
        'default'     => '2',
        'priority'    => 45,
        'choices'     => array(
            '1'   => get_template_directory_uri() . '/includes/admin/images/one-column.png',
            '2' => get_template_directory_uri() . '/includes/admin/images/two-columns.png',
            '3'  => get_template_directory_uri() . '/includes/admin/images/three-columns.png',
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
        'type'        => 'slider',
        'settings'    => 'home_'.$section_args['slug'].'_quantity',
        'label'       => esc_attr__( 'Posts number', 'minimall' ),
        'section'     => 'homepage_'.$section_args['slug'],
        'default'     => 12,
        'priority'    => 40,
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

    Minimall_Kirki::add_field( 'minimall', array(
        'type'        => 'radio-image',
        'settings'    => 'home_'.$section_args['slug'].'_layout_desktop',
        'label'       => $section_args['title'] . esc_html__( ' layout desktop', 'minimall' ),
        'section'     => 'homepage_'.$section_args['slug'],
        'default'     => '3',
        'priority'    => 45,
        'choices'     => array(
            '1'   => get_template_directory_uri() . '/includes/admin/images/one-column.png',
            '2' => get_template_directory_uri() . '/includes/admin/images/two-columns.png',
            '3'  => get_template_directory_uri() . '/includes/admin/images/three-columns.png',
            '4'  => get_template_directory_uri() . '/includes/admin/images/four-columns.png',
        ),
    ) );

    Minimall_Kirki::add_field( 'minimall', array(
        'type'        => 'radio-image',
        'settings'    => 'home_'.$section_args['slug'].'_layout_tablet',
        'label'       => $section_args['title'] . esc_html__( ' layout tablet', 'minimall' ),
        'section'     => 'homepage_'.$section_args['slug'],
        'default'     => '2',
        'priority'    => 50,
        'choices'     => array(
            '1'   => get_template_directory_uri() . '/includes/admin/images/one-column.png',
            '2' => get_template_directory_uri() . '/includes/admin/images/two-columns.png',
            '3'  => get_template_directory_uri() . '/includes/admin/images/three-columns.png',
        ),
    ) );
    
}

/*
* Content type : Content Features
*/
function minimall_homepage_content_type_features( $section_args ){
    
    Minimall_Kirki::add_field( 'minimall', array(
        'type'     => 'minimall_notice',
        'settings' => 'home_'.$section_args['slug'].'_layout_notice',
        'label'    => $section_args['title'],
        'section'  => 'homepage_'.$section_args['slug'],
        'priority' => 39,
    ) );
    
    Minimall_Kirki::add_field( 'minimall', array(
        'type'        => 'radio-image',
        'settings'    => 'home_'.$section_args['slug'].'_layout_desktop',
        'label'       => $section_args['title'] . esc_html__( ' Layout Desktop', 'minimall' ),
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
        'type'        => 'radio-image',
        'settings'    => 'home_'.$section_args['slug'].'_layout_tablet',
        'label'       => $section_args['title'] . esc_html__( ' Layout Tablet', 'minimall' ),
        'section'     => 'homepage_'.$section_args['slug'],
        'default'     => '2',
        'priority'    => 45,
        'choices'     => array(
            '1'   => get_template_directory_uri() . '/includes/admin/images/one-column.png',
            '2' => get_template_directory_uri() . '/includes/admin/images/two-columns.png',
            '3'  => get_template_directory_uri() . '/includes/admin/images/three-columns.png',
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
        'settings'    => 'home_'.$section_args['slug'].'_features_list',
        'fields' => array(
            'icon' => array(
                'type'        => 'textarea',
                'label'       => esc_attr__( 'Icon', 'minimall' ),
                'default'     => '',
            ),
            'title' => array(
                'type'        => 'text',
                'label'       => esc_attr__( 'Title', 'minimall' ),
                'default'     => '',
            ),
            'desc' => array(
                'type'        => 'textarea',
                'label'       => esc_attr__( 'Description', 'minimall' ),
                'default'     => '',
            ),
            'link_label' => array(
                'type'        => 'text',
                'label'       => esc_attr__( 'Link Label', 'minimall' ),
                'default'     => '',
            ),
            'link_url' => array(
                'type'        => 'text',
                'label'       => esc_attr__( 'Link URL', 'minimall' ),
                'default'     => '',
            ),
        ),
    ) ); 
}

/*
* Content type : Page
*/
function minimall_homepage_content_type_page( $section_args ){
    
    Minimall_Kirki::add_field( 'minimall', array(
        'type'     => 'minimall_notice',
        'settings' => 'homepage_'.$section_args['slug'],
        'label'    => esc_attr__( 'Section Content', 'minimall' ),
        'section'  => 'homepage_'.$section_args['slug'],
        'priority' => 39,
    ) );

    Minimall_Kirki::add_field( 'minimall', array(
        'type'        => 'dropdown-pages',
        'section'     => 'homepage_'.$section_args['slug'],
        'label'       => esc_attr__( 'Page Content', 'minimall' ),
        'settings'    => 'home_'.$section_args['slug'].'_page',
        'priority'    => 40,
    ) );
    
}

/*
* Content type : Free content
*/
function minimall_homepage_content_type_free( $section_args ){
    
    Minimall_Kirki::add_field( 'minimall', array(
        'type'     => 'minimall_notice',
        'settings' => 'homepage_'.$section_args['slug'],
        'label'    => esc_attr__( 'Section Content', 'minimall' ),
        'section'  => 'homepage_'.$section_args['slug'],
        'priority' => 39,
    ) );

    Minimall_Kirki::add_field( 'minimall', array(
        'type'        => 'editor',
        'section'     => 'homepage_'.$section_args['slug'],
        'label'       => esc_attr__( 'Free Content', 'minimall' ),
        'settings'    => 'home_'.$section_args['slug'].'_free',
        'priority'    => 40,
    ) );
    
}