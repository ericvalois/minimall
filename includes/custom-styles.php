<?php
/**
 * @package minimal
 */

/*
* Inline styles
*/
add_action( 'minimall_head_open', 'minimall_inline_styles', 10 );
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
    html {
        font-size: 100%;
        line-height: 1;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
    }

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
    .btn-outline{
        color: '. $main_color .' !important;
    }
    
    .btn-outline{ border-color: '. $main_color .'; }

    .btn:hover, .button:hover ,button:hover, [role="button"]:hover, input[type="submit"]:hover, input[type="button"]:hover,
    .btn:focus, .button:focus, button:focus, [role="button"]:focus, input[type="submit"]:focus, input[type="button"]:focus,
    .btn:active, .button:active, button:active, [role="button"]:active, input[type="submit"]:active, input[type="button"]:active,
    .btn.btn-primary{
        border-color: '. $main_color .';
        background-color: '. $main_color .';
    }
    ';
    
    
    return $minimall_custom_css;
}
