<?php
/**
 * Adds custom widget for EDD Thumbnail.
 */
class Minimall_Edd_Download_Thumbnail extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'minimall_edd_download_thumbnail', // Base ID
      __('Minimall Download Thumbnail', 'minimall'), // Name
      array( 'description' => __( 'Display the download thumbnail.', 'minimall' ), ) // Args
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
    
    global $post;

    if( !is_object( $post ) ){ return false; }
    
    $image_id = get_post_thumbnail_id($post->ID);
    $thumb_data = wp_get_attachment_image_src( $image_id, 'large' ); 
    $full_data = wp_get_attachment_image_src( $image_id, 'full' ); 
?>

    <div id="edd-main-thumb">
        <?php 
            $shortcode = do_shortcode('[gallery link="file" type="thumbnail" size="minimall-edd-thumbnails" columns="1" include="'. $image_id .'"]'); 
            echo apply_filters('minimall_edd_featured_img',$shortcode);
        ?>
    </div>
    

<?php
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
      $lminimall_title = $instance['title'];
    }
    else {
      $lminimall_title = __( 'New title', 'minimall' );
    }
    ?>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e(  'Title:','minimall' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $lminimall_title ); ?>">
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
    $lminimall_instance = array();
    $lminimall_instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

    return $lminimall_instance;
  }

} // class Minimall_Edd_Download_Thumbnail

// register Minimall_Edd_Download_Thumbnail widget
add_action( 'widgets_init', function(){
  register_widget( 'Minimall_Edd_Download_Thumbnail' );
});

// Add lazyload to widget filter
add_filter( 'minimall_edd_featured_img'	, 'ttfb_toolkit_lazy_load_image', PHP_INT_MAX );

// Shortcode filter
add_filter('minimall_edd_featured_img','minimall_edd_featured_img',10);
function minimall_edd_featured_img( $shortcode ){
    return $shortcode;
}