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
        'description'   => __("Sidebar display at the right of the download page.","minimall"),
        'before_widget' => '<div id="%1$s" class="%2$s clearfix mb2 widgets">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title mb2">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Download Left Section', 'minimall' ),
        'id'            => 'download-left-sidebar',
        'description'   => __("Sidebar display at the left of the download page.","minimall"),
        'before_widget' => '<div id="%1$s" class="%2$s clearfix widgets">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title mb2">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Download Tabs Section', 'minimall' ),
        'id'            => 'download-tabs-sidebar',
        'description'   => __("Sidebar display in the bottom of the download page. Each widget is a new tab.","minimall"),
        'before_widget' => '<div id="%1$s" class="%2$s clearfix ">',
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
            
            $tab_before = '<li role="tab"><a data-tab="#'. sanitize_title($instance[$idbs]['title']) .'" href="#'.sanitize_title($instance[$idbs]['title']).'" class="black sm-text '.$active_class.'">';
            $tab_title = $instance[$idbs]['title'];
            $tab_after = '</a></li>';

            if ( strchr($id,'minimall_edd_download_comments') ):
                if( comments_open() || get_comments_number() ):

                    $review_number = minimall_get_review_number( $post->ID );
                    $comment_count = minimall_get_comment_number( $post->ID ); - $review_number;

                    if( get_comments_number() - $review_number > 0 ){
                        $count = '<span class="muted">(' . $comment_count . ')</span>';
                    }else{
                        $count = '';
                    }
                    
                    echo $tab_before;
                    echo $tab_title . $count;
                    echo $tab_after;
                endif;
            elseif( strchr($id,'minimall_edd_download_reviews') ):
                if( minimall_is_edd_reviews_active() ):
                    $review_number = minimall_get_review_number( $post->ID );

                    if( $review_number ){
                        $count = '<span class="muted">(' . $review_number . ')</span>';
                    }else{
                        $count = '';
                    }

                    echo $tab_before;
                    echo $tab_title . $count;
                    echo $tab_after;
                endif;
            else:
                echo $tab_before;
                echo $tab_title;
                echo $tab_after;
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

        if( isset( $wp_registered_widgets[$widget] ) ){
            $widget_array = $wp_registered_widgets[$widget];
            
            $wdgtvar = 'widget_'._get_widget_id_base( $widget_array['id'] );
            $idvar = _get_widget_id_base( $widget_array['id'] );
            $instance = get_option( $wdgtvar );
            $idbs = str_replace( $idvar.'-', '', $widget_array['id'] );

            echo '<div id="'.sanitize_title($instance[$idbs]['title']).'" class="tab-pane py1 '.$active_class.'">';
            minimall_show_widget( 'download-tabs-sidebar', $widget_array['id'] );
            echo '</div>';
        }
        
        $cpt++;
    }
        
}

function minimall_download_class(){ 
    return false;
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
* Return Download btn class
*/
function minimall_get_edd_btn_class( $class = '' ) {

	if(has_filter('minimall_download_btn_class')) {
		$class = apply_filters('minimall_download_btn_class', $class);
	}
 
	return $class;
}

/*
* Return active review number
*/
function minimall_get_review_number( $post_id = null ){

    if( !minimall_is_edd_reviews_active() ){
        return false;
    }

    $object_review = EDD_Reviews::get_instance();
    
    $reviews = array();

    remove_action( 'pre_get_comments',   array( $object_review, 'hide_reviews' ) );

    $reviews_query = array(
        'type'       => 'edd_review',
        'post_id'    => $post_id,
        'meta_query' => array(
            array(
                'key'     => 'edd_review_reply',
                'compare' => 'NOT EXISTS'
            )
        )
    );

    $reviews_query['meta_query'] = array(
        'relation' => 'AND',
        array(
            'key'     => 'edd_review_approved',
            'value'   => '1',
            'compare' => '='
        ),
        array(
            'key'     => 'edd_review_approved',
            'value'   => 'spam',
            'compare' => '!='
        ),
        array(
            'key'     => 'edd_review_approved',
            'value'   => 'trash',
            'compare' => '!='
        ),
        array(
            'key'     => 'edd_review_reply',
            'compare' => 'NOT EXISTS'
        )
    );
    

    $reviews = get_comments( $reviews_query );
    

    add_action( 'pre_get_comments',   array( $object_review, 'hide_reviews' ) );

    return count($reviews);
}

/*
* Return active review number
*/
function minimall_get_comment_number( $post_id = null ){
    
    $comments_query = array(
        'type'       => 'comment',
        'post_id'    => $post_id,
    );

    $comments = get_comments( $comments_query );
    
    return count($comments);
}