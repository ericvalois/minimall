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

add_action('minimall_edd_second_column','minimall_add_edd_single_title', 10);
function minimall_add_edd_single_title(){
    if( !get_theme_mod('edd_hide_single_title','0') ){
        the_title( '<h1 class="entry-title mt2 lg-mt0 mb0 lg-mb1">', '</h1>' );
    }
}

add_action('minimall_edd_second_column','minimall_add_edd_single_price', 20);
function minimall_add_edd_single_price(){
    if( !get_theme_mod('edd_hide_single_price','0') ){
        echo '<div class="edd-price xxl-text primary-color">';
            edd_price();
        echo '</div>';
    }
}

add_action('minimall_edd_second_column','minimall_add_edd_single_excerpt', 30);
function minimall_add_edd_single_excerpt(){
    if( !get_theme_mod('edd_hide_single_excerpt','0') ){
        the_excerpt();
    }
}

add_action('minimall_edd_second_column','minimall_add_edd_single_button', 40);
function minimall_add_edd_single_button(){
    $price = get_theme_mod('edd_hide_single_btn_price', false);
    if( $price ){ $price = false; }else{ $price = true; }
    echo '<div class="wrap-edd-button clearfix">';
    echo edd_get_purchase_link( 
        array( 
            'download_id' 	=> get_the_ID(), 
            'class' 	=> 'btn btn-big btn-black', // add your new classes here
            'price' 	=> $price,
        )
    );
    
    do_action('minimall_after_single_button');
    echo '</div>';
}

add_action('minimall_edd_tabs','minimall_edd_tab_description', 10);
function minimall_edd_tab_description(){
?>
    <li role="tab">
        <a href="#tab-description" class="black active"><?php esc_html_e('Description','minimall'); ?></a>
    </li>
<?php
}

add_action('minimall_edd_tabs_content','minimall_edd_tab_description_content', 10);
function minimall_edd_tab_description_content(){
?>
    <div id="tab-description" class="tab-pane active">
        <h2 class="h2 mt0"><?php esc_html_e('Description','minimall'); ?></h2>
        <?php the_content(); ?>
    </div>
<?php
}

/*
* Add comment support to EDD products
*/
add_filter('edd_download_supports', 'minimall_edd_product_supports');
function minimall_edd_product_supports($supports) {
    if( !get_theme_mod('edd_hide_single_comment','0') ){
        $supports[] = 'comments';
    }
	return $supports;	
}

/*
* Add comment tab to EDD product tabs
*/
add_action('minimall_edd_tabs','minimall_edd_tab_comment',20);
function minimall_edd_tab_comment(){
    if ( ( comments_open() || get_comments_number() ) && !get_theme_mod('edd_hide_single_comment','0') ) :
?>
        <li role="tab">
            <a href="#tab-comments" class="black"><?php esc_html_e('Comments','minimall'); ?></a>
        </li>
<?php
    endif;
}

/*
* Add comment content to EDD product tabs
*/
add_action('minimall_edd_tabs_content','minimall_edd_tab_comment_content',20);
function minimall_edd_tab_comment_content(){
?>
    <?php if ( ( comments_open() || get_comments_number() ) && !get_theme_mod('edd_hide_single_comment','0') ) : ?>
        <div id="tab-comments" class="tab-pane py2">
            <?php comments_template('/template-parts/content-download-comment.php'); ?>
        </div>
    <?php endif; ?>
<?php
}

/*
* Remove EDD purchase link from the_content
*/
remove_action( 'edd_after_download_content', 'edd_append_purchase_link' );

/**
 * Enqueue scripts and styles for EDD.
 */
add_action( 'wp_enqueue_scripts', 'minimall_edd_scripts', 1 );
function minimall_edd_scripts() {
    wp_enqueue_script( 'minimall-edd', get_template_directory_uri() . '/assets/js/edd.min.js', '', '', true );
}

/*
* EDD add content before checkout cart
*/
add_action("edd_before_checkout_cart", "minimall_before_checkout_cart");
function minimall_before_checkout_cart(){
    $content = get_theme_mod('edd_checkout_before_cart','');
    if( $content ){
        echo do_shortcode( wp_kses_post( $content ) );
    }
}

/*
* EDD add content before checkout personal info
*/
add_action("edd_checkout_form_top", "minimall_before_checkout_personal");
function minimall_before_checkout_personal(){
    $content = get_theme_mod('edd_checkout_before_personal','');
    if( $content ){
        echo do_shortcode( wp_kses_post( $content ) );
    }
}

/*
* Remove menu on EDD Checkout
*/
add_action("wp_head", "minimall_edd_checkout_remove_menu");
function minimall_edd_checkout_remove_menu(){
    if( get_theme_mod('edd_checkout_hide_menu','0') && ( function_exists('edd_is_checkout') && edd_is_checkout() ) ){
        remove_action('minimall_after_custom_logo','minimall_display_primary_menu');
    }
}
