<?php
/**
 * Adds custom widget.
 */
class minimal_author_widget extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'minimal_author_widget', // Base ID
      __('TTFB Author box', 'minimal'), // Name
      array( 'description' => __( 'Author box widget for TTFB', 'minimal' ), ) // Args
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

    $display_name = get_the_author_meta( 'display_name', $post->post_author );

    if ( empty( $display_name ) )
    $display_name = get_the_author_meta( 'nickname', $post->post_author );

    $user_description = get_the_author_meta( 'user_description', $post->post_author );

    $user_avatar = get_avatar( get_the_author_meta('user_email') , 90 );    
    
    ?>
    <div class="flex items-center">
        <div class="mr2">
            <?php echo $user_avatar; ?>
        </div>

        <p>
            <strong class="caps"><?php echo esc_html__("About","minimal"); ?> <?php echo $display_name; ?></strong><br>
            <?php echo nl2br( $user_description ); ?>
        </p>
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
      $lminimal_title = $instance['title'];
    }
    else {
      $lminimal_title = __( 'New title', 'minimal' );
    }
    ?>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e(  'Title:','minimal' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $lminimal_title ); ?>">
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
    $lminimal_instance = array();
    $lminimal_instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

    return $lminimal_instance;
  }

} // class minimal_author_widget

// register minimal_author_widget widget
add_action( 'widgets_init', function(){
  register_widget( 'minimal_author_widget' );
});