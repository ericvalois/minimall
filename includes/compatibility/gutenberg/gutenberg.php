<?php
/* 
* Gutenberg Support
*/
add_action( 'after_setup_theme', 'minimall_gutenberg_init' );
function minimall_gutenberg_init(){

    add_theme_support( 'editor-color-palette',
        array(
            'name' => 'primary',
            'color' => get_theme_mod('primary_color','#1078ff'),
        ),
        array(
            'name' => 'text',
            'color' => get_theme_mod('text_color','#3A4145'),
        ),
        array(
            'name' => 'white',
            'color' => '#fff',
        ),
        array(
            'name' => 'pink',
            'color' => 'rgb(247, 141, 167)',
        ),
        array(
            'name' => 'red',
            'color' => 'rgb(207, 46, 46)',
        ),
        array(
            'name' => 'orange',
            'color' => 'rgb(255, 105, 0)',
        ),
        array(
            'name' => 'yellow',
            'color' => 'rgb(252, 185, 0)',
        ),
        array(
            'name' => 'lime',
            'color' => 'rgb(123, 220, 181)',
        ),
        array(
            'name' => 'green',
            'color' => 'rgb(0, 208, 132)',
        ),
        array(
            'name' => 'pale blue',
            'color' => 'rgb(142, 209, 252)',
        ),
        array(
            'name' => 'blue',
            'color' => 'rgb(6, 147, 227)',
        ),
        array(
            'name' => 'Darken 1',
            'color' => 'rgba(0, 0, 0, .0625)',
        ),
        array(
            'name' => 'Darken 2',
            'color' => 'rgba(0, 0, 0, .125)',
        ),
        array(
            'name' => 'Darken 3',
            'color' => 'rgba(0, 0, 0, .25)',
        ),
        array(
            'name' => 'Darken 4',
            'color' => 'rgba(0, 0, 0, .5)',
        ),
        array(
            'name' => 'Lighten 1',
            'color' => 'rgba(255, 255, 255, .0625)',
        ),
        array(
            'name' => 'Lighten 2',
            'color' => 'rgba(255, 255, 255, .125)',
        ),
        array(
            'name' => 'Lighten 3',
            'color' => 'rgba(255, 255, 255, .25)',
        ),
        array(
            'name' => 'Lighten 4',
            'color' => 'rgba(255, 255, 255, .5)',
        )
    );
    add_theme_support( 'align-wide' );

    /*
    * Add support for core block's styles
    */
    //add_theme_support( 'wp-block-styles' );
}

/**
 * Add custom colors to Gutenberg.
 */
function minimall_primary_gutenberg_colors() {
	// Retrieve the accent color fro the Customizer.
	$primary = get_theme_mod('primary_color','#1078ff');
	// Build styles.
	$css  = '';
	$css .= '.has-primary-color { color: ' . esc_attr( $primary ) . ' !important; }';
	$css .= '.has-primary-background-color { background-color: ' . esc_attr( $primary ) . ' !important; }';
	return wp_strip_all_tags( $css );
}



/**
 * Enqueue block editor stylesheets
 */
add_action( 'enqueue_block_editor_assets', 'minimall_gutenberg_editor_stylesheet' );
function minimall_gutenberg_editor_stylesheet(){
    // Global style
    wp_enqueue_style('minimall-editor-global-css', get_template_directory_uri() . '/includes/compatibility/gutenberg/editor.min.css' );

    // BASSCSS style
    wp_enqueue_style('minimall-editor-basscss-css', get_template_directory_uri() . '/assets/css/gutenberg-basscss.css' );

    // Theme style
    wp_enqueue_style('minimall-editor-theme-css', get_template_directory_uri() . '/assets/css/gutenberg-minimall.css' );

    // Add custom colors to Gutenberg.
	wp_add_inline_style( 'minimall-editor-global-css', minimall_primary_gutenberg_colors() );
}
