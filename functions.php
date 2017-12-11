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

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'minimall' ),
        'sub-footer' => esc_html__( 'Sub-footer', 'minimall' ),
        'private-dashboard' => esc_html__( 'Private Dashboard', 'minimall' ),
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
		'before_title'  => '<h4 class="widget-title caps mb2 widgets">',
		'after_title'   => '</h4>',
        'class'         => 'list-reset',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Posts Footer Sidebar', 'minimall' ),
		'id'            => 'blog-footer-sidebar',
		'description'   => __("Sidebar display after the post content","minimal"),
		'before_widget' => '<div id="%1$s" class="%2$s clearfix widgets mt3 mb3">',
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
function minimall_scripts() {
    global $post;

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
 * Is Faster Font Awesome active?
 *
 * @since 1.0.0
 * @return bool
 */
function minimall_is_ffa_active() {
	return function_exists('faster_font_awesome_init');
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
	return class_exists('autoptimizeBase');
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
 * Author Widget
 */
require get_template_directory() . '/includes/widgets/widget-author.php';

/**
 * Author Widget
 */
require get_template_directory() . '/includes/widgets/widget-social-share.php';

/**
 * Social Share
 */
require get_template_directory() . '/includes/social-share.php';

/**
 * Performance 
 */
require get_template_directory() . '/includes/performance/performance-init.php';