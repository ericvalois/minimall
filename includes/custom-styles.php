<?php
/**
 * @package minimal
 */

/*
* Inline styles
*/
add_action( 'ttfb_toolkit_head_open', 'minimall_inline_styles', 10 );
function minimall_inline_styles() {

    echo '<style>';
        /* Theme Options */ 
        do_action( 'minimall_mobile_styles' );

    echo '</style>';
}

/**
 * Print custom inline CSS in the head
 */
add_action('minimall_mobile_styles','minimall_e_custom_styles', 5);
function minimall_e_custom_styles(){
    $custom_styles = minimall_custom_styles();
    echo minimall_compress( $custom_styles );
}

/**
 * Define Custom CSS
 */
function minimall_custom_styles(){
    

    $main_color = get_theme_mod('primary_color','#1078ff');
    $text_color = get_theme_mod('text_color','#3A4145');
    $mobile_font_size = get_theme_mod('mobile_font_size',16);
    $desktop_font_size = get_theme_mod('desktop_font_size',19);
    $font_size_difference = (int)$desktop_font_size - (int)$mobile_font_size;

    $minimall_custom_css = '
    /* Custom Style */
    :root{
        --color-primary: '.$main_color.';
        --viewport-difference: calc(100vw - 460px);
        --viewport-difference: calc(100vw - (460 * 1px));
     }

     html {
       -moz-osx-font-smoothing: grayscale;
       -webkit-font-smoothing: antialiased;
     
       font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
       font-size: calc(16px + 3 * (100vw - 460px) / 740);
       font-size: calc(('.$mobile_font_size.' * 1px) + '.$font_size_difference.' * var(--viewport-difference) / 740);
       line-height: 1.8;
       font-weight: 400;
       letter-spacing: 0.01em;
    }
    @media (max-width: 459px) {
        html {
            font-size: 16px;
            font-size: calc('.$mobile_font_size.' * 1px);
        }
    }
    @media (min-width: 1200px) {
        html {
            font-size: 19px;
            font-size: calc('.$desktop_font_size.' * 1px);
        }
    }

    a,
    a.black:hover,
    a.active{ color: '. $main_color .';}
    .primary-color,
    .current_page_item a,
    .btn-outline,
    .menu a:hover,
    .social-network:hover,
    .has-primary-color{
        color: '. $main_color .' !important;
    }
    
    .btn-outline,
    .social-network:hover{ border-color: '. $main_color .'; }

    .btn.btn-primary,
    #edd-purchase-button,
    .has-primary-background-color{
        background-color: '. $main_color .';
    }

    #site-navigation .sub-menu{display: none}
    
    .menu-item-has-children .item:after,
    .menu-item-has-children a:after{background: transparent url(data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjE2IiB2aWV3Qm94PSIwIDAgMTYgMTYiIHdpZHRoPSIxNiIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJtOCAxMS40LTUuNC01LjQgMS40LTEuNCA0IDQgNC00IDEuNCAxLjR6Ii8+PC9zdmc+) no-repeat center center;}
    ';
    
    return $minimall_custom_css;
}
