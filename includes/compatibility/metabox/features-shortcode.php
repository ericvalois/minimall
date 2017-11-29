<?php
/*
* Create Shortcode to display Download features
*/
add_shortcode( 'minimall_edd_features', 'minimall_edd_metabox_features_shortcode' );
function minimall_edd_metabox_features_shortcode( $atts ){

    if( !minimall_is_metabox_active() ){ return; }

    global $post;

    if( !is_object( $post ) ){ return; }

    $output = '';
    $col_width = 12 / rwmb_meta( 'minimall-edd_features_col', $post->ID );
    $features = rwmb_meta( 'minimall-edd_features_items', $post->ID );
    
    if( !empty( $features ) ){
        $output .= '<div class="sm-flex flex-wrap sm-mxn2">';

        foreach ($features as $item):
            $output .= '<div class="sm-col-' .esc_attr( $col_width ) .' mb3 sm-px2">';
                
                if( $item['icon'] ):
                    $output .= '<div class="xl-text">' . $item['icon'] .'</div>';
                endif;
        
                if( $item['label'] ):
                    $output .= '<strong class="">'. esc_html($item['label']) . '</strong>';
                endif;
        
                if( $item['desc'] ):
                    $output .= '<p class="sm-text mt0 mb0">'. esc_html($item['desc']) . '</p>';
                endif;
        
            $output .= '</div>';
        endforeach;

        $output .= '</div>';
    }
    
    return $output;
}