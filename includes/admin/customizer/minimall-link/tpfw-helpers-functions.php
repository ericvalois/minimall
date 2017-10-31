<?php

/**
 * Helper functions
 *
 * @package   Tpfw/Functions
 * @category  Functions
 * @author    ThemesPond
 * @license   GPLv3
 * @version   1.0.0
 */

/**
 * Parse string like "title:Tpfw is useful|author:ThemesPond" to array('title' => 'Tpfw is useful', 'author' => 'ThemesPond')
 *
 * @param $value
 * @param array $default
 *
 * @since 1.0.0
 * @return array
 */
function tpfw_parse_multi_attribute( $value, $default = array() ) {
	$result = $default;
	$params_pairs = explode( '|', $value );
	if ( !empty( $params_pairs ) ) {
		foreach ( $params_pairs as $pair ) {
			$param = preg_split( '/\:/', $pair );
			if ( !empty( $param[0] ) && isset( $param[1] ) ) {
				$result[$param[0]] = rawurldecode( $param[1] );
			}
		}
	}

	return $result;
}

/**
 * Shortcut method to get the translation strings
 * @since 1.0.0
 * @param string $config_id The config ID.
 * @return array
 * @deprecated since 1.0.2
 */
function tpfw_l10n_get_strings( $config_id = 'global' ) {
	return array();
}

/**
 * Sanitize checkbox is multiple
 * @since 1.0
 * @return array
 */
function tpfw_sanitize_checkbox_multiple( $value ) {

	if ( empty( $value ) ) {
		$value = array();
	}

	if ( is_string( $value ) ) {
		$value = explode( ',', $value );
	}
	
	return $value;
}


/**
 * Convert typography from string to array
 * 
 * @param string $value
 *
 * @since 1.0.0
 * @return array
 */
function tpfw_build_typography( $value ) {
	$subfields = array(
		'font-family' => '',
		'variants' => '',
		'subsets' => '',
		'line-height' => '',
		'font-size' => '',
		'letter-spacing' => '',
		'text-transform' => '',
	);

	if ( is_string( $value ) ) {
		$value = json_decode( urldecode( $value ), true );
	}
	
	if ( empty( $value ) ) {
		$value = $subfields;
	}

	if ( is_array( $value ) ) {
		$value = wp_parse_args( $value, $subfields );
	}

	$value['font-family'] = sanitize_text_field( $value['font-family'] );
	$value['variants'] = tpfw_sanitize_font_variants( $value['variants'] );
	$value['subsets'] = tpfw_sanitize_font_subsets( $value['subsets'] );
	$value['line-height'] = sanitize_text_field( $value['line-height'] );
	$value['font-size'] = sanitize_text_field( $value['font-size'] );
	$value['letter-spacing'] = sanitize_text_field( $value['letter-spacing'] );
	$value['text-transform'] = tpfw_sanitize_text_transform( $value['text-transform'] );

	return $value;
}



/**
 * Get gallery from field gallery value
 * @since 1.0.2
 * @return array
 */
function tpfw_get_gallery_image_ids( $value ) {
	if ( !empty( $value ) ) {
		$ids = array();
		$value = explode( ',', $value );
		foreach ( $value as $img ) {
			$img = explode( '|', $img );
			$ids[] = $img[0];
		}
		return $ids;
	}
	return array();
}