<?php
/**
 * Minimal Theme Customizer
 *
 * @package minimal
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function minimal_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'minimal_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'minimal_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'minimal_customize_register' );

/*
* Remove Customizer Default Options
*/
add_action( "customize_register", "minimal_remove_customizer_default_options" );
function minimal_remove_customizer_default_options( $wp_customize ) {

    //$wp_customize->remove_control("header_image");
    //$wp_customize->remove_panel("widgets");
    //$wp_customize->remove_section("colors");
    $wp_customize->remove_section("background_image");
    //$wp_customize->remove_section("static_front_page");

}


/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function minimal_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function minimal_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function minimal_customize_preview_js() {
	wp_enqueue_script( 'minimal-customizer', get_template_directory_uri() . '/includes/admin/customizer/customizer.min.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'minimal_customize_preview_js' );

/**
 * Add the theme configuration
 */
Minimal_Kirki::add_config( 'minimal', array(
	'capability'    => 'edit_theme_options',
    //'option_type'   => 'option',
    'option_type'   => 'theme_mod',
) );

/**
 * Minimal Customizer Styles
 */
add_action( 'customize_controls_print_styles', 'minimal_customizer_styles', 999 );
function minimal_customizer_styles() { ?>
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