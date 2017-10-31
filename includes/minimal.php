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
    $theme_options = minimall_theme_options();

	/* If using a child theme, auto-load the parent theme style. */
    if ( $theme_options['fontawesome'] == 1 ) {
        if( $theme_options['fontawesome_type'] == 'solid' ){
            wp_enqueue_script( 'fontawesome-light', get_template_directory_uri() . '/includes/vendors/fontawesome/packs/solid.min.js', array(), '', true );
        }elseif( $theme_options['fontawesome_type'] == 'regular' ){
            wp_enqueue_script( 'fontawesome-light', get_template_directory_uri() . '/includes/vendors/fontawesome/packs/regular.min.js', array(), '', true );
        }elseif( $theme_options['fontawesome_type'] == 'light'){
            wp_enqueue_script( 'fontawesome-light', get_template_directory_uri() . '/includes/vendors/fontawesome/packs/light.min.js', array(), '', true );
        }
        wp_enqueue_script( 'fontawesome-v4-shim', get_template_directory_uri() . '/includes/vendors/fontawesome/v4-shims.min.js', array(), '', true );
        wp_enqueue_script( 'fontawesome-core', get_template_directory_uri() . '/includes/vendors/fontawesome/fontawesome.min.js', array(), '', true );
    }
}