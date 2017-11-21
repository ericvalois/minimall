<?php
/**
 * Product Download Details Widget.
 *
 * Displays a product's details in a widget.
 *
 * @since 1.0
 * @return void
 */
class Minimall_EDD_Product_Details_Widget extends WP_Widget {

	/** Constructor */
	public function __construct() {
		parent::__construct(
			'minimall_edd_product_details_widget',
			sprintf( __( '%s Details', 'minimall' ), 'Minimall Download' ),
			array(
				'description' => sprintf( __( 'Display the details of a specific %s', 'minimall' ), 'Download' ),
			)
		);
	}

	/** @see WP_Widget::widget */
	public function widget( $args, $instance ) {
		$args['id'] = ( isset( $args['id'] ) ) ? $args['id'] : 'edd_download_details_widget';

		if ( ! empty( $instance['download_id'] ) ) {
			if ( 'current' === ( $instance['download_id'] ) ) {
				$instance['display_type'] = 'current';
				unset( $instance['download_id'] );
			} elseif ( is_numeric( $instance['download_id'] ) ) {
				$instance['display_type'] = 'specific';
			}
		}

		if ( ! isset( $instance['display_type'] ) || ( 'specific' === $instance['display_type'] && ! isset( $instance['download_id'] ) ) || ( 'current' == $instance['display_type'] && ! is_singular( 'download' ) ) ) {
			return;
		}

		// set correct download ID.
		if ( 'current' == $instance['display_type'] && is_singular( 'download' ) ) {
			$download_id = get_the_ID();
		} else {
			$download_id = absint( $instance['download_id'] );
		}

		// Since we can take a typed in value, make sure it's a download we're looking for
		$download = get_post( $download_id );
		if ( ! is_object( $download ) || 'download' !== $download->post_type ) {
			return;
		}

		// Variables from widget settings.
		$title           = apply_filters( 'widget_title', $instance['title'], $instance, $args['id'] );
        $download_title  = $instance['download_title'] ? apply_filters( 'edd_product_details_widget_download_title', '<h1 class="entry-title h2 mt2 lg-mt0 mb0 lg-mb1">' . get_the_title( $download_id ) . '</h1>', $download_id ) : '';
        $download_price  = $instance['download_price'] ? '<div class="edd-price xxl-text primary-color mt1 mb1">' . edd_price( $download_id, false ) . '</div>' : '';
        $download_excerpt  = $instance['download_excerpt'] ? '<p class="mt1">' . get_the_excerpt( $download_id ) . '</p>' : '';
		$purchase_button = $instance['purchase_button'] ? apply_filters( 'edd_product_details_widget_purchase_button', edd_get_purchase_link( array( 'download_id' => $download_id ) ), $download_id ) : '';
		$categories      = $instance['categories'] ? $instance['categories'] : '';
		$tags            = $instance['tags'] ? $instance['tags'] : '';

		// Used by themes. Opens the widget.
		echo $args['before_widget'];

		// Display the widget title.
		if( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		do_action( 'edd_product_details_widget_before_title' , $instance , $download_id );

		// download title.
        echo $download_title;
        
        // download price.
        echo $download_price;
        
        // download excerpt.
		echo $download_excerpt;

		do_action( 'edd_product_details_widget_before_purchase_button' , $instance , $download_id );
		// purchase button.
		echo $purchase_button;

		// categories and tags.
		$category_list     = $categories ? get_the_term_list( $download_id, 'download_category', '', ', ' ) : '';
		$category_count    = count( get_the_terms( $download_id, 'download_category' ) );
		$category_labels   = edd_get_taxonomy_labels( 'download_category' );
		$category_label    = $category_count > 1 ? $category_labels['name'] : $category_labels['singular_name'];

		$tag_list     = $tags ? get_the_term_list( $download_id, 'download_tag', '', ', ' ) : '';
		$tag_count    = count( get_the_terms( $download_id, 'download_tag' ) );
		$tag_taxonomy = edd_get_taxonomy_labels( 'download_tag' );
		$tag_label    = $tag_count > 1 ? $tag_taxonomy['name'] : $tag_taxonomy['singular_name'];

		$text = '';

		if( $category_list || $tag_list ) {
			$text .= '<p class="edd-meta">';

			if( $category_list ) {

				$text .= '<span class="categories">%1$s: %2$s</span><br/>';
			}

			if ( $tag_list ) {
				$text .= '<span class="tags">%3$s: %4$s</span>';
			}

			$text .= '</p>';
		}

		do_action( 'edd_product_details_widget_before_categories_and_tags', $instance, $download_id );

		printf( $text, $category_label, $category_list, $tag_label, $tag_list );

		do_action( 'edd_product_details_widget_before_end', $instance, $download_id );

		// Used by themes. Closes the widget.
		echo $args['after_widget'];
	}

	/** @see WP_Widget::form */
	public function form( $instance ) {
		// Set up some default widget settings.
		$defaults = array(
			'title'           => sprintf( __( '%s Details', 'minimall' ), 'Download' ),
			'display_type'    => 'current',
			'download_id'     => false,
            'download_title'  => 'on',
            'download_price'  => 'on',
            'download_excerpt'  => 'on',
			'purchase_button' => 'on',
			'categories'      => 'on',
			'tags'            => 'on',
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<?php
		if ( 'current' === ( $instance['download_id'] ) ) {
			$instance['display_type'] = 'current';
			$instance['download_id']  = false;
		} elseif ( is_numeric( $instance['download_id'] ) ) {
			$instance['display_type'] = 'specific';
		}

		?>

		<!-- Title -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'minimall' ) ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</p>

		<!-- Download -->
		<?php $display = 'current' === $instance['display_type'] ? ' style="display: none;"' : ''; ?>
		<p class="download-details-selector" <?php echo $display; ?>>
		<label for="<?php echo esc_attr( $this->get_field_id( 'download_id' ) ); ?>"><?php printf( __( '%s:', 'minimall' ), 'Download' ); ?></label>
		<?php $download_count = wp_count_posts( 'download' ); ?>
		<?php if ( $download_count->publish < 1000 ) : ?>
			<?php
			$args = array(
				'post_type'      => 'download',
				'posts_per_page' => -1,
				'post_status'    => 'publish',
			);
			$downloads = get_posts( $args );
			?>
			<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'download_id' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'download_id' ) ); ?>">
			<?php foreach ( $downloads as $download ) { ?>
				<option <?php selected( absint( $instance['download_id'] ), $download->ID ); ?> value="<?php echo esc_attr( $download->ID ); ?>"><?php echo $download->post_title; ?></option>
			<?php } ?>
			</select>
		<?php else: ?>
			<br />
			<input type="text" value="<?php echo esc_attr( $instance['download_id'] ); ?>" placeholder="<?php printf( __( '%s ID', 'minimall' ), 'Download' ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'download_id' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'download_id' ) ); ?>">
		<?php endif; ?>
		</p>

		<!-- Download title -->
		<p>
			<input <?php checked( $instance['download_title'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'download_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'download_title' ) ); ?>" type="checkbox" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'download_title' ) ); ?>"><?php printf( __( 'Show %s Title', 'minimall' ), 'Download' ); ?></label>
        </p>
        
        <!-- Download Price -->
		<p>
			<input <?php checked( $instance['download_price'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'download_price' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'download_price' ) ); ?>" type="checkbox" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'download_price' ) ); ?>"><?php printf( __( 'Show %s Price', 'minimall' ), 'Download' ); ?></label>
        </p>
        
        <!-- Download excerpt -->
		<p>
			<input <?php checked( $instance['download_excerpt'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'download_excerpt' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'download_excerpt' ) ); ?>" type="checkbox" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'download_excerpt' ) ); ?>"><?php printf( __( 'Show %s Short Description', 'minimall' ), 'Download' ); ?></label>
		</p>

		<!-- Show purchase button -->
		<p>
			<input <?php checked( $instance['purchase_button'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'purchase_button' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'purchase_button' ) ); ?>" type="checkbox" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'purchase_button' ) ); ?>"><?php _e( 'Show Purchase Button', 'minimall' ); ?></label>
		</p>

		<!-- Show download categories -->
		<p>
			<?php $category_labels = edd_get_taxonomy_labels( 'download_category' ); ?>
			<input <?php checked( $instance['categories'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'categories' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'categories' ) ); ?>" type="checkbox" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'categories' ) ); ?>"><?php printf( __( 'Show %s', 'minimall' ), $category_labels['name'] ); ?></label>
		</p>

		<!-- Show download tags -->
		<p>
			<?php $tag_labels = edd_get_taxonomy_labels( 'download_tag' ); ?>
			<input <?php checked( $instance['tags'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'tags' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tags' ) ); ?>" type="checkbox" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'tags' ) ); ?>"><?php printf( __( 'Show %s', 'minimall' ), $tag_labels['name'] ); ?></label>
		</p>

		<?php do_action( 'edd_product_details_widget_form' , $instance ); ?>
	<?php }

	/** @see WP_Widget::update */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']           = strip_tags( $new_instance['title'] );
		$instance['download_id']     = strip_tags( $new_instance['download_id'] );
		$instance['display_type']    = isset( $new_instance['display_type'] )    ? strip_tags( $new_instance['display_type'] ) : 'current';
        $instance['download_title']  = isset( $new_instance['download_title'] )  ? $new_instance['download_title']  : '';
        $instance['download_price']  = isset( $new_instance['download_price'] )  ? $new_instance['download_price']  : '';
        $instance['download_excerpt']  = isset( $new_instance['download_excerpt'] )  ? $new_instance['download_excerpt']  : '';
		$instance['purchase_button'] = isset( $new_instance['purchase_button'] ) ? $new_instance['purchase_button'] : '';
		$instance['categories']      = isset( $new_instance['categories'] )      ? $new_instance['categories']      : '';
		$instance['tags']            = isset( $new_instance['tags'] )            ? $new_instance['tags']            : '';

		do_action( 'edd_product_details_widget_update', $instance );

		// If the new view is 'current download' then remove the specific download ID
		if ( 'current' === $instance['display_type'] ) {
			unset( $instance['download_id'] );
		}

		return $instance;
	}

}

// register Minimall_EDD_Product_Details_Widget widget
add_action( 'widgets_init', function(){
    register_widget( 'Minimall_EDD_Product_Details_Widget' );
});