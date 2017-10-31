<?php
/**
 * Minimall Theme Customizer
 *
 * @package minimal
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function minimall_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'minimall_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'minimall_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'minimall_customize_register' );

/*
* Remove Customizer Default Options
*/
add_action( "customize_register", "minimall_remove_customizer_default_options" );
function minimall_remove_customizer_default_options( $wp_customize ) {

    //$wp_customize->remove_control("header_image");
    //$wp_customize->remove_panel("widgets");
    $wp_customize->remove_section("colors");
    $wp_customize->remove_section("background_image");
    //$wp_customize->remove_section("static_front_page");

}


/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function minimall_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function minimall_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function minimall_customize_preview_js() {
    wp_enqueue_script( 'minimall-customizer', get_template_directory_uri() . '/includes/admin/customizer/customizer.min.js', array( 'customize-preview' ), '20151215', true );
    
    //wp_enqueue_script( 'minimall-tpl3', get_template_directory_uri() . '/includes/admin/customizer/tpl1/libs.min.js', array( 'customize-preview' ), '20151215', true );
    //wp_enqueue_script( 'minimall-tpl1', get_template_directory_uri() . '/includes/admin/customizer/tpl1/admin_fields.min.js', array( 'customize-preview' ), '20151215', true );
    //wp_enqueue_script( 'minimall-tpl2', get_template_directory_uri() . '/includes/admin/customizer/tpl1/dependency.min.js', array( 'customize-preview' ), '20151215', true );
    //wp_enqueue_script( 'minimall-tpl4', get_template_directory_uri() . '/includes/admin/customizer/tpl1/customize-fields.min.js', array( 'customize-preview' ), '20151215', true );

    
    
}
add_action( 'customize_preview_init', 'minimall_customize_preview_js' );

/**
 * Add the theme configuration
 */
Minimall_Kirki::add_config( 'minimall', array(
	'capability'    => 'edit_theme_options',
    //'option_type'   => 'option',
    'option_type'   => 'theme_mod',
    'disable_output'=> false,
) );

/**
 * Minimall Customizer Styles
 */
add_action( 'customize_controls_print_styles', 'minimall_customizer_styles', 999 );
function minimall_customizer_styles() { ?>
	<style>
		.customize-control-kirki-radio-image img {
            width: 100px;
            padding: 0.5em;
            border: 2px dashed #ccc;
            margin: 0 10px 10px 0;
            display: block;
            transition: all 0.2s ease-in-out;
        }
        
        .customize-control-kirki-radio-image input:checked + label img{
            border: 2px dashed #666;
            background-color: #f7f7f7;
            box-shadow: 0 0 3px rgba(0,0,0,0.1);
        }
	</style>
	<?php

}

/*
* Add default theme options panel
*/
Minimall_Kirki::add_panel( 'minimall_options', array(
    'priority'	 => 300,
    'title'		 => __( 'Theme Options', 'minimall' ),
) );

function minimal_get_hero_link_partial( $link ){
    $theme_options = minimall_theme_options();

    $link_data = minimall_get_link_data( $theme_options[$link] );

    return $link_data['title'];
}


/**
 * Home page
 */
include( get_template_directory() . '/includes/admin/customizer/customizer-homepage.php' );

/**
 * Typography Controls
 */
include( get_template_directory() . '/includes/admin/customizer/customizer-typography.php' );

/**
 * Colors controls
 */
include( get_template_directory() . '/includes/admin/customizer/customizer-colors.php' );

/**
 * Footer controls
 */
include( get_template_directory() . '/includes/admin/customizer/customizer-footer.php' );

/**
 * Fontawesome Icons
 */
include( get_template_directory() . '/includes/admin/customizer/customizer-icons.php' );

/**
 * New Link Control
 */
include( get_template_directory() . '/includes/admin/customizer/minimall-link/minimall-link.php' );

