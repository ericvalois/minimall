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
        'before_title'  => '<h4 class="widget-title m0 hide">',
        'after_title'   => '</h4>',
    ) );
}

/**
 * Easy Digital Download Customizer Controls
 */
include( get_template_directory() . '/includes/compatibility/edd/edd-customizer.php' );

/**
 * Easy Digital Download Performance Module
 */
include( get_template_directory() . '/includes/compatibility/edd/edd-performance.php' );
    
/**
 * Download navigation
 * This is used by archive-download.php, taxonomy-download_category.php, taxonomy-download_tag.php, shortcodes
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'minimall_edd_download_nav' ) ) :
	function minimall_edd_download_nav() {

		global $wp_query;

		$big          = 999999;
		$search_for   = array( $big, '#038;' );
		$replace_with = array( '%#%', '&' );

		$pagination = paginate_links( array(
			'base'    => str_replace( $search_for, $replace_with, get_pagenum_link( $big ) ),
			'format'  => '?paged=%#%',
			'current' => max( 1, get_query_var( 'paged' ) ),
			'total'   => $wp_query->max_num_pages
		) );
		?>

		<?php if ( ! empty( $pagination ) ) : ?>
		<div id="minimall_edd_download_pagination" class="navigation">
			<?php echo $pagination; ?>
		</div>
		<?php endif; ?>

	<?php
	}
endif;
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
    global $post;

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
            $tab = '<li role="tab"><a href="#tab-'.$id.'" class="black sm-text '.$active_class.'">'.$instance[$idbs]['title'].'</a></li>';

            if ( strchr($id,'minimall_edd_download_comments') ):
                if( comments_open() || get_comments_number() ):
                    echo $tab;
                endif;
            elseif( strchr($id,'edd_sl_changelog_widget') ):
                $changelog 	= get_post_meta( $post->ID, '_edd_sl_changelog', true );
                if( $changelog ):
                    echo $tab;
                endif;
            else:
                echo $tab;
            endif;

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
        echo '<div id="tab-'.$widget_array['id'].'" class="tab-pane py1 '.$active_class.'">';
        minimall_show_widget( 'download-tabs-sidebar', $widget_array['id'] );
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
add_action("wp_footer", "minimall_edd_checkout_remove_menu");
function minimall_edd_checkout_remove_menu(){
    if( get_theme_mod('edd_checkout_hide_menu','0') && ( function_exists('edd_is_checkout') && edd_is_checkout() ) ){
        echo '<style>';
        echo '#site-navigation{ display: none }';
        echo '</style>';
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

/*
* Remove variable pricing options on archive
*/
//add_action('wp','minimall_edd_remove_pricing_options_archive');
function minimall_edd_remove_pricing_options_archive(){
    if( !is_singular("download") ){
        remove_action('edd_purchase_link_top','edd_purchase_variable_pricing');
    }
}

add_action('edd_purchase_link_end','minimall_edd_secondary_link', 5);
function minimall_edd_secondary_link(){
    global $post;

    $link_label = rwmb_meta( 'minimall-edd_secondary_label', $post->ID );
    $link_url = rwmb_meta( 'minimall-edd_secondary_url', $post->ID );
    $link_class = rwmb_meta( 'minimall-edd_secondary_class', $post->ID );
    $link_target = rwmb_meta( 'minimall-edd_secondary_target', $post->ID );

    if( !empty( $link_label ) && !empty( $link_url ) && is_singular('download') ){
        echo '<a '.minimall_external_link( $link_target ).'class="'.esc_attr( $link_class ).'" href="'.esc_url( $link_url ).'">'.esc_html( $link_label ).'</a>';
    }
}

/*
* Before download button wraper
*/
add_action('edd_purchase_link_top','minimall_wrap_download_btn_before', 10);
function minimall_wrap_download_btn_before(){
    echo '<div class="flex items-center edd_flex_wrap">';
}

/*
* After download button wraper
*/
add_action('edd_purchase_link_end','minimall_wrap_download_btn_after', 10);
function minimall_wrap_download_btn_after(){
    echo '</div>';
}

/*
* Return Download btn class
*/
function minimall_get_edd_btn_class( $class = '' ) {

	if(has_filter('minimall_download_btn_class')) {
		$class = apply_filters('minimall_download_btn_class', $class);
	}
 
	return $class;
}