<?php
add_filter( 'edd_di_display_images', 'minimall_edd_di_display_images', 10, 2 );
function minimall_edd_di_display_images( $html, $download_image ) {
    global $post;
    $image_id = minimall_get_image_id( $download_image['image'] );

    if( $image_id ):
        $thumb = wp_get_attachment_image_src( $image_id, 'minimall-edd-thumb' );
        $medium = wp_get_attachment_image_src( $image_id, 'medium' );
        $large = wp_get_attachment_image_src( $image_id, 'large' );
        $full = wp_get_attachment_image_src( $image_id, 'full' );
        
        $img_per_row = get_theme_mod('edd_single_thumb','4');
        $img_width = round( 12 / $img_per_row );
        $html = '<div class="flex items-start justify-center inline-block col-'.$img_width.' px1 py1"><a class="js-smartPhoto" data-group="download-'.$post->ID.'" href="'. esc_url( $full[0] ) .'"><img class="minimall-edd-thumb zoom-img lazyload" data-src="' . $large[0] . '" /></a></div>';

        return $html;

    else:
        return false;
    endif; 
}