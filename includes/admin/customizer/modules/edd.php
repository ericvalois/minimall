<?php
/**
 * Add EDD options
 */
if( function_exists('is_plugin_active') && is_plugin_active('easy-digital-downloads/easy-digital-downloads.php') ):
    
    /*
    * Create EDD Panels
    */
    Minimall_Kirki::add_panel( 'edd', array(
        'title'      => esc_attr__( 'Easy Digital Download', 'minimall' ),
        'priority'   => 20,
        'panel'		 => 'minimall_options',
        'capability' => 'edit_theme_options',
    ) );

    Minimall_Kirki::add_section( 'edd_archive', array(
        'title'      => esc_attr__( 'Products List', 'minimall' ),
        'priority'   => 10,
        'panel'		 => 'edd',
        'capability' => 'edit_theme_options',
    ) );

    Minimall_Kirki::add_section( 'edd_single', array(
        'title'      => esc_attr__( 'Product Page', 'minimall' ),
        'priority'   => 10,
        'panel'		 => 'edd',
        'capability' => 'edit_theme_options',
    ) );
    
    /*
    * Create EDD Archive Controls
    */
    Minimall_Kirki::add_field( 'minimall', array(
        'type'        => 'checkbox',
        'settings'    => 'edd_hide_shop_title',
        'label'       => __( 'Hide product title', 'minimall' ),
        'description' => __( 'Hide product title on products list', 'minimall' ),
        'section'     => 'edd_archive',
        'default'     => '0',
        'priority'    => 10,
    ) );

    Minimall_Kirki::add_field( 'minimall', array(
        'type'        => 'checkbox',
        'settings'    => 'edd_hide_shop_price',
        'label'       => __( 'Hide product price', 'minimall' ),
        'description' => __( 'Hide product price on products list', 'minimall' ),
        'section'     => 'edd_archive',
        'default'     => '0',
        'priority'    => 20,
    ) );

    Minimall_Kirki::add_field( 'minimall', array(
        'type'        => 'checkbox',
        'settings'    => 'edd_hide_shop_desc',
        'label'       => __( 'Hide product description', 'minimall' ),
        'description' => __( 'Hide product description on products list', 'minimall' ),
        'section'     => 'edd_archive',
        'default'     => '0',
        'priority'    => 30,
    ) );

    Minimall_Kirki::add_field( 'minimall', array(
        'type'        => 'checkbox',
        'settings'    => 'edd_hide_shop_btn',
        'label'       => __( 'Hide product button', 'minimall' ),
        'description' => __( 'Hide product button on products list', 'minimall' ),
        'section'     => 'edd_archive',
        'default'     => '0',
        'priority'    => 40,
    ) );

    Minimall_Kirki::add_field( 'minimall', array(
        'type'        => 'checkbox',
        'settings'    => 'edd_hide_price_btn',
        'label'       => __( 'Hide price in button', 'minimall' ),
        'description' => __( 'Hide price in button on products list', 'minimall' ),
        'section'     => 'edd_archive',
        'default'     => '0',
        'priority'    => 50,
    ) );

    Minimall_Kirki::add_field( 'minimall', array(
        'type'        => 'slider',
        'settings'    => 'edd_desktop_products',
        'label'       => esc_attr__( 'Desktop products per row', 'minimall' ),
        'section'     => 'edd_archive',
        'default'     => 4,
        'choices'     => array(
            'min'  => '1',
            'max'  => '4',
            'step' => '1',
        ),
        'priority'    => 60,
    ) );

    Minimall_Kirki::add_field( 'minimall', array(
        'type'        => 'slider',
        'settings'    => 'edd_tablet_products',
        'label'       => esc_attr__( 'Tablet products per row', 'minimall' ),
        'section'     => 'edd_archive',
        'default'     => 2,
        'choices'     => array(
            'min'  => '1',
            'max'  => '4',
            'step' => '1',
        ),
        'priority'    => 70,
    ) );

    /*
    * Create EDD Single Controls
    */
    Minimall_Kirki::add_field( 'minimall', array(
        'type'        => 'checkbox',
        'settings'    => 'edd_hide_single_title',
        'label'       => __( 'Hide product title', 'minimall' ),
        'description' => __( 'Hide product title on products list', 'minimall' ),
        'section'     => 'edd_single',
        'default'     => '0',
        'priority'    => 10,
    ) );

    Minimall_Kirki::add_field( 'minimall', array(
        'type'        => 'radio-image',
        'settings'    => 'edd_single_layout',
        'label'       => esc_html__( 'Layout', 'minimall' ),
        'section'     => 'edd_single',
        'default'     => '2',
        'priority'    => 2,
        'choices'     => array(
            '1' => get_template_directory_uri() . '/includes/admin/images/one-column.png',
            '2' => get_template_directory_uri() . '/includes/admin/images/two-columns.png',
            '3'   => get_template_directory_uri() . '/includes/admin/images/sidebar-left.png',
            '4'  => get_template_directory_uri() . '/includes/admin/images/sidebar-right.png',
        ),
    ) );
endif;