<?php
/**
 * Adds custom widget for EDD Cart.
 */
class Minimall_Edd_Download_Cart extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'minimall_edd_download_cart', // Base ID
      __('Minimall Download Cart', 'minimall'), // Name
      array( 'description' => __( 'Display a minimalist cart icon.', 'minimall' ), ) // Args
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

    $cart_items    = edd_get_cart_contents();
    $cart_quantity = edd_get_cart_quantity();
    $display       = $cart_quantity > 0 ? '' : ' style="display:none;"';
    
    ?>

    <a <?php echo $display; ?> class="edd-cart-number-of-items text-color line-height-1 hover-opacity flex items-center sm-text" href="<?php echo esc_url( edd_get_checkout_uri() ); ?>"> 
        <svg class="mr1" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve" width="18" height="18"><g><path d="M23,22.7L21,6.9C20.9,6.4,20.5,6,20,6h-3V5c0-2.8-2.2-5-5-5S7,2.2,7,5v1H4C3.5,6,3.1,6.4,3,6.9l-2,16 c0,0.3,0.1,0.6,0.2,0.8C1.4,23.9,1.7,24,2,24h20c0,0,0,0,0,0c0.6,0,1-0.4,1-1C23,22.9,23,22.8,23,22.7z M9,5c0-1.7,1.3-3,3-3 s3,1.3,3,3v1H9V5z"></path></g></svg> 
        <span class="edd-cart-quantity style-none lg-text"><?php echo $cart_quantity; ?></span>
    </a>
 
    <?php
    echo $args['after_widget'];
  }

} // class Minimall_Edd_Download_Cart

// register Minimall_Edd_Download_Cart widget
add_action( 'widgets_init', function(){
  register_widget( 'Minimall_Edd_Download_Cart' );
});