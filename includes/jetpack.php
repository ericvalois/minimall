<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package minimal
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function light_bold_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'light_bold_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function light_bold_jetpack_setup
add_action( 'after_setup_theme', 'light_bold_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function light_bold_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'components/content', get_post_format() );
	}
} // end function light_bold_infinite_scroll_render
