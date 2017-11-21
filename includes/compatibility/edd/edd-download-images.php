<?php
add_filter( 'edd_di_display_images', 'minimall_edd_di_display_images', 10, 2 );
function minimall_edd_di_display_images( $html, $download_image ) {
    global $post;
    $image_id = minimall_get_image_id( $download_image['image'] );

    if( $image_id ):
        $large = wp_get_attachment_image_src( $image_id, 'large' );
        $full = wp_get_attachment_image_src( $image_id, 'full' );
        $img_data = get_post( $image_id );

        $img_per_row = get_theme_mod('edd_single_thumb','4');
        $img_width = round( 12 / $img_per_row );
        $html = '<a class="flex items-start justify-center inline-block col-'.$img_width.' px1 py1" href="'. esc_url( $full[0] ) .'" data-caption="'.$img_data->post_excerpt.'"><img class="minimall-edd-thumb lazyload" src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-src="' . $large[0] . '" alt="'.$img_data->post_title.'" title="'.$img_data->post_title.'" /></a>';

        return $html;

    else:
        return false;
    endif; 
}