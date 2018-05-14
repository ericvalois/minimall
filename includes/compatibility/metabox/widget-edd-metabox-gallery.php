<?php
/**
 * Adds custom widget EDD metabox Gallery.
 */
class Minimall_Edd_Metabox_Gallery extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'minimall_edd_metabox_gallery', // Base ID
      __('Minimall EDD Gallery', 'minimall'), // Name
      array( 'description' => __( 'Show additionnal images in download sidebars.', 'minimall' ), ) // Args
    );
  }

  /**
   * Front-end display of widget.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Widget arguments.
   * @param array $instance Saved values from database.
   */
  public function widget( $args, $instance ) {
    echo $args['before_widget'];
    if ( !empty($instance['title']) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
    }
    

    if( function_exists( 'rwmb_meta') ) :
        $images = rwmb_meta( 'minimall-edd_gallery' );
        $img_per_row = get_theme_mod('edd_single_thumb','4');
        //$img_width = round( 12 / $img_per_row );
        $thumb_size = get_theme_mod('edd_single_thumb_size','thumbnail');
        $gallery_type = get_theme_mod('edd_single_thumb_type','thumbnail');

        echo '<div id="edd-gallery" class="flex flex-wrap mxn1">';
            $image_string = '';
            foreach ( $images as $key => $image ) {
                $image_string .= $key . ',';
            }
            
            $shortcode = do_shortcode('[gallery link="file" type="'. $gallery_type .'" size="'. $thumb_size .'" columns="'.$img_per_row.'" include="'. $image_string .'"]');
            echo apply_filters('minimall_edd_gallery',$shortcode);
        echo '</div>';

    endif; 
    
    echo $args['after_widget'];
  }

  /**
   * Back-end widget form.
   *
   * @see WP_Widget::form()
   *
   * @param array $instance Previously saved values from database.
   */
  public function form( $instance ) {
    if ( isset($instance['title']) ) {
      $minimall_title = $instance['title'];
    }
    else {
      $minimall_title = __( 'New title', 'minimall' );
    }
    ?>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e(  'Title:','minimall' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $minimall_title ); ?>">
    </p>
    <?php
  }

  /**
   * Sanitize widget form values as they are saved.
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance Values just sent to be saved.
   * @param array $old_instance Previously saved values from database.
   *
   * @return array Updated safe values to be saved.
   */
  public function update( $new_instance, $old_instance ) {
    $minimall_instance = array();
    $minimall_instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

    return $minimall_instance;
  }

} // class Minimall_Edd_Metabox_Gallery

// register Minimall_Edd_Metabox_Gallery widget
add_action( 'widgets_init', function(){
  register_widget( 'Minimall_Edd_Metabox_Gallery' );
});

// Add lazyload to widget filter
add_filter( 'minimall_edd_gallery'	, 'ttfb_toolkit_lazy_load_image', PHP_INT_MAX );

// Shortcode filter
add_filter('minimall_edd_gallery','minimall_edd_gallery',10);
function minimall_edd_gallery( $shortcode ){
    return $shortcode;
}