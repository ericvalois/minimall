<?php
/**
 * Helper functions
 */
 require 'helper.php';

/**
 * Lazy Load
 */
require 'lazyload.php';

/**
 * WordPress cleanup
 */
require 'clean.php';

/*
* Critical CSS
*/
add_action('minimall_mobile_styles','minimall_critical_css', 5);
function minimall_critical_css() {
    $page_options = minimall_page_options();
    $perf_options = minimall_perf_options();

    if( !$page_options['disable_css'] && $perf_options['activate_css'] && !is_admin() ){

        if( is_page_template("templates/landing-page.php") ){
            echo '/* Critical CSS - landingpage.min.css */';
            include_once( "critical/landingpage.min.css" );
        }elseif( is_page_template("template-docs.php") ){
            echo '/* Critical CSS - doc.min.css */';
            include_once( "critical/doc.min.css" );
        }elseif( is_singular('knowledgebase') ){
            echo '/* Critical CSS - doc-single.min.css */';
            include_once( "critical/doc-single.min.css" );
        }elseif( is_archive() || is_home() || is_search() ){
            echo '/* Critical CSS - archive.min.css */';
            include_once( "critical/archive.min.css" );
        }elseif( is_singular( 'download' ) ){
            echo '/* Critical CSS - download.min.css */';
            include_once( "critical/download.min.css" );
        }elseif( is_single() ){
            echo '/* Critical CSS - single.min.css */';
            include_once( "critical/single.min.css" );
        }elseif( is_404() ){
            echo '/* Critical CSS - 404.min.css */';
            include_once( "critical/404.min.css" );
        }else{
            echo '/* Critical CSS - page.min.css */';
            include_once( "critical/page.min.css" );
        }

        echo '/* End Critical CSS */ ';
    }

}
 
 /*
 * Defer scripts when it's possible
 */
 add_action( 'wp_print_scripts', 'minimall_defer_scripts' );
 add_action( 'wp_footer', 'minimall_defer_scripts' );
 
 function minimall_defer_scripts() {

    $page_options = minimall_page_options();
    $minimall_options = minimall_perf_options();

    if( !$page_options['disable_js'] && !empty( $minimall_options['activate_js'] ) && !is_admin() ){
        $enqueued_scripts = minimall_get_enqueued_scripts();
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
 
 /*
 * Async all stylsheets with loadcss.js
 */
 add_action('wp_print_styles', function() {
    if ( ! doing_action( 'wp_head' ) ) { // ensure we are on head
    return;
    }

    // Variables
    global $wp_scripts, $wp_styles;
    $exluded_styles = array("admin-bar");
    $queued_styles  = $wp_styles->queue;
    $page_options = minimall_page_options();
    $minimall_options = minimall_perf_options();

    // Styles
    if( !empty( $queued_styles ) && !$page_options['disable_css'] && !empty( $minimall_options['activate_css'] ) && !is_admin() ){
        foreach ($wp_styles->queue as $key => $element) {
            if ( !in_array( $element, $exluded_styles ) ) {
                unset( $wp_styles->queue[$key] );
            }
        }
    }
 
    add_action( 'wp_footer', function() use( $queued_styles, $exluded_styles, $page_options, $minimall_options ) {
       
        global $wp_styles;
        
        // Styles
        if( !empty( $queued_styles ) && !$page_options['disable_css'] && !empty( $minimall_options['activate_css'] ) && !is_admin() ){
        ?>
            <script>
                /*! loadCSS. [c]2017 Filament Group, Inc. MIT License */
                !function(a){"use strict";var b=function(b,c,d){function e(a){return h.body?a():void setTimeout(function(){e(a)})}function f(){i.addEventListener&&i.removeEventListener("load",f),i.media=d||"all"}var g,h=a.document,i=h.createElement("link");if(c)g=c;else{var j=(h.body||h.getElementsByTagName("head")[0]).childNodes;g=j[j.length-1]}var k=h.styleSheets;i.rel="stylesheet",i.href=b,i.media="only x",e(function(){g.parentNode.insertBefore(i,c?g:g.nextSibling)});var l=function(a){for(var b=i.href,c=k.length;c--;)if(k[c].href===b)return a();setTimeout(function(){l(a)})};return i.addEventListener&&i.addEventListener("load",f),i.onloadcssdefined=l,l(f),i};"undefined"!=typeof exports?exports.loadCSS=b:a.loadCSS=b}("undefined"!=typeof global?global:this);
                /*! Load stylesheet async */
                <?php foreach( $queued_styles as $key => $stylesheet ): ?>
                    <?php if ( !in_array( $stylesheet, $exluded_styles ) && isset( $wp_styles->registered[$stylesheet]->src ) ): ?> 
                        loadCSS( "<?php echo $wp_styles->registered[$stylesheet]->src; ?>" );
                    <?php endif; ?> 
                <?php endforeach; ?>

            </script>
            <script></script><!-- Fix IE and Edge bug with loadcss -->
        <?php
        }
 
    }, 10 );
 
}, 0);

/*
* Preload
*/
add_action( 'minimall_head_open', 'minimall_preload' );
function minimall_preload() {
    
    $perf_options = minimall_perf_options();

    if( $perf_options['active_preload'] ){
        $minimall_image_id = minimall_select_hero_image();
        $minimall_image_src_sm = wp_get_attachment_image_src( $minimall_image_id, 'minimall-hero-sm' );
        $minimall_image_src_md = wp_get_attachment_image_src( $minimall_image_id, 'minimall-hero-md' );
        $minimall_image_src_lg = wp_get_attachment_image_src( $minimall_image_id, 'minimall-hero-lg' );

        if( $minimall_image_id && $perf_options['active_preload'] ){
        ?>
            <link rel="preload" as="image" href="<?php echo $minimall_image_src_sm[0]; ?>" media="(max-width: 52em)">
            <link rel="preload" as="image" href="<?php echo $minimall_image_src_md[0]; ?>" media="(min-width: 52em) and (max-width: 64em)">
            <link rel="preload" as="image" href="<?php echo $minimall_image_src_lg[0]; ?>" media="(min-width: 64em)">
        <?php
        }

        if( $perf_options['more_preload'] ){
            echo $perf_options['more_preload'];
        }
    }
}

/*
* Remove all CSS and JS from contact form 7
*/
add_action('init', 'minimall_clean_contact_form_7');
function minimall_clean_contact_form_7(){
    add_filter( 'wpcf7_load_js', '__return_false' );
    add_filter( 'wpcf7_load_css', '__return_false' );
}