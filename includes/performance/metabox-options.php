<?php
function minimall_options_get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function minimall_options_add_meta_box() {
	add_meta_box(
		'minimall_options-performance-options',
		__( 'Performance Options', 'minimall_options' ),
		'minimall_options_html',
		'post',
		'side',
		'default'
	);
	add_meta_box(
		'minimall_options-performance-options',
		__( 'Performance Options', 'minimall_options' ),
		'minimall_options_html',
		'page',
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes', 'minimall_options_add_meta_box' );

function minimall_options_html( $post) {
    wp_nonce_field( '_minimall_options_nonce', 'minimall_options_nonce' ); 
?>
	<p>
		<input <?php if( !get_theme_mod('performance_activate_lazyload_img',false) ){ echo 'disabled'; } ?> type="checkbox" name="minimall_options_disable_image_lazy_load" id="minimall_options_disable_image_lazy_load" value="disable-image-lazy-load" <?php echo ( minimall_options_get_meta( 'minimall_options_disable_image_lazy_load' ) === 'disable-image-lazy-load' ) ? 'checked' : ''; ?>>
        <label for="minimall_options_disable_image_lazy_load"><?php _e( 'Disable Image Lazy Load', 'minimall_options' ); ?></label>	
    </p>	
    <p>
		<input <?php if( !get_theme_mod('performance_activate_lazyload_iframe',false) ){ echo 'disabled'; } ?> type="checkbox" name="minimall_options_disable_iframe_lazy_load" id="minimall_options_disable_iframe_lazy_load" value="disable-iframe-lazy-load" <?php echo ( minimall_options_get_meta( 'minimall_options_disable_iframe_lazy_load' ) === 'disable-iframe-lazy-load' ) ? 'checked' : ''; ?>>
        <label for="minimall_options_disable_iframe_lazy_load"><?php _e( 'Disable Iframe lazy Load', 'minimall_options' ); ?></label>	
    </p>
    <p>
		<input <?php if( get_theme_mod('performance_disable_critical_css',false) ){ echo 'disabled'; } ?> type="checkbox" name="minimall_options_disable_critical_css" id="minimall_options_disable_critical_css" value="disable-critical-css" <?php echo ( minimall_options_get_meta( 'minimall_options_disable_critical_css' ) === 'disable-critical-css' ) ? 'checked' : ''; ?>>
        <label for="minimall_options_disable_critical_css"><?php _e( 'Disable Critical CSS', 'minimall_options' ); ?></label>	
    </p>
    <p>
		<input <?php if( !get_theme_mod('performance_disable_emojijs',false) && !get_theme_mod('performance_disable_embed',false) && !get_theme_mod('performance_disable_query_string',false) ){ echo 'disabled'; } ?> type="checkbox" name="minimall_options_disable_clean_up" id="minimall_options_disable_clean_up" value="disable-clean-up" <?php echo ( minimall_options_get_meta( 'minimall_options_disable_clean_up' ) === 'disable-clean-up' ) ? 'checked' : ''; ?>>
        <label for="minimall_options_disable_clean_up"><?php _e( 'Disable Clean Up', 'minimall_options' ); ?></label>	
    </p>
<?php
}

function minimall_options_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['minimall_options_nonce'] ) || ! wp_verify_nonce( $_POST['minimall_options_nonce'], '_minimall_options_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['minimall_options_disable_image_lazy_load'] ) )
		update_post_meta( $post_id, 'minimall_options_disable_image_lazy_load', esc_attr( $_POST['minimall_options_disable_image_lazy_load'] ) );
	else
		update_post_meta( $post_id, 'minimall_options_disable_image_lazy_load', null );
	if ( isset( $_POST['minimall_options_disable_iframe_lazy_load'] ) )
		update_post_meta( $post_id, 'minimall_options_disable_iframe_lazy_load', esc_attr( $_POST['minimall_options_disable_iframe_lazy_load'] ) );
	else
		update_post_meta( $post_id, 'minimall_options_disable_iframe_lazy_load', null );
	if ( isset( $_POST['minimall_options_disable_critical_css'] ) )
		update_post_meta( $post_id, 'minimall_options_disable_critical_css', esc_attr( $_POST['minimall_options_disable_critical_css'] ) );
	else
		update_post_meta( $post_id, 'minimall_options_disable_critical_css', null );
	if ( isset( $_POST['minimall_options_disable_clean_up'] ) )
		update_post_meta( $post_id, 'minimall_options_disable_clean_up', esc_attr( $_POST['minimall_options_disable_clean_up'] ) );
	else
		update_post_meta( $post_id, 'minimall_options_disable_clean_up', null );
}
add_action( 'save_post', 'minimall_options_save' );

/*
	Usage: minimall_options_get_meta( 'minimall_options_disable_image_lazy_load' )
	Usage: minimall_options_get_meta( 'minimall_options_disable_iframe_lazy_load' )
	Usage: minimall_options_get_meta( 'minimall_options_disable_critical_css' )
	Usage: minimall_options_get_meta( 'minimall_options_disable_clean_up' )
*/
