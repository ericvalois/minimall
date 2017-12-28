<?php
/**
 * Theme updater admin page and functions.
 *
 * @package Minimall
 */

/**
 * Redirect to Getting Started page on theme activation
 */
add_action( 'admin_init', 'minimall_redirect_on_activation' );
function minimall_redirect_on_activation() {
	global $pagenow;

	if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {

		wp_redirect( admin_url( "themes.php?page=minimall-license" ) );

	}
}

if ( ! function_exists( 'minimall_reset_customizer_settings' ) ) :
    /**
     * Reset customizer settings
     */
    add_action( 'admin_init', 'minimall_reset_customizer_settings' );
    function minimall_reset_customizer_settings() {
    
        if( empty( $_POST['minimall_reset_customizer'] ) || 'minimall_reset_customizer_settings' !== $_POST['minimall_reset_customizer'] )
            return;
    
        if( ! wp_verify_nonce( sanitize_key( $_POST['minimall_reset_customizer_nonce'] ), 'minimall_reset_customizer_nonce' ) )
            return;
    
        if( ! current_user_can( 'manage_options' ) )
            return;
    
        //delete_option('minimall_settings');
        //remove_theme_mod( 'font_body_variants' );
        //remove_theme_mod( 'font_body_category' );
        
        wp_safe_redirect( admin_url( 'themes.php?page=minimall-license&status=reset' ) ); exit;
    
    }
endif;

if ( ! function_exists( 'minimalladmin_errors' ) ) :
    /**
     * Add our admin notices
     */
    add_action( 'admin_notices', 'minimalladmin_errors' );
    function minimalladmin_errors() 
    {
        $screen = get_current_screen();
        if ( 'appearance_page_minimall-license' !== $screen->base )
            return;
            
        if ( isset( $_GET['settings-updated'] ) && 'true' == $_GET['settings-updated'] ) {
             add_settings_error( 'minimall-notices', 'true', __( 'Settings saved.', 'minimall' ), 'updated' );
        }
        
        if ( isset( $_GET['status'] ) && 'reset' == $_GET['status'] ) {
             add_settings_error( 'minimall-notices', 'reset', __( 'Settings removed.', 'minimall' ), 'updated' );
        }
    
        settings_errors( 'minimall-notices' );
    }
endif;

/**
 * Load Getting Started styles in the admin
 *
 * since 1.0.0
 */
add_action( 'admin_enqueue_scripts', 'minimall_start_load_admin_scripts' );
function minimall_start_load_admin_scripts() {

    $screen = get_current_screen();

	if( 'appearance_page_minimall-license' != $screen->base )
		return;

	// Getting Started javascript
	wp_enqueue_script( 'minimall-getting-started', get_template_directory_uri() . '/includes/admin/getting-started/getting-started.js', array( 'jquery' ), '1.0.0', true );

	// Getting Started styles
	wp_register_style( 'minimall-getting-started', get_template_directory_uri() . '/includes/admin/getting-started/getting-started.css', false, '1.0.0' );
	wp_enqueue_style( 'minimall-getting-started' );

	// Thickbox
	add_thickbox();
}

class Minimall_Theme_Updater_Admin {

	/**
	 * Variables required for the theme updater
	 *
	 * @since 1.0.0
	 * @type string
	 */
	 protected $remote_api_url = null;
	 protected $theme_slug = null;
	 protected $version = null;
	 protected $author = null;
	 protected $download_id = null;
	 protected $renew_url = null;
	 protected $strings = null;

	/**
	 * Initialize the class.
	 *
	 * @since 1.0.0
	 */
	function __construct( $config = array(), $strings = array() ) {

		$config = wp_parse_args( $config, array(
			'remote_api_url' => 'http://ttfb.io',
			'theme_slug' => get_template(),
            'api_slug'   => get_template(),
			'item_name' => '',
			'license' => '',
			'version' => '',
			'author' => '',
			'download_id' => '',
			'renew_url' => '',
			'beta' => false,
		) );

		// Set config arguments
		$this->remote_api_url = $config['remote_api_url'];
		$this->item_name = $config['item_name'];
		$this->theme_slug = sanitize_key( $config['theme_slug'] );
        $this->api_slug   = sanitize_key( $config['api_slug'] );
		$this->version = $config['version'];
		$this->author = $config['author'];
		$this->download_id = $config['download_id'];
		$this->renew_url = $config['renew_url'];
		$this->beta = $config['beta'];

		// Populate version fallback
		if ( '' == $config['version'] ) {
			$theme = wp_get_theme( $this->theme_slug );
			$this->version = $theme->get( 'Version' );
		}

		// Strings passed in from the updater config
		$this->strings = $strings;

		add_action( 'init', array( $this, 'updater' ) );
		add_action( 'admin_init', array( $this, 'register_option' ) );
        add_action( 'admin_init', array( $this, 'license_action' ) );
        
        // main option page
        //add_action( 'admin_menu', array( $this, 'main_option_menu' ) );

        add_action( 'admin_menu', array( $this, 'license_menu' ) );
		add_action( 'update_option_' . $this->theme_slug . '_license_key', array( $this, 'activate_license' ), 10, 2 );
		add_filter( 'http_request_args', array( $this, 'disable_wporg_request' ), 5, 2 );

	}

	/**
	 * Creates the updater class.
	 *
	 * since 1.0.0
	 */
	function updater() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		/* If there is no valid license key status, don't allow updates. */
		if ( get_option( $this->theme_slug . '_license_key_status', false) != 'valid' ) {
			return;
		}

		if ( !class_exists( 'Minimall_Theme_Updater' ) ) {
			// Load our custom theme updater
			include( dirname( __FILE__ ) . '/theme-updater-class.php' );
		}

		new Minimall_Theme_Updater(
			array(
				'remote_api_url' 	=> $this->remote_api_url,
				'version' 			=> $this->version,
				'license' 			=> trim( get_option( $this->theme_slug . '_license_key' ) ),
				'item_name' 		=> $this->item_name,
				'author'			=> $this->author,
				'beta'              => $this->beta
			),
			$this->strings
		);
	}

	function license_menu() {

		$strings = $this->strings;

		add_theme_page(
			$strings['theme-license'],
			$strings['theme-license'],
			'manage_options',
			$this->theme_slug . '-license',
			array( $this, 'license_page' )
        );
        
	}

	/**
	 * Outputs the markup used on the theme license page.
	 *
	 * since 1.0.0
	 */
	function license_page() {

		$strings = $this->strings;

		$license = trim( get_option( $this->theme_slug . '_license_key' ) );
		$status = get_option( $this->theme_slug . '_license_key_status', false );

		// Checks license status to display under license key
		if ( ! $license ) {
			$message    = $strings['enter-key'];
		} else {
			// delete_transient( $this->theme_slug . '_license_message' );
			if ( ! get_transient( $this->theme_slug . '_license_message', false ) ) {
				set_transient( $this->theme_slug . '_license_message', $this->check_license(), ( 60 * 60 * 24 ) );
			}
			$message = get_transient( $this->theme_slug . '_license_message' );
		}


        $theme = wp_get_theme( 'minimall' );
		?>



        <div class="wrap getting-started">
				<h2 class="notices"></h2>
				<div class="intro-wrap">
					<div class="intro">
						<h3>
                            <?php echo esc_html__( 'Getting Started with', 'minimall' ); ?>
                            <strong><?php echo esc_html($theme['Name']); ?> <sup><?php echo $this->version; ?></sup></strong>
                        </h3>

						<h4><?php printf( esc_html__( 'You will find everything you need to get started with Minimall below.', 'minimall' ), $theme['Name'] ); ?></h4>
					</div>
				</div>

				<div class="panels">
					<ul class="inline-list">
						<li class="current"><a id="help-tab" href="#"><?php esc_html_e( 'Quick Setup', 'minimall' ); ?></a></li>
                        <li><a id="getting-started" href="#"><?php esc_html_e( 'Complete Setup', 'minimall' ); ?></a></li>
                        <li><a id="plugins-tab" href="#"><?php esc_html_e( 'Plugins', 'minimall' ); ?></a></li>
						<li><a id="updates-tab" href="#"><?php esc_html_e( 'What’s New', 'minimall' ); ?></a></li>
					</ul>

					<div id="panel" class="panel">

						<!-- Help file panel -->
						<div id="help-panel" class="panel-left visible">

                            <h2><?php _e('1. Install required plugins','minimall'); ?></h2>

                            <div class="lg-flex flex-wrap bg-gray mb4 pt3">
                                <div class="lg-col-12 mb3 px3">

                                    <p><?php _e('The best way to get started quickly is to install and activate all the required plugins.','minimall'); ?></p>

                                    <p><?php _e('Then and only then proceed to step #2 to import the demo.','minimall'); ?></p>

                                    <a href="<?php echo admin_url( 'themes.php?page=tgmpa-install-plugins' ); ?>" class="button button-primary"><?php _e('Install all plugins','minimall'); ?></a>
                                </div>
                            </div>

                            <h2><?php _e('2. Demo import','minimall'); ?></h2>

                            <div class="lg-flex flex-wrap bg-gray mb4 pt3">
                                <div class="lg-col-12 mb3 px3">
                                    <p><?php _e('Once all the required plugins are installed and activated, you can safely import the demo.','minimall'); ?></p>

                                    <p><?php _e('This option will replicate the <a target="_blank" href="https://minimall.ttfb.io/">Minimall demo</a> site, giving you a better overview of Minimall’s features.','minimall'); ?></p>

                                    <?php if( minimall_is_theme_demo_import_active() ): ?>
                                        <a href="<?php echo admin_url( 'themes.php?page=theme-demo-import' ); ?>" class="button button-primary"><?php _e('Import Demo Content','minimall'); ?></a>
                                    <?php else: ?>
                                        <button disabled class="button button-primary"><?php _e('Install required plugins first','minimall'); ?></button>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <h2><?php _e('3. Activate your license','minimall'); ?></h2>

                            <div class="lg-flex flex-wrap bg-gray mb4 pt3">
                                <div class="lg-col-12 mb3 px3">
                                    <p><?php _e('With an active license, you can get seamless, one-click theme updates to keep your site healthy and happy.','minimall'); ?></p>
                                    <p><?php _e('You should have received your key by email after your purchase. If not, you can find your license key in your <a target="_blank" href="https://ttfb.io/dashboard">TTFB Dashboard</a>.','minimall'); ?></p>
                                </div>
                            </div>

                            <h2><?php _e('4. That\'s all','minimall'); ?></h2>

                            <div class="lg-flex flex-wrap bg-gray mb4 pt3">
                                <div class="lg-col-12 mb3 px3">
                                    <p><?php _e('There aren’t any more steps. You are now free to disable the plugins you don’t need and to delete irrelevant posts and pages.','minimall'); ?></p>

                                    <p><?php _e('Refer to our complete <a href="https://ttfb.io/documentation/" target="_blank">documentation</a> for specific needs.','minimall') ?></p>
                                </div>
                            </div>

						</div>

                        <!-- Getting Started full -->
						<div id="getting-started" class="panel-left">
                    
                            <?php
                                $minimall_getting_started = wp_remote_get('https://ttfb.io/wp-json/wp/v2/knowledgebase/1412/');

                                // Make sure the response came back okay.
                                if( is_wp_error( $minimall_getting_started ) ) {
                                    return false; // Bail early
                                }

                                $body = wp_remote_retrieve_body( $minimall_getting_started );
                                $data = json_decode( $body );

                                if( ! empty( $data ) ) {
                                    echo $data->content->rendered;
                                }
                            ?>

						</div>
                        
                        <!-- Plugins panel -->
						<div id="plugins-panel" class="panel-left">
                            <?php
                                $minimall_plugins = wp_remote_get('https://ttfb.io/wp-json/wp/v2/knowledgebase/1293/');

                                // Make sure the response came back okay.
                                if( is_wp_error( $minimall_plugins ) ) {
                                    return false; // Bail early
                                }

                                $body = wp_remote_retrieve_body( $minimall_plugins );
                                $data = json_decode( $body );

                                if( ! empty( $data ) ) {
                                    echo $data->content->rendered;
                                }
                            ?>

                            
						</div><!-- .panel-left plugins -->
                        
                        <?php
                            // Grab the change log from ttfb.io for display in the Latest Updates tab
                            $changelog = wp_remote_get( 'https://ttfb.io/themes/' . $this->api_slug . '/changelog/' );
                            if( $changelog && !is_wp_error( $changelog ) && 200 === wp_remote_retrieve_response_code( $changelog ) ) {
                                $changelog = $changelog['body'];
                            } else {
                                $changelog = esc_html__( 'There seems to be a temporary problem retrieving the latest updates for this theme. You can always view the latest updates in your Array Dashboard.', 'minimall' );
                            }
                        ?>
						<!-- Updates panel -->
						<div id="updates-panel" class="panel-left">
							<p><?php echo $changelog; ?></p>
                        </div><!-- .panel-left updates -->
                        
                        
						

						<div class="panel-right">

                            <?php // Customize Button ?>
                            <div class="bg-gray py3 px3 mb3">
                                <a href="<?php echo wp_customize_url(); ?>" class="button button-primary master-button customize-button"><?php esc_html_e( 'Customize Minimall', 'minmall' ); ?></a>
                            </div>

                            <!-- Activate license -->
							<div class="bg-gray py3 px3 mb3">
                                
								<?php if ( 'valid' == $status ) { ?>

								<h4><?php esc_html_e( 'Sweet, your license is active!', 'minimall' ); ?></h4>

								<p><?php esc_html_e( 'You will receive a notice on your Themes page when a theme update is available.', 'minimall' ); ?></p>

								<?php } else { ?>
									<h3 class="line-height-3">
                                        <span class=""><?php esc_html_e( 'Activate your license to enable theme updates!', 'minimall' ); ?></span>
                                        
                                    </h3>

								<p>
									<?php esc_html_e( 'With an active license, you can get seamless, one-click theme updates to keep your site healthy and happy. ', 'minimall' );

										$license_link = 'https://ttfb.io/dashboard';
										printf( __( 'Find your license key in your <a target="_blank" href="%s">TTFB Dashboard</a>.', 'minimall' ), esc_url( $license_link ) );
									?>
								</p>
								<?php } ?>

								<!-- License setting -->
								<form method="post" action="options.php" class="enter-license">

                                    <?php settings_fields( $this->theme_slug . '-license' ); ?>

                                    <?php //echo $strings['license-key']; ?>
                                    
                                    <?php if( !empty($message) && 1 == 2 ): ?>
                                        <div class="description">
                                            <?php echo $message; ?>
                                        </div>
                                        <br>
                                    <?php endif; ?>

                                    <input placeholder="<?php esc_html_e('Enter your theme license key','minimall'); ?>" id="<?php echo $this->theme_slug; ?>_license_key" name="<?php echo $this->theme_slug; ?>_license_key" type="text" class="regular-text license-key-input <?php if ( 'valid' == $status ) { echo 'valid'; } ?><?php if ( 'invalid' == $status ) { echo 'invalid'; } ?>" value="<?php echo esc_attr( $license ); ?>" />

                                    <?php if ( $license ) : ?>
                                        <div class="wrap_license_action">
                                            <?php wp_nonce_field( $this->theme_slug . '_nonce', $this->theme_slug . '_nonce' ); ?>

                                            <span class="label"><?php echo $strings['license-action']; ?></span>
                                            
                                            <?php if ( 'valid' == $status ) : ?>
                                                <input type="submit" class="button-secondary" name="<?php echo $this->theme_slug; ?>_license_deactivate" value="<?php esc_attr_e( $strings['deactivate-license'] ); ?>"/>
                                            <?php else: ?>
                                                <input type="submit" class="button-secondary" name="<?php echo $this->theme_slug; ?>_license_activate" value="<?php esc_attr_e( $strings['activate-license'] ); ?>"/>
                                            <?php endif; ?>
                                        </div>

                                    <?php endif; ?>

                                    <p class="">
                                        <input type="submit" name="submit" id="submit" class="button button-primary master-button" value="Save Changes">
                                    </p>
                                </form>

                            </div><!-- .panel-aside license -->
                            
                            <?php if ( version_compare(PHP_VERSION, '7', '<') ): ?>
                                <div class="panel-aside warning">
                                    <h3><?php esc_html_e( 'Page Speed Issue Detected', 'minimall' ); ?></h3>
                                    <p><?php esc_html_e("It seems that PHP7 is not enabled. PHP7 could dramatically speed-up your site! We suggest that you contact your web hosting provider to activate it."); ?></p>
                                </div>
                            <?php endif; ?>
                            
                            <!--
							<div class="border border-gray px2 py2 muted muted-box">
								
								<div class="panel-club-inside">
                                    <h3 class=""><?php esc_html_e( 'Delete Minimall Options', 'minimall' ); ?></h3>
                                    
                                    <p><?php printf( __( '<strong>Warning:</strong> Deleting your <a href="%1$s">Customizer</a> settings can not be undone.','minimall' ), admin_url('customize.php') ); ?></p>
									<p><?php _e( 'Consider creating a backup of your settings before deleting them.','minimall');?></p>
									<form method="post">
										<p><input type="hidden" name="minimall_reset_customizer" value="minimall_reset_customizer_settings" /></p>
										<p>
											<?php 
											$warning = 'return confirm("' . __( 'Warning: This will delete your settings.','minimall' ) . '")';
											wp_nonce_field( 'minimall_reset_customizer_nonce', 'minimall_reset_customizer_nonce' );
											submit_button( __( 'Delete Default Settings', 'minimall' ), 'button red', 'submit', false, array( 'onclick' => esc_js( $warning ) ) ); 
											?>
										</p>
											
									</form>
									<?php do_action('minimall_delete_settings_form');?>
                                    
								</div>
							</div>
                            -->
							
						</div><!-- .panel-right -->
					</div><!-- .panel -->
				</div><!-- .panels -->
			</div><!-- .getting-started -->





            
	
			
		<?php
	}

	/**
	 * Registers the option used to store the license key in the options table.
	 *
	 * since 1.0.0
	 */
	function register_option() {
		register_setting(
			$this->theme_slug . '-license',
			$this->theme_slug . '_license_key',
			array( $this, 'sanitize_license' )
		);
	}

	/**
	 * Sanitizes the license key.
	 *
	 * since 1.0.0
	 *
	 * @param string $new License key that was submitted.
	 * @return string $new Sanitized license key.
	 */
	function sanitize_license( $new ) {

		$old = get_option( $this->theme_slug . '_license_key' );

		if ( $old && $old != $new ) {
			// New license has been entered, so must reactivate
			delete_option( $this->theme_slug . '_license_key_status' );
			delete_transient( $this->theme_slug . '_license_message' );
		}

		return $new;
	}

	/**
	 * Makes a call to the API.
	 *
	 * @since 1.0.0
	 *
	 * @param array $api_params to be used for wp_remote_get.
	 * @return array $response decoded JSON response.
	 */
	 function get_api_response( $api_params ) {

		// Call the custom API.
		$verify_ssl = (bool) apply_filters( 'edd_sl_api_request_verify_ssl', true );
		$response   = wp_remote_post( $this->remote_api_url, array( 'timeout' => 15, 'sslverify' => $verify_ssl, 'body' => $api_params ) );

		// Make sure the response came back okay.
		if ( is_wp_error( $response ) ) {
			wp_die( $response->get_error_message(), __( 'Error' ) . $response->get_error_code() );
		}

		return $response;
	 }

	/**
	 * Activates the license key.
	 *
	 * @since 1.0.0
	 */
	function activate_license() {

		$license = trim( get_option( $this->theme_slug . '_license_key' ) );

		// Data to send in our API request.
		$api_params = array(
			'edd_action' => 'activate_license',
			'license'    => $license,
			'item_name'  => urlencode( $this->item_name ),
			'url'        => home_url()
		);

		$response = $this->get_api_response( $api_params );

		// make sure the response came back okay
		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

			if ( is_wp_error( $response ) ) {
				$message = $response->get_error_message();
			} else {
				$message = __( 'An error occurred, please try again.' );
			}

		} else {

			$license_data = json_decode( wp_remote_retrieve_body( $response ) );

			if ( false === $license_data->success ) {

				switch( $license_data->error ) {

					case 'expired' :

						$message = sprintf(
							__( 'Your license key expired on %s.' ),
							date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires, current_time( 'timestamp' ) ) )
						);
						break;

					case 'revoked' :

						$message = __( 'Your license key has been disabled.' );
						break;

					case 'missing' :

						$message = __( 'Invalid license.' );
						break;

					case 'invalid' :
					case 'site_inactive' :

						$message = __( 'Your license is not active for this URL.' );
						break;

					case 'item_name_mismatch' :

						$message = sprintf( __( 'This appears to be an invalid license key for %s.' ), $args['name'] );
						break;

					case 'no_activations_left':

						$message = __( 'Your license key has reached its activation limit.' );
						break;

					default :

						$message = __( 'An error occurred, please try again.' );
						break;
				}

				if ( ! empty( $message ) ) {
					$base_url = admin_url( 'themes.php?page=' . $this->theme_slug . '-license' );
					$redirect = add_query_arg( array( 'sl_theme_activation' => 'false', 'message' => urlencode( $message ) ), $base_url );

					wp_redirect( $redirect );
					exit();
				}

			}

		}

		// $response->license will be either "active" or "inactive"
		if ( $license_data && isset( $license_data->license ) ) {
			update_option( $this->theme_slug . '_license_key_status', $license_data->license );
			delete_transient( $this->theme_slug . '_license_message' );
		}

		wp_redirect( admin_url( 'themes.php?page=' . $this->theme_slug . '-license' ) );
		exit();

	}

	/**
	 * Deactivates the license key.
	 *
	 * @since 1.0.0
	 */
	function deactivate_license() {

		// Retrieve the license from the database.
		$license = trim( get_option( $this->theme_slug . '_license_key' ) );

		// Data to send in our API request.
		$api_params = array(
			'edd_action' => 'deactivate_license',
			'license'    => $license,
			'item_name'  => urlencode( $this->item_name ),
			'url'        => home_url()
		);

		$response = $this->get_api_response( $api_params );

		// make sure the response came back okay
		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

			if ( is_wp_error( $response ) ) {
				$message = $response->get_error_message();
			} else {
				$message = __( 'An error occurred, please try again.' );
			}

		} else {

			$license_data = json_decode( wp_remote_retrieve_body( $response ) );

			// $license_data->license will be either "deactivated" or "failed"
			if ( $license_data && ( $license_data->license == 'deactivated' ) ) {
				delete_option( $this->theme_slug . '_license_key_status' );
				delete_transient( $this->theme_slug . '_license_message' );
			}

		}

		if ( ! empty( $message ) ) {
			$base_url = admin_url( 'themes.php?page=' . $this->theme_slug . '-license' );
			$redirect = add_query_arg( array( 'sl_theme_activation' => 'false', 'message' => urlencode( $message ) ), $base_url );

			wp_redirect( $redirect );
			exit();
		}

		wp_redirect( admin_url( 'themes.php?page=' . $this->theme_slug . '-license' ) );
		exit();

	}

	/**
	 * Constructs a renewal link
	 *
	 * @since 1.0.0
	 */
	function get_renewal_link() {

		// If a renewal link was passed in the config, use that
		if ( '' != $this->renew_url ) {
			return $this->renew_url;
		}

		// If download_id was passed in the config, a renewal link can be constructed
		$license_key = trim( get_option( $this->theme_slug . '_license_key', false ) );
		if ( '' != $this->download_id && $license_key ) {
			$url = esc_url( $this->remote_api_url );
			$url .= '/checkout/?edd_license_key=' . $license_key . '&download_id=' . $this->download_id;
			return $url;
		}

		// Otherwise return the remote_api_url
		return $this->remote_api_url;

	}



	/**
	 * Checks if a license action was submitted.
	 *
	 * @since 1.0.0
	 */
	function license_action() {

		if ( isset( $_POST[ $this->theme_slug . '_license_activate' ] ) ) {
			if ( check_admin_referer( $this->theme_slug . '_nonce', $this->theme_slug . '_nonce' ) ) {
				$this->activate_license();
			}
		}

		if ( isset( $_POST[$this->theme_slug . '_license_deactivate'] ) ) {
			if ( check_admin_referer( $this->theme_slug . '_nonce', $this->theme_slug . '_nonce' ) ) {
				$this->deactivate_license();
			}
		}

	}

	/**
	 * Checks if license is valid and gets expire date.
	 *
	 * @since 1.0.0
	 *
	 * @return string $message License status message.
	 */
	function check_license() {

		$license = trim( get_option( $this->theme_slug . '_license_key' ) );
		$strings = $this->strings;

		$api_params = array(
			'edd_action' => 'check_license',
			'license'    => $license,
			'item_name'  => urlencode( $this->item_name ),
			'url'        => home_url()
		);

		$response = $this->get_api_response( $api_params );

		// make sure the response came back okay
		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

			if ( is_wp_error( $response ) ) {
				$message = $response->get_error_message();
			} else {
				$message = $strings['license-status-unknown'];
			}

		} else {

			$license_data = json_decode( wp_remote_retrieve_body( $response ) );

			// If response doesn't include license data, return
			if ( !isset( $license_data->license ) ) {
				$message = $strings['license-status-unknown'];
				return $message;
			}

			// We need to update the license status at the same time the message is updated
			if ( $license_data && isset( $license_data->license ) ) {
				update_option( $this->theme_slug . '_license_key_status', $license_data->license );
			}

			// Get expire date
			$expires = false;
			if ( isset( $license_data->expires ) && 'lifetime' != $license_data->expires ) {
				$expires = date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires, current_time( 'timestamp' ) ) );
				$renew_link = '<a href="' . esc_url( $this->get_renewal_link() ) . '" target="_blank">' . $strings['renew'] . '</a>';
			} elseif ( isset( $license_data->expires ) && 'lifetime' == $license_data->expires ) {
				$expires = 'lifetime';
			}

			// Get site counts
            if( isset( $license_data->site_count ) ){
                $site_count = $license_data->site_count;
            }else{
                $site_count = false;
            }
			
            if( isset( $license_data->license_limit ) ){
                $license_limit = $license_data->license_limit;
            }else{
                $license_limit = false;
            }
			

			// If unlimited
			if ( 0 == $license_limit ) {
				$license_limit = $strings['unlimited'];
			}

			if ( $license_data->license == 'valid' ) {
				$message = $strings['license-key-is-active'] . ' ';
				if ( isset( $expires ) && 'lifetime' != $expires ) {
					$message .= sprintf( $strings['expires%s'], $expires ) . ' ';
				}
				if ( isset( $expires ) && 'lifetime' == $expires ) {
					$message .= $strings['expires-never'];
				}
				if ( $site_count && $license_limit ) {
					$message .= sprintf( $strings['%1$s/%2$-sites'], $site_count, $license_limit );
				}
			} else if ( $license_data->license == 'expired' ) {
				if ( $expires ) {
					$message = sprintf( $strings['license-key-expired-%s'], $expires );
				} else {
					$message = $strings['license-key-expired'];
				}
				if ( $renew_link ) {
					$message .= ' ' . $renew_link;
				}
			} else if ( $license_data->license == 'invalid' ) {
				$message = $strings['license-keys-do-not-match'];
			} else if ( $license_data->license == 'inactive' ) {
				$message = $strings['license-is-inactive'];
			} else if ( $license_data->license == 'disabled' ) {
				$message = $strings['license-key-is-disabled'];
			} else if ( $license_data->license == 'site_inactive' ) {
				// Site is inactive
				$message = $strings['site-is-inactive'];
			} else {
				$message = $strings['license-status-unknown'];
			}

		}

		return $message;
	}

	/**
	 * Disable requests to wp.org repository for this theme.
	 *
	 * @since 1.0.0
	 */
	function disable_wporg_request( $r, $url ) {

		// If it's not a theme update request, bail.
		if ( 0 !== strpos( $url, 'https://api.wordpress.org/themes/update-check/1.1/' ) ) {
 			return $r;
 		}

 		// Decode the JSON response
 		$themes = json_decode( $r['body']['themes'] );

 		// Remove the active parent and child themes from the check
 		$parent = get_option( 'template' );
 		$child = get_option( 'stylesheet' );
 		unset( $themes->themes->$parent );
 		unset( $themes->themes->$child );

 		// Encode the updated JSON response
 		$r['body']['themes'] = json_encode( $themes );

 		return $r;
	}

}

/**
 * This is a means of catching errors from the activation method above and displyaing it to the customer
 */
function edd_sample_theme_admin_notices() {
	if ( isset( $_GET['sl_theme_activation'] ) && ! empty( $_GET['message'] ) ) {

		switch( $_GET['sl_theme_activation'] ) {

			case 'false':
				$message = urldecode( $_GET['message'] );
				?>
				<div class="error">
					<p><?php echo $message; ?></p>
				</div>
				<?php
				break;

			case 'true':
			default:

				break;

		}
	}
}
add_action( 'admin_notices', 'edd_sample_theme_admin_notices' );