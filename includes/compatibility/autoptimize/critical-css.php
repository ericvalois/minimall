<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/*
* Critical CSS
*/
add_action('minimall_mobile_styles','minimall_critical_css', 10);
function minimall_critical_css(){
    if( !minimall_is_autoptimize_active() ){
        return;
    }

    global $post;

    $conf = autoptimizeConfig::instance();
    $autoptimize_css = $conf->get('autoptimize_css');
    $autoptimize_css_defer = $conf->get('autoptimize_css_defer');

    if( !is_admin() &&
    $autoptimize_css &&
    $autoptimize_css_defer ){
        echo '/* Critical CSS */ ';
        if( is_page_template("templates/homepage.php") ){
            echo '/* Critical home */ ';
            include_once( "critical/home.min.css" );
        }elseif( is_singular('download') ){
            echo '/* Critical edd-single */ ';
            include_once( "critical/edd-single.min.css" );
        }elseif( is_page_template("templates/private-dashboard.php") ){
            echo '/* Critical Private Dashboard */ ';
            include_once( "critical/dashboard.min.css" );
        }elseif( is_post_type_archive( 'download' ) || is_tax( 'download_category' ) || is_tax( 'download_tag' ) || ( is_page() && has_shortcode( $post->post_content, 'downloads') )  ){
            echo '/* Critical edd-archive */ ';
            include_once( "critical/edd-archive.min.css" );
        }elseif( function_exists('edd_is_checkout') && edd_is_checkout() ){
            echo '/* Critical edd-checkout */ ';
            include_once( "critical/edd-checkout.min.css" );
        }elseif(  is_page_template("templates/full-width.php") ){
            echo '/* Critical full-width */ ';
            include_once( "critical/full-width.min.css" );
        }elseif(  is_page_template("templates/empty-template.php") ){
            echo '/* Critical Empty Template */ ';
            include_once( "critical/empty.min.css" );
        }elseif( is_archive() || is_home() || is_search()  ){
            echo '/* Critical archive */ ';
            include_once( "critical/archive.min.css" );
        }elseif( is_tax( 'knowledgebase_category' ) || is_tax( 'knowledgebase_tags' ) || is_singular('knowledgebase') ){
            echo '/* Critical Knowledge base */ ';
            include_once( "critical/full-width.min.css" );
        }elseif( is_single() ){
            echo '/* Critical single */ ';
            include_once( "critical/single.min.css" );
        }else{
            echo '/* Critical page */ ';
            include_once( "critical/page.min.css" );
        }
        echo '/* End Critical CSS */ ';
    }

}