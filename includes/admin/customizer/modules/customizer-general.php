<?php
/**
 * Add the Header section
 */
Minimall_Kirki::add_section( 'header', array(
	'title'      => esc_attr__( 'Header', 'minimall' ),
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