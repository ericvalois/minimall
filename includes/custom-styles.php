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
    $mobile_font_size = get_theme_mod('mobile_font_size','16');
    $desktop_font_size = get_theme_mod('desktop_font_size','19');

    $minimall_custom_css = '
    /* Custom Style */
    html {
        font-size: 100%;
        line-height: 1;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
    }
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-size: 100%;
        font-weight: normal;
    }
    :root{
        --unitless-min-font-size: '.$mobile_font_size.';
        --unitless-max-font-size: '.$desktop_font_size.';
        --color-primary: '.$main_color.';
        --text-color: '.$text_color.';
        --link-hover-color: '.$text_color.';
        --link-focus-color: '.$text_color.';
        --link-active-color: '.$text_color.';

        /*--block-semantic-element-margin-vertical: 1.5rem;*/
        /*--heading-margin-bottom: .5rem;*/
        --border-radius: 3px;
        --font-family-sans-serif: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif;
        --base-font-family: var(--font-family-sans-serif);
        --unitless-lower-font-range: 460;
        --unitless-upper-font-range: 1200;
        /*--base-line-height: 1.8;*/
        --heading-line-height: 1.2;
        --font-size-1: 3rem;
        --font-size-2: 2.5rem;
        --font-size-3: 2rem;
        --font-size-4: 1.5rem;
        --font-size-5: 1.2rem;
        --font-size-6: 1rem;
        --font-size-base: var(--font-size-5);
        --font-size-large: var(--font-size-4);
        --font-size-small: 0.9rem;
        --font-weight-light: 300;
        /*--font-weight-normal: 400;*/
        --font-weight-medium: 500;
        --font-weight-semibold: 600;
        --font-weight-bold: 700;
        --font-weight-base: 400;
        --heading-font-weight: var(--font-weight-bold);
        --strong-font-weight: var(--font-weight-bold);
        --bold-font-weight: var(--font-weight-semibold);
        --button-horizontal-padding: 1.6rem;
       --font-size-difference: 3;
       --font-size-difference: calc(var(--unitless-max-font-size) - var(--unitless-min-font-size));
       --font-range-difference: 740;
       --font-range-difference: calc(var(--unitless-upper-font-range) - var(--unitless-lower-font-range));
       --viewport-difference: calc(100vw - 460px);
       --viewport-difference: calc(100vw - (var(--unitless-lower-font-range) * 1px));
     }

     html {
       -moz-osx-font-smoothing: grayscale;
       -webkit-font-smoothing: antialiased;
     
       font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
       font-size: calc(16px + 3 * (100vw - 460px) / 740);
       font-size: calc((var(--unitless-min-font-size) * 1px) + var(--font-size-difference) * var(--viewport-difference) / var(--font-range-difference));
       line-height: 1.8;
       font-weight: 400;
       letter-spacing: 0.01em;
    }
    @media (max-width: 459px) {
        html {
            font-size: 16px;
            font-size: calc(var(--unitless-min-font-size) * 1px);
        }
    }
    @media (min-width: 1200px) {
        html {
            font-size: 19px;
            font-size: calc(var(--unitless-max-font-size) * 1px);
        }
    }

    a,
    a.black:hover,
    a.active{ color: '. $main_color .';}
    .primary-color,
    .current_page_item a{
        color: '. $main_color .' !important;
    }
    ';
    
    
    return $minimall_custom_css;
}
