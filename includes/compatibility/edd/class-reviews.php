<?php
/**
 * EDD - Reviews
 */
class Minimall_EDD_Reviews {

	/**
	 * Get things started.
	 *
	 * @access public
	 * @since  1.0.0
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'styles' ) );
        add_filter( 'body_class', array( $this, 'body_classes' ) );
        
        //$reviews = new EDD_Reviews;
        //remove_filter( 'the_content', 'edd_reviews_load_frontend', 999);
        //add_action('minimall_edd_reviews','edd_reviews_load_frontend');
	}

	/**
	 * Styles.
	 *
	 * @access public
	 * @since  1.0.0
	*/
	public function styles() {

		// Dequeue styles
		wp_dequeue_style( 'edd-reviews' );

		// Get the suffix (.min) if SCRIPT_DEBUG is enabled.
		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		// Get the file path of the CSS file.
		$file_path = '/assets/css/edd-reviews' . $suffix . '.css';

		// Register the styles.
		wp_register_style( 'minimall-edd-reviews', get_theme_file_uri( $file_path ), array( 'dashicons' ), filemtime( get_theme_file_path( $file_path ) ), 'all' );

		// Enqueue the styles.
		wp_enqueue_style( 'minimall-edd-reviews' );

	}

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @access public
	 * @since  1.0.0
	 */
	public function body_classes( $classes ) {
		global $post;

		if ( is_page( edd_get_option( 'edd_reviews_vendor_feedback_page' ) ) ) {
			$classes[] = 'vendor-feedback';
		}

		return $classes;
    }

}
new Minimall_EDD_Reviews;


    
