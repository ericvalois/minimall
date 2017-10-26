<?php
/**
 * minimal functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package minimal
 */
if ( ! function_exists( 'minimal_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function minimal_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on minimal, use a find and replace
	 * to change 'minimal' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'minimal', get_template_directory() . '/languages' );

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

	add_image_size( 'minimal-hero-lg', 950, 612, true );
	add_image_size( 'minimal-hero-md', 767, 494, true );
	add_image_size( 'minimal-hero-sm', 595, 383, true );

	add_image_size( 'minimal-hero-placeholder', 50, 32, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'minimal' ),
		'sub-footer' => esc_html__( 'Sub-footer', 'minimal' ),
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
	add_theme_support( 'custom-background', apply_filters( 'minimal_custom_background_args', array(
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
    add_theme_support( 'custom-header', $args );


}
endif; // minimal_setup
add_action( 'after_setup_theme', 'minimal_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function minimal_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'minimal_content_width', 800 );
}
add_action( 'after_setup_theme', 'minimal_content_width', 0 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function minimal_widgets_init() {

    register_sidebar( array(
		'name'          => esc_html__( 'Footer Copyright', 'minimal' ),
		'id'            => 'footer-copy',
		'description'   => esc_html__("Sub Footer Widgets Sidebar","minimal"),
		'before_widget' => '<div id="%1$s" class="mb2 footer_widget widget %2$s clearfix break-word">',
		'after_widget'  => '</div>',
		'before_title'  => '<strong class="block widget-title mb2 mt0 small-p">',
		'after_title'   => '</strong>',
    ) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'minimal' ),
		'id'            => 'footer-1',
		'description'   => esc_html__("First footer column location","minimal"),
		'before_widget' => '<div id="%1$s" class="mb2 footer_widget widget %2$s clearfix break-word">',
		'after_widget'  => '</div>',
		'before_title'  => '<strong class="block widget-title mb2 mt0 small-p">',
		'after_title'   => '</strong>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'minimal' ),
		'id'            => 'footer-2',
		'description'   => esc_html__("Second footer column location","minimal"),
		'before_widget' => '<div id="%1$s" class="mb2 footer_widget widget %2$s clearfix break-word">',
		'after_widget'  => '</div>',
		'before_title'  => '<strong class="block widget-title mb2 mt0 small-p">',
		'after_title'   => '</strong>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'minimal' ),
		'id'            => 'footer-3',
		'description'   => esc_html__("Third footer column location","minimal"),
		'before_widget' => '<div id="%1$s" class="mb2 footer_widget widget %2$s clearfix break-word">',
		'after_widget'  => '</div>',
		'before_title'  => '<strong class="block widget-title mb2 mt0 small-p">',
		'after_title'   => '</strong>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'minimal' ),
		'id'            => 'footer-4',
		'description'   => esc_html__("Fourth footer column location","minimal"),
		'before_widget' => '<div id="%1$s" class="mb2 footer_widget widget %2$s clearfix break-word">',
		'after_widget'  => '</div>',
		'before_title'  => '<strong class="block widget-title mb2 mt0 small-p">',
		'after_title'   => '</strong>',
    ) );
    
    register_sidebar( array(
		'name'          => esc_html__( '404 Full Width Sidebar', 'minimal' ),
		'id'            => '404-full-sidebar',
		'description'   => __("404 page top location","minimal"),
		'before_widget' => '<div id="%1$s" class="mb3 %2$s clearfix widgets">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="h3 widget-title caps mb2 widgets weight700">',
		'after_title'   => '</h4>',
        'class'         => 'list-reset',
	) );

    register_sidebar( array(
		'name'          => esc_html__( '404 Left Sidebar', 'minimal' ),
		'id'            => '404-left-sidebar',
		'description'   => __("404 page left location","minimal"),
		'before_widget' => '<div id="%1$s" class="mb3 %2$s clearfix widgets">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="h3 widget-title caps mb2 widgets weight700">',
		'after_title'   => '</h4>',
        'class'         => 'list-reset',
	) );

    register_sidebar( array(
		'name'          => esc_html__( '404 Right Sidebar', 'minimal' ),
		'id'            => '404-right-sidebar',
		'description'   => __("404 page right location","minimal"),
		'before_widget' => '<div id="%1$s" class="mb3 %2$s clearfix widgets">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="h4 widget-title caps mb2 widgets weight700">',
		'after_title'   => '</h4>',
        'class'         => 'list-reset',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'minimal' ),
		'id'            => 'blog-sidebar',
		'description'   => __("Blog and archive sidebar location","minimal"),
		'before_widget' => '<div id="%1$s" class="mb3 %2$s clearfix widgets">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="h3 widget-title caps mb2 widgets weight700">',
		'after_title'   => '</h4>',
        'class'         => 'list-reset',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Posts Footer Sidebar', 'minimal' ),
		'id'            => 'blog-footer-sidebar',
		'description'   => __("Sidebar display after the post content","minimal"),
		'before_widget' => '<div id="%1$s" class="%2$s clearfix widgets mt4 mb4">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="h3 widget-title caps mb2 weight700">',
		'after_title'   => '</h4>',
    ) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Home page sidebar', 'minimal' ),
		'id'            => 'home-template',
		'description'   => __("Sidebar display after the post content","minimal"),
		'before_widget' => '<div id="%1$s" class="%2$s clearfix widgets mt4 mb4">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="h3 widget-title caps mb2 weight700">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'minimal_widgets_init' );

/**
 * Helper functions
 */
require get_template_directory() . '/includes/helper.php';

/**
 * Recommend the Kirki plugin
 */
require get_template_directory() . '/includes/admin/customizer/include-kirki.php';

/**
 * Customizer kirky Fallback
 */
require( get_template_directory() . '/includes/admin/customizer/minimal-kirki.php' );

/**
 * Customizer Options
 */
require( get_template_directory() . '/includes/admin/customizer/customizer.php' );



/**
 * Temp
 */
function minimal_page_options(){
    return;
}

/**
 * Temp
 */
function minimal_theme_options(){
    $theme_options = get_option( 'theme_mods_minimal', array() );

    return $theme_options;
}

function minimal_theme_get_option( $setting, $default ) {
    $options = get_option( 'option_name', array() );
    $value = $default;
    if ( isset( $options[ $setting ] ) ) {
        $value = $options[ $setting ];
    }
    return $value;
}

// pass variable
//include(locate_template('your-template-name.php'));

/**
 * Enqueue scripts and styles.
 */
function minimal_scripts() {
    global $post;

    $page_options = minimal_page_options();
    $theme_options = minimal_theme_options();

	/* If using a child theme, auto-load the parent theme style. */
    if ( is_child_theme() ) {
        wp_enqueue_style( 'minimal-parent-style', trailingslashit( get_template_directory_uri() ) . 'style.css' );
        wp_enqueue_style( 'minimal-stylesheet', get_stylesheet_uri()  );
    }else{
    	wp_enqueue_style( 'minimal-stylesheet', trailingslashit( get_template_directory_uri() ) . 'style.css' );
    }

    wp_enqueue_script( 'minimal-lazysizes', get_template_directory_uri() . '/includes/vendors/lazysizes/lazysizes-all.min.js', '', '', true );

    wp_enqueue_script( 'minimal-init', get_template_directory_uri() . '/assets/js/minimal-init.min.js', array(), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'minimal_scripts' );

/**
 * Load TGM class
 */
require get_template_directory() . '/includes/admin/tgm/tgm.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';

/**
 * minimal functions
 */
require get_template_directory() . '/includes/minimal.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/jetpack.php';

/**
 * Load custom style
 */
//require get_template_directory() . '/includes/custom-styles.php';

/**
 * Social Widget
 */
require get_template_directory() . '/includes/widgets/widget-social.php';

/**
 * Author Widget
 */
require get_template_directory() . '/includes/widgets/widget-author.php';

/**
 *  Customizer Content Layout Control 
 */
//require get_template_directory() . '/includes/admin/customizer/content-layout-control/content-layout-control.php';

/**
 * Add custom buttons and formating to Tinymce
 */
//require get_template_directory() . '/includes/extend-tinymce.php';

/**
 *  Performance features
 */
//require get_template_directory() . '/includes/performance/performance-init.php';


