<?php
/**
 * Create customizer Performance Module panel
 */
Minimall_Kirki::add_panel( 'performance', array(
    'title'      => esc_attr__( 'Performance', 'minimall' ),
    'priority'   => 260,
    'panel'		 => 'minimall_options',
    'capability' => 'edit_theme_options',
) );

/**
 * Customizer styles 
 *
 */
add_action( 'customize_controls_print_styles', 'performance_module_customizer_styles', 999 );
function performance_module_customizer_styles() { ?>
	<style>
        li#accordion-panel-performance_module > h3.accordion-section-title:before {
            content: "\f226";
            font-family: dashicons;
            padding: 0 3px 0 0;
            vertical-align: middle;
            font-size: 22px;
            line-height: 1;
        }
	</style>
	<?php
}

/**
 * Helper functions
 */
require 'helper.php';

/**
 * Custom Controls
 */
require 'controls.php';

/**
 * Stylesheets Optimization
 */
require 'stylesheets.php';

/**
 * JavaScripts Optimization
 */
//require 'javascripts.php';

/**
 * Options Metabox
 */
//require 'options.php';





/**
 * Lazy Load for image and iframe
 */
//require 'lazyload.php';

/**
 * Preload / Push module
 */
//require 'preload.php';

/**
 * WordPress cleanup
 */
//require 'clean.php';
