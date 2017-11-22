<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/*
* Critical CSS
*/
add_action('light_bold_mobile_styles','perf_critical_css', 5);
function perf_critical_css()
{
    if( !perf_on_page_css_optimisation() && !empty( perf_get_field("perf_critical_css_active","option") ) && !is_admin() ){
        echo '/* Critical CSS */ ';

        if( is_page_template("page-templates/template-front.php") ){

            global $post;

            if( light_bold_flickity_detection( $post->ID ) ){
                include_once( "critical/home-with-slider.min.css" );
               
            }else{
                include_once( "critical/home.min.css" );
            }

        }elseif( is_page_template("page-templates/template-contact.php") ){
            include_once( "critical/contact.min.css" );
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

/*
* Async all stylsheets with loadcss.js
*/
add_action('wp_print_styles', function() {
    if ( ! doing_action( 'wp_head' ) ) { // ensure we are on head
      return;
    }

    // Variables
    global $wp_scripts, $wp_styles;
    //$exluded_scripts = array("jquery-core","jquery-migrate","jquery-ui-core","jquery");
    $exluded_styles = array("admin-bar");
    $queued_styles  = $wp_styles->queue;

    // Styles
    if( !empty( $queued_styles ) && !perf_on_page_css_optimisation() && !empty( perf_get_field('perf_css_optimisation_active', 'option') ) && !is_admin() ){
        foreach ($wp_styles->queue as $key => $element) {
            if ( !in_array( $element, $exluded_styles ) ) {
                unset( $wp_styles->queue[$key] );
            }
        }
    }

    add_action( 'wp_footer', function() use( $queued_styles, $exluded_styles ) {
      
        global $wp_styles;

        // Styles
        if( !empty( $queued_styles ) && !perf_on_page_css_optimisation() && !empty( perf_get_field('perf_css_optimisation_active', 'option') ) && !is_admin() ){
        ?>
            <script>
                /*! loadCSS. [c]2017 Filament Group, Inc. MIT License */
                !function(a){"use strict";var b=function(b,c,d){function e(a){return h.body?a():void setTimeout(function(){e(a)})}function f(){i.addEventListener&&i.removeEventListener("load",f),i.media=d||"all"}var g,h=a.document,i=h.createElement("link");if(c)g=c;else{var j=(h.body||h.getElementsByTagName("head")[0]).childNodes;g=j[j.length-1]}var k=h.styleSheets;i.rel="stylesheet",i.href=b,i.media="only x",e(function(){g.parentNode.insertBefore(i,c?g:g.nextSibling)});var l=function(a){for(var b=i.href,c=k.length;c--;)if(k[c].href===b)return a();setTimeout(function(){l(a)})};return i.addEventListener&&i.addEventListener("load",f),i.onloadcssdefined=l,l(f),i};"undefined"!=typeof exports?exports.loadCSS=b:a.loadCSS=b}("undefined"!=typeof global?global:this);
                /*! Load stylesheet async */
                <?php foreach( $queued_styles as $key => $stylesheet ): ?>
                    <?php if ( !in_array( $stylesheet, $exluded_styles ) ): ?> 
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
  This option inline Above the Fold CSS in your page. If you enable this option, it is recommended to activate CSS Optimization as well.

  This option is for loading CSS asynchronously.

    Warning!	
    <p>In the case of any display errors, we recommend disabling those options.</p>
    <p>If you want to know more about CSS Delivery Optimization, please visit <a href="https://developers.google.com/speed/docs/insights/OptimizeCSSDelivery" target="_blank">Google Developers page</a>.</p>
*/