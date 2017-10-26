<?php
/**
 * @package minimal
 */

/*
* Inline styles
*/
add_action( 'minimal_head_open', 'minimal_inline_styles', 10 );
function minimal_inline_styles() {

    echo '<style>';
        /* Theme OPtions */ 
        do_action( 'minimal_mobile_styles' );

    echo '</style>';
}

/**
 * Print custom inline CSS in the head
 */
add_action('minimal_mobile_styles','minimal_e_custom_styles', 5);
function minimal_e_custom_styles(){
    $custom_styles = minimal_custom_styles();
    echo minimal_compress( $custom_styles );
}

/**
 * Define Custom CSS
 */
function minimal_custom_styles(){
    
    $theme_options = minimal_theme_options();

    $system_font_sans = 'font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Helvetica Neue", Helvetica,  sans-serif;';
    $system_font_serif = 'font-family: Georgia,Cambria,"Times New Roman",Times,serif;';

    $minimal_custom_css = '
        a,
        a.black:hover{ color: '. $theme_options['primary_color'] .';}
        .btn-primary,
        .btn-black:hover,
        .btn-black:active,
        .btn-black:focus{
            background-color: '. $theme_options['primary_color'] .';
        }
        .btn-outline:hover,
        .btn-outline:active {
            border-color: '. $theme_options['primary_color'] .';
            color: '. $theme_options['primary_color'] .';
        }
    ';


    if( !empty( $theme_options['default_font'] ) ){
        if( $theme_options['default_font'] == 'system_font_sans' ){
            $default_font = $system_font_sans;
        }else{
            $default_font = $system_font_serif;
        }
        $minimal_custom_css .= '
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

        $minimal_custom_css .= '
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

        $minimal_custom_css .= '
            p{ '. $text_font .' }
        ';
    }
    
    
    return $minimal_custom_css;
}
