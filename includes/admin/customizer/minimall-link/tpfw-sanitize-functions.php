<?php

/**
 * Sanitize functions
 * @package   Tpfw/Functions
 * @category  Functions
 * @author    ThemesPond
 * @license   GPLv3
 * @version   1.0.2
 */

/**
 * Sanitize text-transform css value
 * @since 1.0.2
 * 
 * @return string $value
 * @return string Value sanitized
 */
function tpfw_sanitize_text_transform( $value ) {

	$arr = array( 'none', 'capitalize', 'uppercase', 'lowercase', 'initial' );

	if ( !in_array( $value, $arr ) ) {
		return '';
	}

	return $value;
}

/**
 * Sanitize font variants value
 * @since 1.0.2
 * 
 * @return string $value
 * @return string Value sanitized
 */
function tpfw_sanitize_font_variants( $value ) {

	$variants = Tpfw_Fonts::get_all_variants();

	if ( is_string( $value ) && !array_key_exists( $value, $variants ) ) {
		return '';
	}
	return $value;
}

/**
 * Sanitize font subsets value
 * @since 1.0.2
 * 
 * @return string $value
 * @return string Value sanitized
 */
function tpfw_sanitize_font_subsets( $value ) {
	$subsets = Tpfw_Fonts::get_google_font_subsets();
	if ( is_string( $value ) && !array_key_exists( $value, $subsets ) ) {
		return '';
	}

	return $value;
}
