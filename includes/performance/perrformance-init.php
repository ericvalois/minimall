<?php
/*
Plugin Name: Performance Module
Plugin URI: https://github.com/time-to-first-byte/performance-module
Description: WordPress performance plugin built for TTFB speed-focused WordPress themes.
Version: 1.0
Author: Eric Valois
Author URI: https://ttfb.io/
License: GPL2

------------------------------------------------------------------------
Copyright Eric Valois

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
*/


/**
 * Create customizer Performance Module panel
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
add_action( 'customize_register', function( $wp_customize ) {
    
    $wp_customize->add_panel( 'performance_module', array(
        'priority' => 260,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __( 'Performance Module', 'performance-module' ),
        'description' => __( 'Description of what this panel does.', 'performance-module' ),
    ) );

} );

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
 * JavaScripts Optimization
 */
require 'javascripts.php';

/**
 * Options Metabox
 */
//require 'options.php';

/**
 * Stylesheets Optimization
 */
//require 'stylesheets.php';



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
