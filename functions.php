<?php
/**
 * minimal functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package minimal
 */
if ( ! function_exists( 'minimall_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function minimall_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on minimal, use a find and replace
	 * to change 'minimall' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'minimall', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

    add_theme_support( 'custom-logo' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'minimall-hero-lg', 950, 612, true );
	add_image_size( 'minimall-hero-md', 767, 494, true );
	add_image_size( 'minimall-hero-sm', 595, 383, true );

    add_image_size( 'minimall-hero-placeholder', 50, 32, true );
    
    add_image_size( 'minimall-edd-thumb', 160, 160, false );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'minimall' ),
		'sub-footer' => esc_html__( 'Sub-footer', 'minimall' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'minimall_custom_background_args', array(
		'default-color' => 'ffffff',
    ) ) );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );
    
    add_theme_support( 'totc-layout-control' );
    add_theme_support( 'posts-reviews' );
    

    $args = array(
        'width'              => 1000,
        'height'             => 450,
        'flex-width'         => true,
        'flex-height'        => true,
    );
    //add_theme_support( 'custom-header', $args );

    /* 
    * Gutenberg Support
    */
    add_theme_support( 'gutenberg', array(
        'wide-images' => true,
        'colors' => array(
            get_theme_mod('primary_color','#1078ff'),
            '#333',
            '#3a4145',
        ),
    ) );
    

    /* 
    * Admin page
    */
	if ( is_admin() ) {
        require_once( get_template_directory() . '/includes/admin/updater/theme-updater.php' );
	}


}
endif; // minimall_setup
add_action( 'after_setup_theme', 'minimall_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function minimall_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'minimall_content_width', 800 );
}
add_action( 'after_setup_theme', 'minimall_content_width', 0 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function minimall_widgets_init() {

    register_sidebar( array(
		'name'          => esc_html__( 'Footer Copyright', 'minimall' ),
		'id'            => 'footer-copy',
		'description'   => esc_html__("Sub Footer Widgets Sidebar","minimal"),
		'before_widget' => '<div id="%1$s" class="mb2 footer_widget widget %2$s clearfix break-word">',
		'after_widget'  => '</div>',
		'before_title'  => '<strong class="block widget-title mb2 mt0 small-p">',
		'after_title'   => '</strong>',
    ) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'minimall' ),
		'id'            => 'footer-1',
		'description'   => esc_html__("First footer column location","minimal"),
		'before_widget' => '<div id="%1$s" class="mb2 footer_widget widget %2$s clearfix break-word">',
		'after_widget'  => '</div>',
		'before_title'  => '<strong class="block widget-title mb2 mt0 small-p">',
		'after_title'   => '</strong>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'minimall' ),
		'id'            => 'footer-2',
		'description'   => esc_html__("Second footer column location","minimal"),
		'before_widget' => '<div id="%1$s" class="mb2 footer_widget widget %2$s clearfix break-word">',
		'after_widget'  => '</div>',
		'before_title'  => '<strong class="block widget-title mb2 mt0 small-p">',
		'after_title'   => '</strong>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'minimall' ),
		'id'            => 'footer-3',
		'description'   => esc_html__("Third footer column location","minimal"),
		'before_widget' => '<div id="%1$s" class="mb2 footer_widget widget %2$s clearfix break-word">',
		'after_widget'  => '</div>',
		'before_title'  => '<strong class="block widget-title mb2 mt0 small-p">',
		'after_title'   => '</strong>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'minimall' ),
		'id'            => 'footer-4',
		'description'   => esc_html__("Fourth footer column location","minimal"),
		'before_widget' => '<div id="%1$s" class="mb2 footer_widget widget %2$s clearfix break-word">',
		'after_widget'  => '</div>',
		'before_title'  => '<strong class="block widget-title mb2 mt0 small-p">',
		'after_title'   => '</strong>',
    ) );
    
    register_sidebar( array(
		'name'          => esc_html__( '404 Full Width Sidebar', 'minimall' ),
		'id'            => '404-full-sidebar',
		'description'   => __("404 page top location","minimal"),
		'before_widget' => '<div id="%1$s" class="mb4 %2$s clearfix widgets">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title caps mb2 widgets">',
		'after_title'   => '</h4>',
        'class'         => 'list-reset',
	) );

    register_sidebar( array(
		'name'          => esc_html__( '404 Left Sidebar', 'minimall' ),
		'id'            => '404-left-sidebar',
		'description'   => __("404 page left location","minimal"),
		'before_widget' => '<div id="%1$s" class="mb4 %2$s clearfix widgets">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title caps mb2 widgets">',
		'after_title'   => '</h4>',
        'class'         => 'list-reset',
	) );

    register_sidebar( array(
		'name'          => esc_html__( '404 Right Sidebar', 'minimall' ),
		'id'            => '404-right-sidebar',
		'description'   => __("404 page right location","minimal"),
		'before_widget' => '<div id="%1$s" class="mb4 %2$s clearfix widgets">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="h4 widget-title caps mb2 widgets">',
		'after_title'   => '</h4>',
        'class'         => 'list-reset',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'minimall' ),
		'id'            => 'blog-sidebar',
		'description'   => __("Blog and archive sidebar location","minimal"),
		'before_widget' => '<div id="%1$s" class="mb4 %2$s clearfix widgets">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title caps mb2 widgets">',
		'after_title'   => '</h4>',
        'class'         => 'list-reset',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Posts Footer Sidebar', 'minimall' ),
		'id'            => 'blog-footer-sidebar',
		'description'   => __("Sidebar display after the post content","minimal"),
		'before_widget' => '<div id="%1$s" class="%2$s clearfix widgets mt4 mb4">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title caps mb2">',
		'after_title'   => '</h4>',
    ) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Home page sidebar', 'minimall' ),
		'id'            => 'home-template',
		'description'   => __("Sidebar display after the post content","minimal"),
		'before_widget' => '<div id="%1$s" class="%2$s clearfix widgets mt4 mb4">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title caps mb2">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'minimall_widgets_init' );

/**
 * Helper functions
 */
require get_template_directory() . '/includes/helper.php';

/**
* Customizer partials
*/
require( get_template_directory() . '/includes/partials.php' );

/**
 * Recommend the Kirki plugin
 */
require get_template_directory() . '/includes/admin/customizer/include-kirki.php';

/**
 * Customizer kirky Fallback
 */
require( get_template_directory() . '/includes/admin/customizer/minimall-kirki.php' );

/**
 * Customizer Options
 */
require( get_template_directory() . '/includes/admin/customizer/customizer.php' );





/**
 * Temp
 */
function minimall_page_options(){
    return;
}

/**
 * Temp
 */
function minimall_theme_options( ){
    $my_theme = wp_get_theme();
    $theme_options = get_option( 'theme_mods_'.$my_theme->get( 'TextDomain' ), array() );

    return $theme_options;
}

function minimall_get_option( $all_option = array(), $key = '', $default = false ){
    if( array_key_exists($key, $all_option) ){
        return $all_option[$key];
    }else{
        if( isset( $default ) ){
            return $default;
        }else{
            return false;
        }
    }
}

function minimall_get_option2( $setting, $default ){
    $my_theme = wp_get_theme();
    $options = get_option( 'theme_mods_'.$my_theme->get( 'TextDomain' ), array() );
    $value = $default;
    if ( isset( $options[ $setting ] ) ) {
        $value = $options[ $setting ];
    }
    return $value;
}

/**
 * Enqueue scripts and styles.
 */
function minimall_scripts() {
    global $post;

    $page_options = minimall_page_options();
    $theme_options = minimall_theme_options();

	/* If using a child theme, auto-load the parent theme style. */
    if ( is_child_theme() ) {
        wp_enqueue_style( 'minimall-parent-style', trailingslashit( get_template_directory_uri() ) . 'style.css' );
        wp_enqueue_style( 'minimall-stylesheet', get_stylesheet_uri()  );
    }else{
    	wp_enqueue_style( 'minimall-stylesheet', trailingslashit( get_template_directory_uri() ) . 'style.css' );
    }

    wp_enqueue_script( 'minimall-lazysizes', get_template_directory_uri() . '/includes/vendors/lazysizes/lazysizes-all.min.js', '', '', true );

    wp_enqueue_script( 'minimall-init', get_template_directory_uri() . '/assets/js/minimall-init.min.js', array(), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'minimall_scripts' );

/**
 * Enqueue scripts and styles for Gutenberg editor
 */
//add_action( 'enqueue_block_editor_assets', 'minimall_editor_styles' );
function minimall_editor_styles() {
    if ( is_child_theme() ) {
        wp_enqueue_style( 'minimall-parent-style', trailingslashit( get_template_directory_uri() ) . 'style.css' );
        wp_enqueue_style( 'minimall-stylesheet', get_stylesheet_uri()  );
    }else{
    	wp_enqueue_style( 'minimall-stylesheet', trailingslashit( get_template_directory_uri() ) . 'style.css' );
    }
}


/**
 * Load TGM class
 */
//require get_template_directory() . '/includes/admin/tgm/tgm.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';

/**
 * minimal functions
 */
require get_template_directory() . '/includes/extra.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/jetpack.php';

/**
 * Load custom style
 */
require get_template_directory() . '/includes/custom-styles.php';

/**
 * Social Widget
 */
require get_template_directory() . '/includes/widgets/widget-social.php';

/**
 * Author Widget
 */
require get_template_directory() . '/includes/widgets/widget-author.php';

/**
 * EDD customization
 */
require get_template_directory() . '/includes/edd.php';


