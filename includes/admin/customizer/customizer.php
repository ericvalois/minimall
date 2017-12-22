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

/**
 * Add the theme configuration
 */
Minimall_Kirki::add_config( 'minimall', array(
	'capability'    => 'edit_theme_options',
    //'option_type'   => 'option',
    'option_type'   => 'theme_mod',
    'disable_output'=> false,
) );

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
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
add_action( 'customize_preview_init', 'minimall_customize_preview_js' );
function minimall_customize_preview_js() {
    wp_enqueue_script( 'minimall-customizer', get_template_directory_uri() . '/includes/admin/customizer/customizer.min.js', array( 'customize-preview' ), '20151215', true );  
}

/**
 * Create new notice control
 */
add_action( 'customize_register', function( $wp_customize ) {
    
    class Kirki_Controls_Minimall_Notice_Control extends WP_Customize_Control {
        public $type = 'minimall_notice';
        public function render_content() { 
        ?>
            <h2 style="margin-bottom: 5px; font-size: 20px;"><?php echo esc_html( $this->label ); ?></h2>
            <?php if( !empty( $this->description ) ): ?>
                <span><?php echo esc_html( $this->description ); ?></span>
            <?php endif; ?>
            <hr>
        <?php
        }
    }
    
    add_filter( 'kirki/control_types', function( $controls ) {
        $controls['minimall_notice'] = 'Kirki_Controls_Minimall_Notice_Control';
        return $controls;
    } );

} );

/**
 * Minimall Customizer Styles
 */
add_action( 'customize_controls_print_styles', 'minimall_customizer_styles', 999 );
function minimall_customizer_styles() { ?>
	<style>
        .customize-control-kirki-radio-image img {
            width: auto;
            display: block;
            border: none !important;
            box-shadow: none !important;
        }

        .customize-control-kirki-radio-image .image label {
            padding: 1%;
            border: 2px dashed #ccc;
            margin: 0 1% 1% 0;
            transition: all 0.2s ease-in-out;
            width: 20%;
        }
        
        .customize-control-kirki-radio-image input:checked + label{
            border: 2px dashed #666;
            background-color: #f7f7f7;
        }

        .customize-control-kirki-radio-image .image{ display: flex; }

        li#accordion-panel-ttfb_options > h3.accordion-section-title:before {
            content: "\f108";
            font-family: dashicons;
            padding: 0 3px 0 0;
            vertical-align: middle;
            font-size: 22px;
            line-height: 1;
        }

        li#accordion-panel-homepage > h3.accordion-section-title:before {
            content: "\f102";
            font-family: dashicons;
            padding: 0 3px 0 0;
            vertical-align: middle;
            font-size: 22px;
            line-height: 1;
        }

        .wp-full-overlay-sidebar { width: 400px } .wp-full-overlay.expanded { margin-left: 400px }
        @media ( min-width: 1900px ){ .wp-full-overlay-sidebar { width: 500px } .wp-full-overlay.expanded { margin-left: 500px } }
	</style>
	<?php

}

/*
* Add default theme options panel
*/
Minimall_Kirki::add_panel( 'ttfb_options', array(
    'priority'	 => 300,
    'title'		 => __( 'Theme Options', 'minimall' ),
) );


/**
 * Home page
 */
include( get_template_directory() . '/includes/admin/customizer/modules/customizer-homepage.php' );

/**
 * Typography Controls
 */
include( get_template_directory() . '/includes/admin/customizer/modules/customizer-typography.php' );

/**
 * Colors controls
 */
include( get_template_directory() . '/includes/admin/customizer/modules/customizer-colors.php' );

/**
 * General controls
 */
include( get_template_directory() . '/includes/admin/customizer/modules/customizer-general.php' );

/**
 * Header image controls
 */
include( get_template_directory() . '/includes/admin/customizer/modules/customizer-header.php' );

/**
 * Footer controls
 */
include( get_template_directory() . '/includes/admin/customizer/modules/customizer-footer.php' );

/**
 * Blog posts controls
 */
include( get_template_directory() . '/includes/admin/customizer/modules/customizer-posts.php' );

/**
 * Private Dashboard Controls
 */
include( get_template_directory() . '/includes/admin/customizer/modules/private-dashboard.php' );