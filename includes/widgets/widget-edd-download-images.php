<?php
/**
 * Adds custom widget EDD Download Images.
 */
class Minimall_Edd_Download_Images extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'minimall_edd_download_images', // Base ID
      __('Minimall EDD Download Images', 'minimall'), // Name
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
    

    if( function_exists( 'edd_di_display_images') ) :
        echo '<div id="edd-gallery" class="flex flex-wrap mxn1 mt1 gallery">';
            edd_di_display_images();
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

} // class Minimall_Edd_Download_Images

// register Minimall_Edd_Download_Images widget
add_action( 'widgets_init', function(){
  register_widget( 'Minimall_Edd_Download_Images' );
});