<?php

/**
 * Customizer Framework
 *
 * @class     Tpfw_Customize_Field
 * @package   Tpfw/Classes
 * @category  Class
 * @author    ThemesPond
 * @license   GPLv3
 * @version   1.0.0
 */
if ( !class_exists( 'Tpfw_Customize_Field' ) ) {

	/**
	 * Tpfw_Customize_Field Class
	 */
	class Tpfw_Customize_Field {

		/**
		 * @access private
		 * @var array customize global
		 */
		private $wp_customize;

		/**
		 * Init
		 */
		public function __construct( $wp_customize, $args = array() ) {

			$this->wp_customize = $wp_customize;

			//Add setting
			$this->add_setting( $args );

			//Add control
			$this->add_control( $args );

			//Add partial
			$this->add_partial( $args );

			if ( isset( $args['dependency'] ) ) {

				global $tpfw_customizer_dependency;

				$key = key( $args['dependency'] );

				if ( !isset( $tpfw_customizer_dependency[$key] ) ) {
					$tpfw_customizer_dependency[$key] = array();
					
					$master = $wp_customize->get_control($key);
					$multiple = !empty( $master->multiple) ? '_multiple' : '';
					$tpfw_customizer_dependency[$key]['type'] = $master->type . $multiple;
				}

				$tpfw_customizer_dependency[$key]['elements'][$args['name']] = $args['dependency'][$key];
			}
		}

		private function add_control( $args ) {

			if ( isset( $args['heading'] ) ) {
				$args['label'] = $args['heading'];
				unset( $args['heading'] );
			}

			if ( isset( $args['options'] ) ) {
				$args['choices'] = $args['options'];
				unset( $args['options'] );
			}

			if ( isset( $args['desc'] ) ) {
				$args['description'] = $args['desc'];
				unset( $args['desc'] );
			}

			$defaults = array(
				'label' => '',
				'section' => '',
				'type' => '',
				'multiple' => 0,
				'priority' => '',
				'choices' => array(),
				'fields' => array(),
				'description' => ''
			);

			$control_args = wp_parse_args( $args, $defaults );

			if ( $control_args['section'] instanceof Tpfw_Customize_Section ) {
				$control_args['section'] = $control_args['section']->id();
			}

			if ( $control_args['type'] == 'textfield' ) {
				$control_args['type'] = 'text';
			} elseif ( $control_args['type'] == 'image_picker' ) {
				$control_args['type'] = 'image';
			} else if ( $control_args['type'] == 'color_picker' ) {
				$control_args['type'] = 'color';
			}

			$control_name = isset( $args['name'] ) ? $args['name'] : '';

			// Get the name of the class we're going to use.
			$class_name = $this->control_class_name( $control_args );

			//Add to global registed fields
			global $tpfw_registered_fields;
			$tpfw_registered_fields[] = $control_args['type'];

			if ( $class_name == 'Tpfw_Customize_Select_Control' ) {
				unset( $control_args['type'] );
			}

			// Add the control.
			$this->wp_customize->add_control( new $class_name( $this->wp_customize, $control_name, $control_args ) );
		}

		private function add_setting( $args ) {

			$field_type = $args['type'];

			if ( isset( $args['value'] ) ) {
				$args['default'] = $args['value'];
				unset( $args['value'] );
			}

			if ( isset( $args['setting_type'] ) ) {
				$args['type'] = $args['setting_type'];
			} else {
				unset( $args['type'] );
			}

			if ( isset( $args['id'] ) ) {
				unset( $args['id'] );
			}

			$args['name'] = isset( $args['name'] ) ? $args['name'] : '';

			/**
			 * Default settings
			 * @type Array
			 */
			$defaults = get_class_vars( 'WP_Customize_Setting' );

			$args = wp_parse_args( $args, $defaults );

			if ( $field_type == 'checkbox' && !empty( $args['multiple'] ) ) {
				if ( empty( $args['sanitize_callback'] ) ) {
					$args['sanitize_callback'] = 'tpfw_sanitize_checkbox_multiple';
				}

				if ( empty( $args['sanitize_js_callback'] ) ) {
					$args['sanitize_js_callback'] = 'tpfw_sanitize_checkbox_multiple';
				}
			}

			$this->wp_customize->add_setting( $args['name'], $args );
		}

		public function add_partial( $args ) {
			if ( !empty( $args['partial'] ) ) {
				$this->wp_customize->selective_refresh->add_partial( $args['name'], $args['partial'] );
			}
		}

		private function control_class_name( $args ) {

			$class_name = 'WP_Customize_Control';

			$type = $args['type'];

			if ( $type == 'checkbox' && absint( $args['multiple'] ) === 1 ) {
				$type = 'tpfw_multicheck';
			} else {
				if ( !in_array( $args['type'], array( 'image', 'cropped_image', 'upload', 'color' ) ) ) {
					$type = 'tpfw_' . $type;
				}
			}

			global $tpfw_control_types;



			if ( !empty( $tpfw_control_types ) && array_key_exists( $type, $tpfw_control_types ) ) {
				$class_name = $tpfw_control_types[$type];
			}

			return $class_name;
		}

	}

}

if ( !class_exists( 'Tpfw_Customize_Section' ) ) {

	/**
	 * Tpfw_Customize_Section Class
	 */
	class Tpfw_Customize_Section {

		/**
		 * @access public
		 * @var array customize settings
		 */
		private $settings = array();

		/**
		 * @access private
		 * @var array customize global
		 */
		private $wp_customize;

		/**
		 * Section ID
		 * @var $id string
		 */
		private $id;

		/**
		 * Init
		 */
		public function __construct( $wp_customize, $args ) {

			if ( !empty( $args ) ) {

				$defaults = array(
					'panel' => '',
					'id' => '',
					'heading' => '',
					'description' => '',
					'priority' => 160,
					'capability' => 'edit_theme_options',
					'theme_supports' => '', // Rarely needed.
					'fields' => array()
				);


				$this->settings = wp_parse_args( $args, $defaults );

				$this->id = $this->settings['id'];

				$this->wp_customize = $wp_customize;

				$this->ouput();
			}
		}

		public function id() {
			return $this->id;
		}

		/**
		 * Section Output
		 */
		private function ouput() {

			$args = $this->settings;

			if ( isset( $args['heading'] ) ) {
				$args['title'] = $args['heading'];
				unset( $args['heading'] );
			}

			if ( $args['panel'] instanceof Tpfw_Customize_Panel ) {
				$args['panel'] = $args['panel']->id();
			}

			$this->wp_customize->add_section( $args['id'], $args );

			$this->add_fields( $args['fields'] );
		}

		public function add_fields( $fields = array() ) {
			foreach ( $fields as $field ) {
				$this->add_field( $field );
			}
		}

		public function add_field( $args = array() ) {
			$args['section'] = $this->id();
			new Tpfw_Customize_Field( $this->wp_customize, $args );
		}

	}

}

if ( !class_exists( 'Tpfw_Customize_Panel' ) ) {
	
	/**
	 * Tpfw_Customize_Panel Class
	 */
	class Tpfw_Customize_Panel {

		/**
		 * @access private
		 * @var array customize global
		 */
		private $wp_customize;

		/**
		 * @access private
		 * @var string
		 */
		private $id;

		/**
		 * Init
		 */
		public function __construct( $wp_customize, $args ) {

			if ( !empty( $args ) ) {

				$this->id = $args['id'];

				$this->wp_customize = $wp_customize;

				$this->add_panel( $args );
			}
		}

		public function id() {
			return $this->id;
		}

		/**
		 * @access private
		 * Add panel to customizer
		 */
		private function add_panel( $args ) {

			$defaults = array(
				'id' => '',
				'title' => '',
				'description' => '', // Include html tags such as <p>.
				'priority' => 160, // Mixed with top-level-section hierarchy.
			);

			$args = wp_parse_args( $args, $defaults );

			$this->wp_customize->add_panel( $args['id'], $args );
		}

		/**
		 * Add section
		 * 
		 * @param Tpfw_Customize_Section|array $section Section Class or array settings
		 */
		public function add_section( $args = array() ) {
			$args['panel'] = $this->id();
			new Tpfw_Customize_Section( $this->wp_customize, $args );
		}

		public function add_sections( $sections = array() ) {
			foreach ( $sections as $section ) {
				$this->add_section( $section );
			}
		}

	}

}	