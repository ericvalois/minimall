<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Add Stylesheet section
 * 
 */
Minimall_Kirki::add_section( 'performance_stylesheet', array(
    'title'      => esc_attr__( 'Stylesheets', 'minimall' ),
    'priority'   => 10,
    'panel'		 => 'performance',
    'capability' => 'edit_theme_options',
) );

Minimall_Kirki::add_field( 'minimall', array(
    'type'        => 'checkbox',
    'settings'    => 'performance_disable_critical_css',
    'label'       => __( 'Disable Critical CSS', 'minimall' ),
    'description' => __( 'The critical CSS is automatically injected when the option "Inline and Defer CSS?" is checked inside the Autoptimize plugin.', 'minimall' ),
    'section'     => 'performance_stylesheet',
    'default'     => '0',
    'priority'    => 10,
) );

/*
* Critical CSS
*/
add_action('minimall_mobile_styles','minimall_critical_css', 10);
function minimall_critical_css(){
    if( !minimall_is_autoptimize_active() ){
        return;
    }

    $conf = autoptimizeConfig::instance();
    $autoptimize_css = $conf->get('autoptimize_css');
    $autoptimize_css_defer = $conf->get('autoptimize_css_defer');

    if( !is_admin() &&
    $autoptimize_css &&
    $autoptimize_css_defer ){
        echo '/* Critical CSS */ ';
        if( is_page_template("templates/homepage.php") ){
            include_once( "critical/home.min.css" );
        }elseif( is_archive() || is_home() || is_search() ){
            include_once( "critical/archive.min.css" );
        }elseif( is_single() ){
            include_once( "critical/single.min.css" );
        }else{
            include_once( "critical/page.min.css" );
        }
        echo '/* End Critical CSS */ ';
    }

}