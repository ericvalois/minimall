<?php
/**
 * Add the Header section
 */
Minimall_Kirki::add_section( 'general', array(
	'title'      => esc_attr__( 'General', 'minimall' ),
    'priority'   => 30,
    'panel'		 => 'minimall_options',
	'capability' => 'edit_theme_options',
) );

Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'image',
	'settings'    => 'default_hero_img',
	'label'       => __( 'Default Hero Image', 'minimall' ),
	'description' => __( 'Default hero image display in the header of posts and pages.', 'minimall' ),
	//'help'        => __( 'This is some extra help text.', 'minimall' ),
	'section'     => 'general',
	//'default'     => '',
	'priority'    => 10,
) );

Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'toggle',
	'settings'    => 'activate_social_share',
	'label'       => __( 'Activate social share', 'minimall' ),
	'description' => __( 'Activate social share on the entire site.', 'minimall' ),
	'section'     => 'general',
	'default'     => '1',
	'priority'    => 20,
) );

Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'text',
	'settings'    => 'social_share_label',
	'label'       => __( 'Social share label', 'minimall' ),
	'section'     => 'general',
	'default'     => __( 'Share this', 'minimall' ),
    'priority'    => 30,
    'active_callback'    => array(
        array(
            'setting'  => 'activate_social_share',
            'operator' => '==',
            'value'    => '1',
        ),
    ),
) );

Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'multicheck',
	'settings'    => 'social_share',
	'label'       => __( 'Hide social share', 'minimall' ),
	'description' => __( 'Hide social share on the entire site.', 'minimall' ),
    'section'     => 'general',
    'default'     => array('facebook', 'twitter', 'google', 'linkedin', 'pinterest'),
	'choices'     => array(
		'facebook' => esc_attr__( 'Facebook', 'minimall' ),
		'twitter' => esc_attr__( 'Twitter', 'minimall' ),
		'google' => esc_attr__( 'Google', 'minimall' ),
		'linkedin' => esc_attr__( 'Linkedin', 'minimall' ),
		'pinterest' => esc_attr__( 'Pinterest', 'minimall' ),
	),
    'priority'    => 40,
    'active_callback'    => array(
        array(
            'setting'  => 'activate_social_share',
            'operator' => '==',
            'value'    => '1',
        ),
    ),
) );