<?php
/**
 * Add the Blog Posts panel
 */
Minimall_Kirki::add_section( 'posts', array(
	'title'      => esc_attr__( 'Posts', 'minimall' ),
    'priority'   => 70,
    'panel'		 => 'ttfb_options',
	'capability' => 'edit_theme_options',
) );

Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'checkbox',
	'settings'    => 'hide_post_avatar',
    'label'       => __( 'Hide Author Avatar', 'minimall' ),
    'description' => __( 'Hide post author avatar.', 'minimall' ),
	'section'     => 'posts',
	'default'     => '0',
	'priority'    => 10,
) );

Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'checkbox',
	'settings'    => 'hide_post_metas',
    'label'       => __( 'Hide Post Metas', 'minimall' ),
    'description' => __( 'Hide post date and author link.', 'minimall' ),
	'section'     => 'posts',
	'default'     => '0',
	'priority'    => 20,
) );

Minimall_Kirki::add_field( 'minimall', array(
	'type'        => 'checkbox',
	'settings'    => 'hide_post_cat',
    'label'       => __( 'Hide Categories and Tags', 'minimall' ),
    'description' => __( 'Hide categories and tags from posts footer.', 'minimall' ),
	'section'     => 'posts',
	'default'     => '0',
	'priority'    => 30,
) );