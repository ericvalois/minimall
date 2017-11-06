<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package minimal
 */
/*
* Custom action hook
*/
add_action("wp_head","minimall_action_head_open", 5);
function minimall_action_head_open(){
    do_action('minimall_head_open');
}

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
add_action( 'wp_head', 'minimall_pingback_header' );
function minimall_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}

/*
* Wrap all table for a better responsive world
*/
add_filter( 'the_content', 'minimall_filter_tableContentWrapper' );
function minimall_filter_tableContentWrapper($content) {

	$minimall_content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
    $minimall_doc = new DOMDocument();

    libxml_use_internal_errors(true);
    if( !empty($minimall_content) ){
    	$minimall_doc->loadHTML(utf8_decode($minimall_content));
    }else{
    	return;
    }


	$items = $minimall_doc->getElementsByTagName('table');
	foreach ($items as $item) {

		if( $item->parentNode->tagName == 'body' ) {

			$wrapperDiv = $minimall_doc->createElement('div');
			$wrapperDiv->setAttribute('class', 'overflow-auto');

			$item->parentNode->replaceChild($wrapperDiv, $item);
    		$wrapperDiv->appendChild($item);

		}
	}

	$minimall_html_fragment = preg_replace('/^<!DOCTYPE.+?>/', '', str_replace( array('<html>', '</html>', '<body>', '</body>'), array('', '', '', ''), $minimall_doc->saveHTML()));
    return $minimall_html_fragment;
}

/*
* Same tag cloud font size
*/
add_filter('wp_generate_tag_cloud', 'minimall_tag_cloud',10,1);
function minimall_tag_cloud($string){
   return preg_replace("/style='font-size:.+pt;'/", '', $string);
}


/**
 * Move Comment field to the end
 */
add_filter( 'comment_form_fields', 'minimall_move_comment_field_to_bottom' );
function minimall_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}

/**
 * Remove novalidate from comment form
 */
add_action( 'wp_footer', 'minimall_enable_comment_form_validation' );
function minimall_enable_comment_form_validation() {
    if ( (!is_admin()) && is_singular() && comments_open() && get_option('thread_comments') && current_theme_supports( 'html5' ) && !is_page_template("templates/landing-page.php") )  {
        echo '<script>document.getElementById("commentform").removeAttribute("novalidate");</script>' . PHP_EOL;
    }
}

add_action("wp_footer","minimall_custom_js", 99);
function minimall_custom_js(){
  echo '<script>';

  do_action('minimall_footer_scripts');

  echo '</script>';
}

/**
 * Add custom body class for typography
 */
add_filter( 'body_class','minimall_body_classes_typo' );
function minimall_body_classes_typo( $classes ) {
    $classes[] = 'typo';

    return $classes;
}

/**
 * Add custom post class for blog page
 */
add_filter( 'post_class','minimall_post_classes_blog_template' );
function minimall_post_classes_blog_template( $classes ) {
    if( is_archive() || is_home() || is_search() ){
        $classes[] = 'mb4';
    }
      
    return $classes;
}

/**
 * Add custom class to logo
 */
add_filter( 'get_custom_logo', 'minimall_logo_class' );
function minimall_logo_class( $html ) {

    $html = str_replace( 'custom-logo', 'custom-logo', $html );
    $html = str_replace( 'custom-logo-link', 'border-none line-height-1 custom-logo-link', $html );

    return $html;
}

/**
 * Automatically add IDs to headings for anchor purpose
 */
//add_filter( 'the_content', 'minimall_auto_id_headings' ); 
function minimall_auto_id_headings( $content ) {
    if( is_page() || is_single() ){
        $content = preg_replace_callback( '/(\<h[1-6](.*?))\>(.*)(<\/h[1-6]>)/i', function( $matches ) {
            if ( ! stripos( $matches[0], 'id=' ) ) :
                $matches[0] = $matches[1] . $matches[2] . ' id="' . sanitize_title( $matches[3] ) . '">' . $matches[3] . $matches[4];
            endif;
            return $matches[0];
        }, $content );
    }
	
    return $content;
}

/**
 * Custom read more link
 */
add_filter( 'the_excerpt', 'minimall_the_excerpt_more_link', 21 );
function minimall_the_excerpt_more_link( $excerpt ){
    $post = get_post();
    $excerpt .= '<a class="more-link btn btn-black caps xxs-text btn-big system-font" href="'. get_the_permalink() .'">' . __("Continue reading","minimal") . '</a>';
    return $excerpt;
}

/**
 * Custom read more link 2
 */
add_filter( 'the_content_more_link', 'minimall_modify_read_more_link' );
function minimall_modify_read_more_link() {
    return '<div class="block"><a class="more-link btn btn-black caps xxs-text btn-big system-font" href="' . get_permalink() . '">'. esc_html__("Continue reading","minimal").'</a></div>';
}

/**
 * Custom share buttons
 */
add_filter( "the_content", "minimall_social_share" );
function minimall_social_share($content){

    $page_options = minimall_page_options();
    $theme_options = minimall_theme_options();

    if( 
        (is_singular('post') || ( get_post_type() == 'page' && !is_page_template() ) ) 
        && empty( $page_options['disable_share'] ) 
        && !empty( $theme_options['share']['activate'] ) 
        && !empty( $theme_options['share'] ) 
    ):

        $content .= '<hr class="clearfix col-12 m0 border-none"><hr class="m0 mt2 border-none"><h5 class="mb2 mt0 hide-prin">' . esc_html__("Share this","minimal") . '</h5>';
        
        $content .= '<div class="social-share-btns max-width-3 ml-auto mr-auto lg-px0 hide-print system-font">';

        if( !empty( $theme_options['share']['facebook'] ) ){
            $content .= '<a target="_blank" href="http://www.facebook.com/sharer.php?u=' . get_permalink() . '&t=' . urlencode( get_the_title() ) . '" class="mb1 mr1 inline-block share-btn share-btn-facebook"><svg class="nc-align-to-text"><use href="#nc-logo-fb-simple"/></svg> ' . esc_html__("Share","minimal") . '</a>';
        }
        
        if( !empty( $theme_options['share']['twitter'] ) ){
            $content .= '<a target="_blank" href="http://twitter.com/home?status=' . urlencode( get_the_title() ) . '+' . get_permalink() . '" class="mb1 mr1 inline-block  share-btn share-btn-twitter"><svg class="nc-align-to-text"><use href="#nc-logo-twitter"/></svg> ' . esc_html__("Tweet","minimal") . '</a>';
        }

        if( !empty( $theme_options['share']['google'] ) ){
            $content .= '<a target="_blank" href="https://plus.google.com/share?url=' . get_permalink() . '" class="mb1 mr1 inline-block  share-btn share-btn-google-plus"><svg class="nc-align-to-text"><use href="#nc-logo-google-plus"/></svg> ' . esc_html__("Share","minimal") . '</a>';
        }

        if( !empty( $theme_options['share']['linkedin'] ) ){
            $content .= '<a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=' . get_permalink() . '&title=' . urlencode( get_the_title() ) . '" class="mb1 mr1 inline-block  share-btn share-btn-linkedin"><svg class="nc-align-to-text"><use href="#nc-logo-linkedin"/></svg> ' . esc_html__("Share","minimal") . '</a>';
        }

        if( !empty( $theme_options['share']['pinterest'] ) ){
            $pinterest_link = "javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','https://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());";
            $content .= '<a target="_blank" href="'. $pinterest_link .'" class="mb1 mr1 inline-block  share-btn share-btn-pinterest"><svg class="nc-align-to-text"><use href="#nc-logo-pinterest"/></svg> ' . esc_html__("Pin","minimal") . '</a>';
        }

        $content .= '</div>';
    
    endif;

	return $content;
}

/*
* Inline default hero image
*/
add_action( 'minimall_mobile_styles', 'minimall_default_hero' );
function minimall_default_hero() {

    $minimall_image_id = minimall_select_hero_image();
    
    if( $minimall_image_id && !is_page_template("templates/landing-page.php") ){
        $path = wp_get_attachment_image_src( $minimall_image_id, 'minimall-hero-placeholder' );
        $type = pathinfo($path[0], PATHINFO_EXTENSION);
        $data = minimall_get_response($path[0]);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $minimall_sm_hero = '
            .bg-default{
                background-image: url(' . $base64 . ');
            }
        ';
        
        if( !is_page_template('templates/blank.php') ){
            echo minimall_compress( $minimall_sm_hero );
        }
        
    }
}

/**
 * Enqueue Font Awesome Icons.
 */
add_action( 'wp_enqueue_scripts', 'minimall_font_awesome_scripts' );
function minimall_font_awesome_scripts() {
    $font = get_theme_mod('fontawesome');

	/* If using a child theme, auto-load the parent theme style. */
    if ( $font ) {
        $font_type = get_theme_mod('fontawesome_type', 'solid');
        if( $font_type == 'solid' ){
            wp_enqueue_script( 'fontawesome-light', get_template_directory_uri() . '/includes/vendors/fontawesome/packs/solid.min.js', array(), '', true );
        }elseif( $font_type == 'regular' ){
            wp_enqueue_script( 'fontawesome-light', get_template_directory_uri() . '/includes/vendors/fontawesome/packs/regular.min.js', array(), '', true );
        }elseif( $font_type == 'light'){
            wp_enqueue_script( 'fontawesome-light', get_template_directory_uri() . '/includes/vendors/fontawesome/packs/light.min.js', array(), '', true );
        }

        if( get_theme_mod('fontawesome_brands', false) ){
            wp_enqueue_script( 'fontawesome-brands', get_template_directory_uri() . '/includes/vendors/fontawesome/packs/brands.min.js', array(), '', true );
        }

        wp_enqueue_script( 'fontawesome-v4-shim', get_template_directory_uri() . '/includes/vendors/fontawesome/v4-shims.min.js', array(), '', true );
        wp_enqueue_script( 'fontawesome-core', get_template_directory_uri() . '/includes/vendors/fontawesome/fontawesome.min.js', array(), '', true );
    }
}

/**
 * Display header
 */
add_action('minimall_header', 'minimall_display_header');
function minimall_display_header(){
?>
<header id="masthead" class="site-header line-height-3 flex items-center flex-wrap col-12 bg-white py1 px2" role="banner">
        
    <div class="flex justify-between items-center lg-flex col-12 lg-col-3 line-height-1 header-menu">
        <div class="site-branding flex-auto col-6 lg-col-2 flex items-center">
            <?php get_template_part( 'template-parts/custom', 'logo' ); ?>
        </div><!-- .site-branding -->

        <button id="main_nav_toggle" class="menu-toggle lg-hide p0 border-none bg-white" aria-controls="primary-menu" aria-expanded="false">
            <svg class="menu-open" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" xml:space="preserve" width="64" height="64"><g class="" fill="#444444"><line data-color="color-2" fill="none" stroke="#444444" stroke-width="3" stroke-linecap="square" stroke-miterlimit="10" x1="4" y1="32" x2="60" y2="32" stroke-linejoin="miter"></line> <line fill="none" stroke="#444444" stroke-width="3" stroke-linecap="square" stroke-miterlimit="10" x1="4" y1="14" x2="60" y2="14" stroke-linejoin="miter"></line> <line fill="none" stroke="#444444" stroke-width="3" stroke-linecap="square" stroke-miterlimit="10" x1="4" y1="50" x2="60" y2="50" stroke-linejoin="miter"></line></g></svg>
            <svg class="menu-close" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" xml:space="preserve" width="64" height="64"><g class="" fill="#444444" transform="translate(0.5, 0.5)"><line fill="none" stroke="#444444" stroke-width="3" stroke-linecap="square" stroke-miterlimit="10" x1="54" y1="10" x2="10" y2="54" stroke-linejoin="miter"></line> <line fill="none" stroke="#444444" stroke-width="3" stroke-linecap="square" stroke-miterlimit="10" x1="54" y1="54" x2="10" y2="10" stroke-linejoin="miter"></line></g></svg>
        </button><!-- .menu-toggle -->
    </div><!-- .header-menu -->
    

    <nav itemtype="http://schema.org/SiteNavigationElement" itemscope="itemscope" id="site-navigation" class="main-navigation lg-block col-12 lg-col-9" role="navigation">
        <?php
            if ( has_nav_menu( 'primary' ) ) {
                minimall_custom_menu('primary');
            }
        ?>
    </nav><!-- .main-navigation -->

</header>
<?php
}

function minimall_site_content_class(){
    $class = array();
    $class['initial'] = "site-content";
    $class['padding'] = "px2";
    $class['margin'] = 'ml-auto mr-auto';

    $class = implode(" ",$class);
    echo 'class="' . $class . '"';
}




                        

                        
                      
                    
                
/*
* Add markup for after content hook
*/
add_action('minimall_after_content','minimall_after_content_begin', 1);
function minimall_after_content_begin(){
    echo '<div class="max-width-3 ml-auto mr-auto px2 lg-px0">';
}

/*
* Add markup for after content hook
*/
add_action('minimall_after_content','minimall_after_content_end', 999);
function minimall_after_content_end(){
    echo '</div>';
}

/**
 * Custom share buttons
 */
add_action('minimall_after_content','minimal_social_share', 30);
function minimal_social_share(){


    if( (is_singular('post') || ( get_post_type() == 'page' && !is_page_template() ) ) 
        && get_theme_mod('activate_social_share',true) 
    ):
        $active_media = get_theme_mod('social_share', array('facebook', 'twitter', 'google', 'linkedin', 'pinterest'));

        $content = '';

        $content .= '<h5 class="mt4 mb2 mt0 hide-prin">' . esc_html( get_theme_mod('social_share_label',__('Share this','minimal')) ) . '</h5>';
        
        $content .= '<div class="social-share-btns max-width-3 ml-auto mr-auto lg-px0 hide-print system-font">';

        if( in_array( 'facebook', $active_media ) ){
            $content .= '<a target="_blank" href="http://www.facebook.com/sharer.php?u=' . get_permalink() . '&t=' . urlencode( get_the_title() ) . '" class="mb1 mr1 inline-block share-btn share-btn-facebook"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" xml:space="preserve" width="16" height="16"><g class="" fill="#ffffff"><path fill="#ffffff" d="M6.02293,16L6,9H3V6h3V4c0-2.6992,1.67151-4,4.07938-4c1.15339,0,2.14468,0.08587,2.43356,0.12425v2.82082 l-1.66998,0.00076c-1.30953,0-1.56309,0.62227-1.56309,1.53541V6H13l-1,3H9.27986v7H6.02293z"></path></g></svg> ' . esc_html__("Share","ttfb") . '</a>';
        }
        
        if( in_array( 'twitter', $active_media ) ){
            $content .= '<a target="_blank" href="http://twitter.com/home?status=' . urlencode( get_the_title() ) . '+' . get_permalink() . '" class="mb1 mr1 inline-block  share-btn share-btn-twitter"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" xml:space="preserve" width="16" height="16"><g class="" fill="#ffffff"><path fill="#ffffff" d="M16,3c-0.6,0.3-1.2,0.4-1.9,0.5c0.7-0.4,1.2-1,1.4-1.8c-0.6,0.4-1.3,0.6-2.1,0.8c-0.6-0.6-1.5-1-2.4-1 C9.3,1.5,7.8,3,7.8,4.8c0,0.3,0,0.5,0.1,0.7C5.2,5.4,2.7,4.1,1.1,2.1c-0.3,0.5-0.4,1-0.4,1.7c0,1.1,0.6,2.1,1.5,2.7 c-0.5,0-1-0.2-1.5-0.4c0,0,0,0,0,0c0,1.6,1.1,2.9,2.6,3.2C3,9.4,2.7,9.4,2.4,9.4c-0.2,0-0.4,0-0.6-0.1c0.4,1.3,1.6,2.3,3.1,2.3 c-1.1,0.9-2.5,1.4-4.1,1.4c-0.3,0-0.5,0-0.8,0c1.5,0.9,3.2,1.5,5,1.5c6,0,9.3-5,9.3-9.3c0-0.1,0-0.3,0-0.4C15,4.3,15.6,3.7,16,3z"></path></g></svg> ' . esc_html__("Tweet","ttfb") . '</a>';
        }

        if( in_array( 'google', $active_media ) ){
            $content .= '<a target="_blank" href="https://plus.google.com/share?url=' . get_permalink() . '" class="mb1 mr1 inline-block  share-btn share-btn-google-plus"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" xml:space="preserve" width="16" height="16"><g class="" fill="#ffffff"><path fill="#ffffff" d="M8,7v2.4h4.1c-0.2,1-1.2,3-4,3c-2.4,0-4.3-2-4.3-4.4s2-4.4,4.3-4.4 c1.4,0,2.3,0.6,2.8,1.1l1.9-1.8C11.6,1.7,10,1,8.1,1c-3.9,0-7,3.1-7,7s3.1,7,7,7c4,0,6.7-2.8,6.7-6.8c0-0.5,0-0.8-0.1-1.2H8L8,7z"></path></g></svg> ' . esc_html__("Share","ttfb") . '</a>';
        }

        if( in_array( 'linkedin', $active_media ) ){
            $content .= '<a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=' . get_permalink() . '&title=' . urlencode( get_the_title() ) . '" class="mb1 mr1 inline-block  share-btn share-btn-linkedin"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" xml:space="preserve" width="16" height="16"><g class="" fill="#ffffff"><path fill="#ffffff" d="M15.3,0H0.7C0.3,0,0,0.3,0,0.7v14.7C0,15.7,0.3,16,0.7,16h14.7c0.4,0,0.7-0.3,0.7-0.7V0.7 C16,0.3,15.7,0,15.3,0z M4.7,13.6H2.4V6h2.4V13.6z M3.6,5C2.8,5,2.2,4.3,2.2,3.6c0-0.8,0.6-1.4,1.4-1.4c0.8,0,1.4,0.6,1.4,1.4 C4.9,4.3,4.3,5,3.6,5z M13.6,13.6h-2.4V9.9c0-0.9,0-2-1.2-2c-1.2,0-1.4,1-1.4,2v3.8H6.2V6h2.3v1h0c0.3-0.6,1.1-1.2,2.2-1.2 c2.4,0,2.8,1.6,2.8,3.6V13.6z"></path></g></svg> ' . esc_html__("Share","ttfb") . '</a>';
        }

        if( in_array( 'pinterest', $active_media ) ){
            $pinterest_link = "javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','https://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());";
            $content .= '<a target="_blank" href="'. $pinterest_link .'" class="mb1 mr1 inline-block  share-btn share-btn-pinterest"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" xml:space="preserve" width="16" height="16"><g class="" fill="#ffffff"><path fill="#ffffff" d="M8,0C3.6,0,0,3.6,0,8c0,3.4,2.1,6.3,5.1,7.4c-0.1-0.6-0.1-1.6,0-2.3c0.1-0.6,0.9-4,0.9-4S5.8,8.7,5.8,8 C5.8,6.9,6.5,6,7.3,6c0.7,0,1,0.5,1,1.1c0,0.7-0.4,1.7-0.7,2.7c-0.2,0.8,0.4,1.4,1.2,1.4c1.4,0,2.5-1.5,2.5-3.7 c0-1.9-1.4-3.3-3.3-3.3c-2.3,0-3.6,1.7-3.6,3.5c0,0.7,0.3,1.4,0.6,1.8C5,9.7,5,9.8,5,9.9c-0.1,0.3-0.2,0.8-0.2,0.9 c0,0.1-0.1,0.2-0.3,0.1c-1-0.5-1.6-1.9-1.6-3.1C2.9,5.3,4.7,3,8.2,3c2.8,0,4.9,2,4.9,4.6c0,2.8-1.7,5-4.2,5c-0.8,0-1.6-0.4-1.8-0.9 c0,0-0.4,1.5-0.5,1.9c-0.2,0.7-0.7,1.6-1,2.1C6.4,15.9,7.2,16,8,16c4.4,0,8-3.6,8-8C16,3.6,12.4,0,8,0z"></path></g></svg> ' . esc_html__("Pin","ttfb") . '</a>';
        }

        $content .= '</div>';

        echo $content;
    
    endif;

}

/*
* Add comment to posts and pages
*/
add_action('minimall_after_content','minimall_display_entry_footer',40);
function minimall_display_entry_footer(){
    minimall_entry_footer();
}

/*
* Add posts footer sidebar
*/
add_action('minimall_after_content','minimall_posts_footer_sidebar', 50);
function minimall_posts_footer_sidebar(){
    if ( is_active_sidebar( 'blog-footer-sidebar' ) && is_singular('post') ) {
    ?>
        <section class="mt4 mb4 widget-area" role="complementary">
            <?php dynamic_sidebar( 'blog-footer-sidebar' ); ?>
        </section>
    <?php 
    }
}

/*
* Add comment to posts and pages
*/
add_action('minimall_after_content','minimall_comment',100);
function minimall_comment(){
    if ( comments_open() || get_comments_number() ) :
        
        $comments_number = get_comments_number();
        if ( $comments_number == 1 ) {
            $comment_label = esc_html__("Comment","minimal");
        } elseif( $comments_number > 1 ) {
            $comment_label = esc_html__("Comments","minimal");
        }
        if( isset($comment_label) ){
            echo '<h3 class="comments-title separator mt4 mb4 h1 center bold">';
            echo $comment_label;
            echo '</h3>';
        }

        comments_template();
    endif;
}
