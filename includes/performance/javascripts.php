<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Add javascript optimiszation options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
add_action( 'customize_register', function( $wp_customize ) {
    
    $wp_customize->add_section( 'javascript', array(
        'priority' => 10,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __( 'JavaScript', 'performance-module' ),
        'description' => '',
        'panel' => 'performance_module',
    ) );
    
    $wp_customize->add_setting( 'active_js', array(
        'default' => '',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => '',
        'sanitize_callback' => 'esc_url',
    ) );
    
    $wp_customize->add_control( 'active_js', array(
        'type' => 'checkbox',
        'priority' => 10,
        'section' => 'javascript',
        'label' => __( 'Activate JavaScript Optimization', 'performance-module' ),
        'description' => __( 'By enabling this option, you will improve the loading time of your website.', 'performance-module' ),
    ) );      
    
    
    $wp_customize->add_setting( 'active_js_notice', array() );
    $wp_customize->add_control( new Performance_Module__Custom_Content( $wp_customize, 'active_js_notice', array(
        'section' => 'javascript',
        'priority' => 20,
        'label' => __( 'Warning!', 'performance-module' ),
        'content' => __( '<p>In the case of any display errors, we recommend disabling this option.</p><p>If you want to know more about Removing Render-Blocking JavaScript, please visit <a target="_blank" href="https://developers.google.com/speed/docs/insights/BlockingJS">Google Developers page</a>.</p>', 'performance-module' ) . '</p>',
        //'description' => __( 'Optional: Example Description.', 'performance-module' ),
    ) ) );

} );

/*
* Defer scripts when it's possible
*/
add_action( 'wp_print_scripts', 'performance_module_defer_scripts' );
add_action( 'wp_footer', 'performance_module_defer_scripts' );
function performance_module_defer_scripts() {
    $on_post_js_optimization = performance_module_is_stylesheets_optimization_disabled();
    $theme_js_optimization = get_option('perf_module_js_optimization', false);

    if( !$on_post_js_optimization && !$theme_js_optimization && !is_admin() ){
        $enqueued_scripts = performance_module_get_enqueued_scripts();
        $to_defer = array();

        if( !empty( $enqueued_scripts ) ){
            foreach ($enqueued_scripts as $key => $script) {
                
                // If no dependencies
                if( empty( $script->deps ) ){
                    wp_dequeue_script( $script->handle );
                    $to_defer[] = $script->src;
                }
            }
        }

        add_action( 'wp_footer', function() use( $to_defer ) {
            foreach( $to_defer as $key => $script ): 
                echo '<script type="text/javascript" defer src="'.$script.'"></script>' . PHP_EOL;
            endforeach; 
            
        }, 20 );
    }
}