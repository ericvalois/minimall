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
        /* Theme OPtions */ 
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
    

    $system_font_sans = 'font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Helvetica Neue", Helvetica,  sans-serif;';
    $system_font_serif = 'font-family: Georgia,Cambria,"Times New Roman",Times,serif;';

    $minimall_custom_css = '
        :root{
            --unitless-min-font-size: '.$mobile_font_size.';
            --unitless-max-font-size: '.$desktop_font_size.';
            --color-primary: '.$main_color.';
            --text-color: '.$text_color.';
            --link-hover-color: '.$text_color.';
            --link-focus-color: '.$text_color.';
            --link-active-color: '.$text_color.';
            --letter-spacing-base: 0.01em;
            
        }
        a,
        a.black:hover{ color: '. $main_color .';}
        .primary-color,
        .current_page_item a{
            color: '. $main_color .' !important;
        }
    ';
    
    
    return $minimall_custom_css;
}
