<?php
/**
 * Register EDD widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
add_action( 'widgets_init', 'minimall_edd_widgets_init' );
function minimall_edd_widgets_init() {

    register_sidebar( array(
        'name'          => esc_html__( 'Download Right Section', 'minimall' ),
        'id'            => 'download-right-sidebar',
        'description'   => __("Sidebar display at the right of the download page.","minimal"),
        'before_widget' => '<div id="%1$s" class="%2$s clearfix mb2">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title mb2">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Download Left Section', 'minimall' ),
        'id'            => 'download-left-sidebar',
        'description'   => __("Sidebar display at the left of the download page.","minimal"),
        'before_widget' => '<div id="%1$s" class="%2$s clearfix widgets">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title mb2">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Download Tabs Section', 'minimall' ),
        'id'            => 'download-tabs-sidebar',
        'description'   => __("Sidebar display in the bottom of the download page. Each widget is a new tab.","minimal"),
        'before_widget' => '<div id="%1$s" class="%2$s clearfix widgets">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title mb2">',
        'after_title'   => '</h4>',
    ) );
}
    
/*
* Add price to archive
*/
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
* Create EDD Download tabs
*/
add_action('minimall_edd_tabs','minimall_get_edd_download_tabs');
function minimall_get_edd_download_tabs(){
    global $wp_registered_widgets;

    $sidebar_id = 'download-tabs-sidebar';
    $sidebars_widgets = wp_get_sidebars_widgets();
    $widget_ids = $sidebars_widgets[$sidebar_id]; 
    $cpt = 1;
    
    
    

    if( !empty( $widget_ids ) ){
        foreach( $widget_ids as $id ) {
            
                if( $cpt == 1 ){
                    $active_class = 'active';
                }else{
                    $active_class = '';
                }

                $wdgtvar = 'widget_'._get_widget_id_base( $id );
                $idvar = _get_widget_id_base( $id );
                $instance = get_option( $wdgtvar );
                $idbs = str_replace( $idvar.'-', '', $id );
                echo '<li role="tab"><a href="#tab-'.$id.'" class="black sm-text '.$active_class.'">'.$instance[$idbs]['title'].'</a></li>';
                $cpt++;
        }
    }
        
}

/*
* Create EDD Download tabs Content
*/
add_action('minimall_edd_tabs_content','minimall_get_edd_download_tabs_content');
function minimall_get_edd_download_tabs_content(){
    global $wp_registered_widgets;
    $widgets = wp_get_sidebars_widgets(); 
    $cpt = 1;
    foreach ($widgets['download-tabs-sidebar'] as $widget) {
        if( $cpt == 1 ){
            $active_class = 'active';
        }else{
            $active_class = '';
        }
        $widget_array = $wp_registered_widgets[$widget];
        echo '<div id="tab-'.$widget_array['id'].'" class="tab-pane py2 '.$active_class.'">';
        wpse_show_widget( 'download-tabs-sidebar', $widget_array['id'] );
        echo '</div>';
        $cpt++;
    }
        
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
* Remove primary menu on EDD Checkout
*/
add_action("wp_head", "minimall_edd_checkout_remove_menu");
function minimall_edd_checkout_remove_menu(){
    if( get_theme_mod('edd_checkout_hide_menu','0') && ( function_exists('edd_is_checkout') && edd_is_checkout() ) ){
        remove_action('minimall_after_custom_logo','minimall_display_primary_menu');
    }
}

/*
* Add right sidebar content to download page
*/
add_action('minimall_edd_second_column','minimall_edd_download_right_sidebar', 10);
function minimall_edd_download_right_sidebar(){
    if ( ! is_active_sidebar( 'download-right-sidebar' ) ) {
        return;
    }
    dynamic_sidebar( 'download-right-sidebar' );
}

/*
* Add left sidebar content to download page
*/
add_action('minimall_edd_first_column','minimall_edd_download_left_sidebar', 10);
function minimall_edd_download_left_sidebar(){
    if ( ! is_active_sidebar( 'download-left-sidebar' ) ) {
        return;
    }
    dynamic_sidebar( 'download-left-sidebar' );
}
