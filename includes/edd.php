<?php
add_action('edd_download_after_title','minimall_add_edd_price_under_title');
function minimall_add_edd_price_under_title(){
    if( !get_theme_mod('edd_hide_shop_price', false) ):
?>
        <div class="mt1 mb1">
            <a class="edd_price" href="<?php the_permalink(); ?>"><?php edd_price(); ?></a>
        </div>
<?php
    endif;
}

add_filter( 'edd_di_display_images', 'minimall_edd_di_display_images', 10, 2 );
function minimall_edd_di_display_images( $html, $download_image ) {
    
    $image_id = minimall_get_image_id( $download_image['image'] );

    if( $image_id ):
        $thumb = wp_get_attachment_image_src( $image_id, 'minimall-edd-thumb' );
        $medium = wp_get_attachment_image_src( $image_id, 'medium' );
        $large = wp_get_attachment_image_src( $image_id, 'large' );
        $full = wp_get_attachment_image_src( $image_id, 'full' );
        
        $img_per_row = get_theme_mod('edd_single_thumb','4');
        $img_width = round( 12 / $img_per_row );
        $html = '<div class="flex items-start justify-center inline-block col-'.$img_width.' px1 py1"><a href="'. esc_url( $full[0] ) .'"><img class="minimall-edd-thumb zoom-img lazyload" data-src="' . $large[0] . '" /></a></div>';

        return $html;

    else:
        return false;
    endif; 
}