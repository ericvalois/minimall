<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package EDD Sample Theme
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'Minimall_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// The theme version to use in the updater
define( 'MINIMALL_SL_THEME_VERSION', wp_get_theme( 'minimall' )->get( 'Version' ) );

// Loads the updater classes
$updater = new Minimall_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'https://ttfb.io', // Site where EDD is hosted
		'item_name'      => 'Minimall', // Name of theme
		'theme_slug'     => 'minimall', // Theme slug
		'version'        => MINIMALL_SL_THEME_VERSION, // The current version of this theme
		'minimall'         => 'TTFB', // The author of this theme
		'download_id'    => '', // Optional, used for generating a license renewal link
		'renew_url'      => '', // Optional, allows for a custom license renewal link
        'beta'           => false, // Optional, set to true to opt into beta versions
	),

	// Strings
	$strings = array(
		'theme-license'             => __( 'Getting Started', 'minimall' ),
		'enter-key'                 => __( 'Enter your theme license key.', 'minimall' ),
		'license-key'               => __( 'Enter your license key', 'minimall' ),
		'license-action'            => __( 'License action:', 'minimall' ),
		'deactivate-license'        => __( 'Deactivate License', 'minimall' ),
		'activate-license'          => __( 'Activate License', 'minimall' ),
		'save-license'              => __( 'Save License', 'minimall' ),
		'status-unknown'            => __( 'License status is unknown.', 'minimall' ),
		'renew'                     => __( 'Renew?', 'minimall' ),
		'unlimited'                 => __( 'unlimited', 'minimall' ),
		'license-key-is-active'     => __( 'Theme updates have been enabled. You will receive a notice on your Themes page when a theme update is available.', 'minimall' ),
		'expires%s'                 => __( 'Your license for Author expires %s.', 'minimall' ),
		'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'minimall' ),
		'license-key-expired-%s'    => __( 'License key expired %s.', 'minimall' ),
		'license-key-expired'       => __( 'License key has expired.', 'minimall' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'minimall' ),
		'license-is-inactive'       => __( 'License is inactive.', 'minimall' ),
		'license-key-is-disabled'   => __( 'License key is disabled.', 'minimall' ),
		'site-is-inactive'          => __( 'Site is inactive.', 'minimall' ),
		'license-status-unknown'    => __( 'License status is unknown.', 'minimall' ),
		'update-notice'             => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'minimall' ),
		'update-available'          => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'minimall' )
	)

);