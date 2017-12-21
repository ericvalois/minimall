<?php
/*
* Create EDD Panels
*/
Minimall_Kirki::add_panel( 'edd', array(
    'title'      => esc_attr__( 'Easy Digital Download', 'minimall' ),
    'priority'   => 100,
    'panel'		 => 'ttfb_options',
    'capability' => 'edit_theme_options',
) );

Minimall_Kirki::add_section( 'edd_archive', array(
    'title'      => esc_attr__( 'Download Archive', 'minimall' ),
    'priority'   => 10,
    'panel'		 => 'edd',
    'capability' => 'edit_theme_options',
) );

Minimall_Kirki::add_section( 'edd_checkout', array(
    'title'      => esc_attr__( 'Checkout', 'minimall' ),
    'priority'   => 20,
    'panel'		 => 'edd',
    'capability' => 'edit_theme_options',
) );

Minimall_Kirki::add_section( 'edd_single', array(
    'title'      => esc_attr__( 'Download', 'minimall' ),
    'priority'   => 30,
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
    'type'        => 'radio-image',
    'settings'    => 'edd_single_layout',
    'label'       => esc_html__( 'Layout', 'minimall' ),
    'section'     => 'edd_single',
    'default'     => '6',
    'priority'    => 10,
    'choices'     => array(
        '12' => get_template_directory_uri() . '/includes/admin/images/one-column.png',
        '6' => get_template_directory_uri() . '/includes/admin/images/two-columns.png',
        '4'   => get_template_directory_uri() . '/includes/admin/images/sidebar-left.png',
        '8'  => get_template_directory_uri() . '/includes/admin/images/sidebar-right.png',
    ),
) );

if( minimall_is_metabox_active() ){
    Minimall_Kirki::add_field( 'minimall', array(
        'type'        => 'slider',
        'settings'    => 'edd_single_thumb',
        'label'       => esc_attr__( 'Thumbnails per row', 'minimall' ),
        'description' => __( 'Require the free plugin <a target="_blank" href="https://wordpress.org/plugins/meta-box/" target="_blank">Meta Box</a>', 'minimall' ),
        'section'     => 'edd_single',
        'default'     => 4,
        'choices'     => array(
            'min'  => '1',
            'max'  => '4',
            'step' => '1',
        ),
        'priority'    => 70,
    ) );

    Minimall_Kirki::add_field( 'minimall', array(
        'type'        => 'radio-buttonset',
        'settings'    => 'edd_single_thumb_size',
        'label'       => __( 'Thumbnails size', 'minimall' ),
        'section'     => 'edd_single',
        'default'     => 'thumbnail',
        'priority'    => 80,
        'choices'     => array(
            'thumbnail'   => esc_attr__( 'Thumbnail', 'minimall' ),
            'medium' => esc_attr__( 'Medium', 'minimall' ),
            'large'  => esc_attr__( 'Large', 'minimall' ),
        ),
    ) );

    Minimall_Kirki::add_field( 'minimall', array(
        'type'        => 'select',
        'settings'    => 'edd_single_thumb_type',
        'label'       => __( 'Gallery Type', 'minimall' ),
        //'description' => __( 'Read more about <a target="_blank" href="https://en.support.wordpress.com/gallery/#adding-a-gallery-or-slideshow" target="_blank">WordPress galleries</a>.', 'minimall' ),
        'section'     => 'edd_single',
        'default'     => 'thumbnail',
        'priority'    => 90,
        'multiple'    => 0,
        'choices'     => array(
            'thumbnail' => esc_attr__( 'Thumbnail', 'minimall' ),
            'rectangular' => esc_attr__( 'Rectangular', 'minimall' ),
            'square' => esc_attr__( 'Square', 'minimall' ),
            'circle' => esc_attr__( 'Circle', 'minimall' ),
            'circle' => esc_attr__( 'Slideshow', 'minimall' ),
        ),
    ) );

    Minimall_Kirki::add_field( 'minimall', array(
        'type'        => 'custom',
        'settings'    => 'edd_single_thumb_notice',
        'label'       => __( 'Read more about WordPress gallery', 'minimall' ),
        'default' => __( 'Read more about <a target="_blank" href="https://en.support.wordpress.com/gallery/#adding-a-gallery-or-slideshow" target="_blank">WordPress galleries</a>.', 'minimall' ),
        'section'     => 'edd_single',
        'priority'    => 100,
    ) );
}

/*
* EDD Checkout Controls
*/
Minimall_Kirki::add_field( 'minimall', array(
    'type'        => 'checkbox',
    'settings'    => 'edd_checkout_boxed',
    'label'       => __( 'Boxed checkout', 'minimall' ),
    'description' => __( 'Display a slimer checkout for better conversion.', 'minimall' ),
    'section'     => 'edd_checkout',
    'default'     => '0',
    'priority'    => 10,
) );

Minimall_Kirki::add_field( 'minimall', array(
    'type'        => 'textarea',
    'settings'    => 'edd_checkout_before_cart',
    'label'       => __( 'Content before cart', 'minimall' ),
    'description' => __( 'HTML and Shortcodes are autorized.', 'minimall' ),
    'section'     => 'edd_checkout',
    'default'     => '',
    'priority'    => 20,
) );

Minimall_Kirki::add_field( 'minimall', array(
    'type'        => 'textarea',
    'settings'    => 'edd_checkout_before_personal',
    'label'       => __( 'Content before personal info', 'minimall' ),
    'description' => __( 'HTML and Shortcodes are autorized.', 'minimall' ),
    'section'     => 'edd_checkout',
    'default'     => '',
    'priority'    => 30,
) );

Minimall_Kirki::add_field( 'minimall', array(
    'type'        => 'checkbox',
    'settings'    => 'edd_checkout_hide_menu',
    'label'       => __( 'Hide main menu', 'minimall' ),
    'description' => __( 'Hide main menu on checkout page.', 'minimall' ),
    'section'     => 'edd_checkout',
    'default'     => '0',
    'priority'    => 40,
) );

Minimall_Kirki::add_field( 'minimall', array(
    'type'        => 'checkbox',
    'settings'    => 'edd_checkout_hide_footer_hero',
    'label'       => __( 'Hide footer hero', 'minimall' ),
    'description' => __( 'Hide footer hero on checkout page.', 'minimall' ),
    'section'     => 'edd_checkout',
    'default'     => '0',
    'priority'    => 50,
) );

Minimall_Kirki::add_field( 'minimall', array(
    'type'        => 'checkbox',
    'settings'    => 'edd_checkout_hide_footer_widgets',
    'label'       => __( 'Hide footer widgets', 'minimall' ),
    'description' => __( 'Hide footer widget on checkout page.', 'minimall' ),
    'section'     => 'edd_checkout',
    'default'     => '0',
    'priority'    => 60,
) );