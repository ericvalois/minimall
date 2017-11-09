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
    
    $theme_options = minimall_theme_options();

    if( isset( $theme_options['primary_color'] ) ){
        $main_color = $theme_options['primary_color'];
    }else{
        $main_color = '#1078ff';
    }
    

    $system_font_sans = 'font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Helvetica Neue", Helvetica,  sans-serif;';
    $system_font_serif = 'font-family: Georgia,Cambria,"Times New Roman",Times,serif;';

    $minimall_custom_css = '
        a,
        a.black:hover{ color: '. $main_color .';}
        .btn-primary,
        .btn-black:hover,
        .btn-black:active,
        .btn-black:focus
        {
            background-color: '. $main_color .';
        }
        .btn-outline:hover,
        .btn-outline:active,
        .btn-white:hover,
        .btn-white:focus,
        .primary-color {
            border-color: '. $main_color .';
            color: '. $main_color .' !important;
        }
    ';


    if( !empty( $theme_options['default_font'] ) ){
        if( $theme_options['default_font'] == 'system_font_sans' ){
            $default_font = $system_font_sans;
        }else{
            $default_font = $system_font_serif;
        }
        $minimall_custom_css .= '
            body{ '. $default_font .' }
        ';
    }

    if( 
        !empty( $theme_options['headers_font'] ) &&
        $theme_options['headers_font'] !== $theme_options['default_font']
    ){
        if( $theme_options['headers_font'] == 'system_font_sans' ){
            $headers_font = $system_font_sans;
        }else{
            $headers_font = $system_font_serif;
        }

        $minimall_custom_css .= '
            h1,h2,h3,h4,h5,h6{ '. $headers_font .' }
        ';
    }

    if( 
        !empty( $theme_options['text_font'] ) &&
        $theme_options['text_font'] !== $theme_options['default_font']
    ){
        if( $theme_options['text_font'] == 'system_font_sans' ){
            $text_font = $system_font_sans;
        }else{
            $text_font = $system_font_serif;
        }

        $minimall_custom_css .= '
            p{ '. $text_font .' }
        ';
    }
    
    
    return $minimall_custom_css;
}
