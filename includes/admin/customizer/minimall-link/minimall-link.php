<?php
add_action( 'customize_register', function( $wp_customize ) {
	/**
	 * The custom control class
	 */
	class Kirki_Controls_Minimall_Link_Control extends WP_Customize_Control {

		public $type = 'tpfw_link';
        

        public function render_content() {

            echo '<span class="customize-control-title">' . esc_attr( $this->label ) . '</span>';

            $args = array(
                'type' => $this->type,
                'customize_link' => $this->get_link()
            );
            if ( !empty( $this->description ) ) {
                printf( '<span class="description customize-control-description">%s</span>', $this->description );
            }

            echo tpfw_form_link( $args, $this->value() );
               
        }
	}
	// Register our custom control with Kirki
	add_filter( 'kirki/control_types', function( $controls ) {
		$controls['tpfw_link'] = 'Kirki_Controls_Minimall_Link_Control';
		return $controls;
    } );

    add_action( 'in_admin_header', 'tpfw_link_editor_hidden' );
    add_action( 'customize_controls_print_footer_scripts', 'tpfw_link_editor_hidden' );

    function custom_customize_enqueue() {
        wp_enqueue_style( 'tpfw-admin', get_template_directory_uri() . '/includes/admin/customizer/minimall-link/css/admin.css', null, '1.0.0' );
        
        wp_enqueue_script( 'tpfw-libs', get_template_directory_uri() . '/includes/admin/customizer/minimall-link/js/libs.js', array( 'jquery','customize-controls' ), '1.0.0' );
        wp_enqueue_script( 'tpfw-admin', get_template_directory_uri() . '/includes/admin/customizer/minimall-link/js/admin_fields.js', array( 'jquery','customize-controls' ), '1.0.0' );
        wp_enqueue_script( 'dependency', get_template_directory_uri() . '/includes/admin/customizer/minimall-link/js/dependency.js', array( 'jquery', 'customize-controls' ), '1.0.0' );

        
        
        
    
        wp_enqueue_style( 'editor-buttons' );
        wp_enqueue_script( 'wplink' );
    }
    add_action( 'customize_controls_enqueue_scripts', 'custom_customize_enqueue' );

    function minimal_new_customizer_control_link() {
        wp_enqueue_style( 'tpfw-admin', get_template_directory_uri() . '/includes/admin/customizer/minimall-link/css/admin.css', null, '1.0.0' );
    }
    add_action( 'customize_controls_enqueue_styles', 'minimal_new_customizer_control_link' );
    
    
    
    

} );

function minimall_get_link_data($string){
    $output = array();
    foreach(explode("|", urldecode($string)) as $pair){
          $stuff  = explode(":", $pair, 2); 
          if( count($stuff) > 1 )
                $output[$stuff[0]] = $stuff[1];
    }

    if( !array_key_exists('url', $output) ){ $output['url'] = ''; }
    if( !array_key_exists('title', $output) ){ $output['title'] = ''; }
    if( !array_key_exists('target', $output) ){ $output['target'] = ''; }
    if( !array_key_exists('rel', $output) ){ $output['rel'] = ''; }

    return $output;
}


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

/**
 * Field Link
 *
 * @param $settings
 * @param string $value
 *
 * @since 1.0.0
 * @return string - html string.
 */
function tpfw_form_link( $settings, $value ) {
	
	ob_start();

	/**
	 * @var string Css Class
	 */
	$css_class = 'tpfw-field tpfw-link';

	if ( !empty( $settings['el_class'] ) ) {
		$css_class.=' ' . $settings['el_class'];
	}


	/**
	 * @var array Attributes
	 */
	$attrs = array();

	if ( !empty( $settings['name'] ) ) {
		$attrs[] = 'name="' . $settings['name'] . '"';
	}

	if ( !empty( $settings['id'] ) ) {
		$attrs[] = 'id="' . $settings['id'] . '"';
	}

	$attrs[] = 'data-type="' . $settings['type'] . '"';

	/**
	 * Support Customizer
	 */
	if ( !empty( $settings['customize_link'] ) ) {
		$attrs[] = $settings['customize_link'];
	}


	$link = tpfw_build_link( $value );

	$json_value = htmlentities( json_encode( $link ), ENT_QUOTES, 'utf-8' );

	$input_value = htmlentities( $value, ENT_QUOTES, 'utf-8' );
	?>
	<div class="<?php echo esc_attr( $css_class ) ?>" id="tpfw-link-<?php echo esc_attr( uniqid() ) ?>">

		<?php printf( '<input type="hidden" class="tpfw_value" value="%1$s" data-json="%2$s" %3$s/>', $input_value, $json_value, implode( ' ', $attrs ) ); ?>

		<a href="#" class="button link_button"><?php echo esc_attr__( 'Select URL', 'tp-framework' ) ?></a> 
		<span class="group_title">
			<span class="link_label_title link_label"><?php echo esc_attr__( 'Link Text:', 'tp-framework' ) ?></span> 
			<span class="title-label"><?php echo isset( $link['title'] ) ? esc_attr( $link['title'] ) : ''; ?></span> 
		</span>
		<span class="group_url">
			<span class="link_label"><?php echo esc_attr__( 'URL:', 'tp-framework' ) ?></span> 
			<span class="url-label">
				<?php
				echo isset( $link['url'] ) ? esc_url( $link['url'] ) : '';
				echo isset( $link['target'] ) ? ' ' . esc_attr( $link['target'] ) : '';
				?> 
			</span>
		</span>
	</div>
	<?php
	return ob_get_clean();
}

/**
 * Build Link from string
 * 
 * @param string $value
 *
 * @since 1.0.0
 * @return array
 */
function tpfw_build_link( $value ) {
	return tpfw_parse_multi_attribute( $value, array( 'url' => '', 'title' => '', 'target' => '', 'rel' => '' ) );
}

/**
 * Print link editor template
 * Link field need a hidden textarea to work
 * 
 * @since 1.0.0
 * @return void
 */
function tpfw_link_editor_hidden() {
	echo '<textarea id="content" class="hide hidden"></textarea>';
	require_once ABSPATH . "wp-includes/class-wp-editor.php";
	_WP_Editors::wp_link_dialog();
}
