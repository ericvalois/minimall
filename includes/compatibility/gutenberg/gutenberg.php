<?php
/* 
* Gutenberg Support
*/
add_action( 'after_setup_theme', 'minimall_gutenberg_init' );
function minimall_gutenberg_init(){

    
    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => __( 'primary','minimall'),
            'slug' => 'primary',
            'color' => get_theme_mod('primary_color','#1078ff'),
        ),
        array(
            'name' => __('textcolor','minimall'),
            'slug' => 'textcolor',
            'color' => get_theme_mod('text_color','#3A4145'),
        ),
        array(
            'name' => __('white','minimall'),
            'slug' => 'white',
            'color' => '#fff',
        ),
        array(
            'name' => __('pink','minimall'),
            'slug' => 'pink',
            'color' => 'rgb(247, 141, 167)',
        ),
        array(
            'name' => __('red','minimall'),
            'slug' => 'red',
            'color' => 'rgb(207, 46, 46)',
        ),
        array(
            'name' => __('orange','minimall'),
            'slug' => 'orange',
            'color' => 'rgb(255, 105, 0)',
        ),
        array(
            'name' => __('yellow','minimall'),
            'slug' => 'yellow',
            'color' => 'rgb(252, 185, 0)',
        ),
        array(
            'name' => __('lime','minimall'),
            'slug' => 'lime',
            'color' => 'rgb(123, 220, 181)',
        ),
        array(
            'name' => __('green','minimall'),
            'slug' => 'green',
            'color' => 'rgb(0, 208, 132)',
        ),
        array(
            'name' => __('pale blue','minimall'),
            'slug' => 'pale-blue',
            'color' => 'rgb(142, 209, 252)',
        ),
        array(
            'name' => __('blue','minimall'),
            'slug' => '',
            'color' => 'rgb(6, 147, 227)',
        ),
        array(
            'name' => __('Darken 1','minimall'),
            'slug' => 'darken-1',
            'color' => 'rgba(0, 0, 0, .0625)',
        ),
        array(
            'name' => __('Darken 2','minimall'),
            'slug' => 'darken-2',
            'color' => 'rgba(0, 0, 0, .125)',
        ),
        array(
            'name' => __('Darken 3','minimall'),
            'slug' => 'darken-3',
            'color' => 'rgba(0, 0, 0, .25)',
        ),
        array(
            'name' => __('Darken 4','minimall'),
            'slug' => 'darken-4',
            'color' => 'rgba(0, 0, 0, .5)',
        ),
        array(
            'name' => __('Darken 5','minimall'),
            'slug' => 'darken-5',
            'color' => 'rgba(0, 0, 0, .65)',
        ),
        array(
            'name' => __('Darken 6','minimall'),
            'slug' => 'darken-6',
            'color' => 'rgba(0, 0, 0, .8)',
        ),
        array(
            'name' => __('Lighten 1','minimall'),
            'slug' => 'lighten-1',
            'color' => 'rgba(255, 255, 255, .0625)',
        ),
        array(
            'name' => __('Lighten 2','minimall'),
            'slug' => 'lighten-2',
            'color' => 'rgba(255, 255, 255, .125)',
        ),
        array(
            'name' => __('Lighten 3','minimall'),
            'slug' => 'lighten-3',
            'color' => 'rgba(255, 255, 255, .25)',
        ),
        array(
            'name' => __('Lighten 4','minimall'),
            'slug' => 'lighten-4',
            'color' => 'rgba(255, 255, 255, .5)',
        ),
        array(
            'name' => __('Lighten 5','minimall'),
            'slug' => 'lighten-5',
            'color' => 'rgba(255, 255, 255, .65)',
        ),
        array(
            'name' => __('Lighten 6','minimall'),
            'slug' => 'lighten-6',
            'color' => 'rgba(255, 255, 255, .8)',
        )
    ));
        


    /*
    * Align wide compatibility
    * https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/
    */
    add_theme_support( 'align-wide' );

    /*
    * Responsive embed
    * https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/
    */
    add_theme_support( 'responsive-embeds' );

    /*
    * Bring editor style compatibility
    * https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/
    */
    add_theme_support('editor-styles');

    add_editor_style( '/includes/compatibility/gutenberg/editor.min.css' );
    add_editor_style( '/assets/css/gutenberg-basscss.css' );
    //add_editor_style( '/assets/css/gutenberg-minimall.css' );
    
    /*
    * Add support for core block's styles
    */
    //add_theme_support( 'wp-block-styles' );

    /*
    * Add support for custom font size
    */
    $mobile_font_size = get_theme_mod('mobile_font_size',16);
    $desktop_font_size = get_theme_mod('desktop_font_size',19);

    add_theme_support( 'editor-font-sizes', array(
        array(
            'name' => __( '80%', 'minimall' ),
            'shortName' => __( '80%', 'minimall' ),
            'size' => $desktop_font_size - 4,
            'slug' => '80'
        ),array(
            'name' => __( '90%', 'minimall' ),
            'shortName' => __( '90%', 'minimall' ),
            'size' => $desktop_font_size - 2,
            'slug' => '90'
        ),
        array(
            'name' => __( '100%', 'minimall' ),
            'shortName' => __( '100%', 'minimall' ),
            'size' => $desktop_font_size,
            'slug' => '100'
        ),
        array(
            'name' => __( '110%', 'minimall' ),
            'shortName' => __( '110%', 'minimall' ),
            'size' => $desktop_font_size + 2,
            'slug' => '110'
        ),
        array(
            'name' => __( '120%', 'minimall' ),
            'shortName' => __( '120%', 'minimall' ),
            'size' => $desktop_font_size + 4,
            'slug' => '120'
        ),
        array(
            'name' => __( '130%', 'minimall' ),
            'shortName' => __( '130%', 'minimall' ),
            'size' => $desktop_font_size + 6,
            'slug' => '130'
        ),
        array(
            'name' => __( '140%', 'minimall' ),
            'shortName' => __( '140%', 'minimall' ),
            'size' => $desktop_font_size + 8,
            'slug' => '140'
        ),
        array(
            'name' => __( '150%', 'minimall' ),
            'shortName' => __( '150%', 'minimall' ),
            'size' => $desktop_font_size + 10,
            'slug' => '150'
        ),
        array(
            'name' => __( '160%', 'minimall' ),
            'shortName' => __( '160%', 'minimall' ),
            'size' => $desktop_font_size + 12,
            'slug' => '160'
        ),
        array(
            'name' => __( '170%', 'minimall' ),
            'shortName' => __( '170%', 'minimall' ),
            'size' => $desktop_font_size + 14,
            'slug' => '170'
        ),
        array(
            'name' => __( '180%', 'minimall' ),
            'shortName' => __( '180%', 'minimall' ),
            'size' => $desktop_font_size + 16,
            'slug' => '180'
        ),
        array(
            'name' => __( '190%', 'minimall' ),
            'shortName' => __( '190%', 'minimall' ),
            'size' => $desktop_font_size + 18,
            'slug' => '190'
        ),
        array(
            'name' => __( '200%', 'minimall' ),
            'shortName' => __( '200%', 'minimall' ),
            'size' => $desktop_font_size + 20,
            'slug' => '200'
        )
    ) );
}

/**
 * Add custom colors to Gutenberg.
 */
function minimall_primary_gutenberg_colors() {
	// Retrieve the accent color fro the Customizer.
	$primary = get_theme_mod('primary_color','#1078ff');
	// Build styles.
    $css  = '
    :root{
        --primary-color: ' . esc_attr( $primary ) . ';
        --viewport-difference: calc(100vw - 460px);
        --viewport-difference: calc(100vw - (460 * 1px));
        --mobile-font-size: '. esc_attr( get_theme_mod('mobile_font_size',16) ) .';
        --desktop-font-size: '. esc_attr( get_theme_mod('desktop_font_size',19) ) .';
     }

     ';
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
    //wp_enqueue_style('minimall-editor-global-css', get_template_directory_uri() . '/includes/compatibility/gutenberg/editor.min.css' );

    // BASSCSS style
    //wp_enqueue_style('minimall-editor-basscss-css', get_template_directory_uri() . '/assets/css/gutenberg-basscss.css' );

    // Theme style
    //wp_enqueue_style('minimall-editor-theme-css', get_template_directory_uri() . '/assets/css/gutenberg-minimall.css' );

    wp_register_style( 'minimall-editor-global-css', false );
    wp_enqueue_style( 'minimall-editor-global-css' );

    // Add custom colors to Gutenberg.
	wp_add_inline_style( 'minimall-editor-global-css', minimall_primary_gutenberg_colors() );
}
