<?php
/**
 * Adds custom widget.
 */
class minimal_social_profiles extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'minimal_social_profiles', // Base ID
      __('TTFB Social Profiles', 'minimal'), // Name
      array( 'description' => __( 'Social Profiles Widget for TTFB', 'minimal' ), ) // Args
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
    

    $minimal_icons = minimal_get_field('icons_social', 'widget_' . $args['widget_id']);
    if( !empty($minimal_icons) ){
        foreach( $minimal_icons as $icon ){
            ?>
                <a target="_blank" rel='noopener noreferrer' href="<?php echo esc_url( $icon['link'] ); ?>" class="left mr2 icons_social"><svg class="fa <?php echo esc_attr( $icon['icon_name'] ); ?>"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#<?php echo esc_attr( $icon['icon_name'] ); ?>"></use></svg></a>
            <?php
        }
    }
    
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
      $minimal_title = $instance['title'];
    }
    else {
      $minimal_title = __( 'New title', 'minimal' );
    }
    ?>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e(  'Title:','minimal' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $minimal_title ); ?>">
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
    $minimal_instance = array();
    $minimal_instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

    return $minimal_instance;
  }

} // class minimal_social_profiles

// register minimal_social_profiles widget
add_action( 'widgets_init', function(){
  register_widget( 'minimal_social_profiles' );
});