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
    set_post_thumbnail_size( 800, 535, true );


    /*
    * Easy Digital Download Image size
    */
    add_image_size( 'minimall-edd-thumbnails', 1143, 1143, array('center','top') );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'minimall' ),
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
    
    /*
	 * Add TTFB Toolkit support
	 */
    add_theme_support( 'ttfb_toolkit_author_widget');
    add_theme_support( 'ttfb_toolkit_alerts');
    add_theme_support( 'ttfb_toolkit_icons');
    add_theme_support( 'ttfb_toolkit_performance');
    add_theme_support( 'ttfb_toolkit_sharing');
    add_theme_support( 'ttfb_toolkit_spacing_widget');
    add_theme_support( 'ttfb_toolkit_address_widget');
    add_theme_support( 'ttfb_toolkit_social_widget');
    add_theme_support( 'ttfb_toolkit_debug_widget');

    // Gutenberg Custom Modules
    add_theme_support( 'ttfb_toolkit_gutenberg_pillar_post');

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'minimall_custom_background_args', array(
		'default-color' => 'ffffff',
    ) ) );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

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
add_action( 'after_setup_theme', 'minimall_content_width', 0 );
function minimall_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'minimall_content_width', 768 );
}

/*
* Custom Embed size on larger template
*/
add_filter('template_redirect', 'minimall_custom_content_width_embed_size');
function minimall_custom_content_width_embed_size($embed_size){
    if ( is_page_template('templates/full-width.php') ) {
        global $content_width;
        $content_width = 1143;
    }elseif( is_singular('download') ){
        global $content_width;
        $content_width = 1010;
    }
}

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
		'before_widget' => '<div id="%1$s" class="mb3 %2$s clearfix widgets">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title caps mb2 widgets">',
		'after_title'   => '</h4>',
        'class'         => 'list-reset',
	) );

    register_sidebar( array(
		'name'          => esc_html__( '404 Left Sidebar', 'minimall' ),
		'id'            => '404-left-sidebar',
		'description'   => __("404 page left location","minimal"),
		'before_widget' => '<div id="%1$s" class="mb3 %2$s clearfix widgets">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title caps mb2 widgets">',
		'after_title'   => '</h4>',
        'class'         => 'list-reset',
	) );

    register_sidebar( array(
		'name'          => esc_html__( '404 Right Sidebar', 'minimall' ),
		'id'            => '404-right-sidebar',
		'description'   => __("404 page right location","minimal"),
		'before_widget' => '<div id="%1$s" class="mb3 %2$s clearfix widgets">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class=" widget-title caps mb2 widgets">',
		'after_title'   => '</h4>',
        'class'         => 'list-reset',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'minimall' ),
		'id'            => 'blog-sidebar',
		'description'   => __("Blog and archive sidebar location","minimal"),
		'before_widget' => '<div id="%1$s" class="mb3 %2$s clearfix widgets">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title caps mt0 mb2 widgets">',
		'after_title'   => '</h4>',
        'class'         => 'list-reset',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Before Posts Content', 'minimall' ),
		'id'            => 'post-header-sidebar',
		'description'   => __("Sidebar display before post content","minimal"),
		'before_widget' => '<div id="%1$s" class="%2$s clearfix widgets max-width-3 ml-auto mr-auto mt0 mb2">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title mb1 mt0">',
		'after_title'   => '</h5>',
    ) );

    register_sidebar( array(
		'name'          => esc_html__( 'Before Pages Content', 'minimall' ),
		'id'            => 'page-header-sidebar',
		'description'   => __("Sidebar display before page content","minimal"),
		'before_widget' => '<div id="%1$s" class="%2$s clearfix widgets max-width-3 ml-auto mr-auto mt0 mb2">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title mb1 mt0">',
		'after_title'   => '</h5>',
    ) );

	register_sidebar( array(
		'name'          => esc_html__( 'After Posts Content', 'minimall' ),
		'id'            => 'post-footer-sidebar',
		'description'   => __("Sidebar display after post content","minimal"),
		'before_widget' => '<div id="%1$s" class="%2$s clearfix widgets max-width-3 ml-auto mr-auto mt3 mb3">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title mb2 mt0">',
		'after_title'   => '</h5>',
    ) );

    register_sidebar( array(
		'name'          => esc_html__( 'After Pages Content', 'minimall' ),
		'id'            => 'page-footer-sidebar',
		'description'   => __("Sidebar display after page content","minimal"),
		'before_widget' => '<div id="%1$s" class="%2$s clearfix widgets max-width-3 ml-auto mr-auto mt3 mb3">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title mb2 mt0">',
		'after_title'   => '</h5>',
    ) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Private Dashboard sidebar', 'minimall' ),
		'id'            => 'private-dashboard',
		'description'   => __("Sidebar display in the private dashboard template","minimal"),
		'before_widget' => '<div id="%1$s" class="%2$s clearfix widgets mt0 mb2">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title mb1 h6 pr2">',
		'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
		'name'          => esc_html__( 'Main header sidebar', 'minimall' ),
		'id'            => 'header-sidebar',
		'description'   => __("Sidebar display in the main header.","minimal"),
		'before_widget' => '<div id="%1$s" class="%2$s lg-ml2 mt2 mb2 lg-mt0 lg-mb0">',
		'after_widget'  => '</div>',
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
 * Enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', 'minimall_scripts' );
function minimall_scripts() {
    global $post;

	/* If using a child theme, auto-load the parent theme style. */
   if ( is_child_theme() ) {
        wp_enqueue_style( 'minimall-parent-style', trailingslashit( get_template_directory_uri() ) . 'style.css' );
        wp_enqueue_style( 'minimall-stylesheet', get_stylesheet_uri()  );
    }else{
    	wp_enqueue_style( 'minimall-stylesheet', trailingslashit( get_template_directory_uri() ) . 'style.css' );
    }

    wp_enqueue_script( 'minimall-init', get_template_directory_uri() . '/assets/js/minimall-init.min.js', array(), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
    }
}


/**
 * Is TTFB Toolkit active?
 *
 * @since 1.0.0
 * @return bool
 */
function minimall_is_ttfb_toolkit() {
	return class_exists( 'Ttfb_Toolkit' );
}

/**
 * Is EDD active?
 *
 * @since 1.0.0
 * @return bool
 */
function minimall_is_edd_active() {
	return class_exists( 'Easy_Digital_Downloads' );
}

/**
 * Is EDD Software Licensing active?
 *
 * @since 1.0.0
 * @return bool
 */
function minimall_is_edd_sl_active() {
	return class_exists( 'EDD_Software_Licensing' );
}

/**
 * Is EDD Coming Soon active?
 *
 * @since 1.0.2
 * @return bool
 */
function minimall_is_edd_coming_soon_active() {
	return class_exists( 'EDD_Coming_Soon' );
}

/**
 * Is EDD Recurring active?
 *
 * @since 1.0.0
 * @return bool
 */
function minimall_is_edd_recurring_active() {
	return class_exists( 'EDD_Recurring' );
}

/**
 * Is EDD Reviews active?
 *
 * @since 1.0.0
 * @return bool
 */
function minimall_is_edd_reviews_active() {
	return class_exists( 'EDD_Reviews' );
}

/**
 * Is EDD Download Images active?
 *
 * @since 1.0.0
 * @return bool
 */
function minimall_is_edd_download_images_active() {
	return function_exists('edd_di_get_images');
}

/**
 * Is Autoptimize active?
 *
 * @since 1.0.0
 * @return bool
 */
function minimall_is_autoptimize_active() {
	return class_exists('autoptimizeCache');
}

/**
 * Is Metabox active?
 *
 * @since 1.0.0
 * @return bool
 */
function minimall_is_metabox_active() {
	return class_exists('RWMB_Loader');
}

/**
 * Is Contact Form 7 active?
 *
 * @since 1.0.0
 * @return bool
 */
function minimall_is_cf7_active() {
	return class_exists('WPCF7');
}

/**
 * Is Jetpack active?
 *
 * @since 1.0.0
 * @return bool
 */
function minimall_is_jetpack_active() {
	return class_exists('Jetpack');
}

/**
 * Is Gutenberg active?
 *
 * @since 1.0.0
 * @return bool
 */
function minimall_is_gutenberg_active() {
	return class_exists('WP_Block_Type');
}

/**
 * Is Kirki active?
 *
 * @since 1.0.0
 * @return bool
 */
function minimall_is_kirki_active() {
	return class_exists('Kirki_Autoload');
}

/**
 * Is Theme Demo Import active?
 *
 * @since 1.0.0
 * @return bool
 */
function minimall_is_theme_demo_import_active() {
	return class_exists('Theme_Demo_Import');
}

/**
 * Is EDD Description active?
 *
 * @since 1.0.0
 * @return bool
 */
function minimall_is_variable_pricing_desciption() {
	return function_exists('edd_vpd_output_description');
}

/**
 * Compatibility
 */
require get_template_directory() . '/includes/compatibility.php';

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
require get_template_directory() . '/includes/extra.php';

/**
 * Load custom style
 */
require get_template_directory() . '/includes/custom-styles.php';

/**
 * Load custom editor styles
 */
require get_template_directory() . '/includes/admin/editor.php';