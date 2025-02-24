<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package minimal
 */
/*
* Custom action hook
*/
add_action("wp_head","minimall_action_head_open", -10);
function minimall_action_head_open(){
    do_action('ttfb_toolkit_head_open');
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
//add_filter( 'the_content', 'minimall_filter_tableContentWrapper' );
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
        echo '<script>
            if( document.getElementById("commentform") ){
                document.getElementById("commentform").removeAttribute("novalidate");
            }
        </script>' . PHP_EOL;
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
    $classes[] = 'typo break-word';

    return $classes;
}

/**
 * Add custom post class for posts
 */
add_filter( 'post_class','minimall_article_class' );
function minimall_article_class( $classes ) {
    if( is_archive() || is_home() || is_search() ){
        $classes[] = 'mb4'; 
    }elseif( is_page_template("templates/full-width.php") ){
        $classes[] = 'entry-content-full';
    }elseif( is_singular("download") ){
        $classes[] = 'entry-content-full max-width-5 ml-auto mr-auto first-mt0 mt3 lg-mt4 mb3 px2';
    }elseif( is_single() ){
        $classes[] = 'entry-content max-width-3 ml-auto mr-auto first-mt0'; 
    }elseif( 
        ( is_single() || is_page() ) && 
        ( !is_singular('download') && !is_page_template() ) &&
        !minimall_is_gutenberg_post()
    ){
        $classes[] = '';
    }
      
    return $classes;
}

/*
* 
*/
//add_filter( 'post_class','minimall_private_dashboard_class' );
function minimall_private_dashboard_class(){
    /*if( is_page_template("templates/private-dashboard.php") ){
        $classes[] = 'clearfix break-word relative max-width-5 px2 ml-auto mr-auto mt3 lg-mt4 mb3';
    }*/

    return $classes;
}

/*
* Deprecated
*/
function minimall_site_content_class(){ 
    return false;
}

/**
 * Add custom post class for home, archive, search
 */
add_filter( 'post_class','minimall_archive_class' );
function minimall_archive_class( $classes = array() ) {
    if( is_archive() || is_home() || is_search() ){
        $classes[] = 'max-width-5';
    }
      
    return $classes;
}

/**
 * Add custom class to logo
 */
add_filter( 'get_custom_logo', 'minimall_logo_class' );
function minimall_logo_class( $html ) {

    $html = str_replace( 'custom-logo', 'custom-logo border-none', $html );
    $html = str_replace( 'custom-logo-link', 'border-none line-height-1 custom-logo-link', $html );
    $html = str_replace( 'class"custom-logo', 'data-no-lazy="true" class="custom-logo', $html );

    return $html;
}

/**
 * 
 */
add_filter( 'get_custom_logo', 'minimall_logo_no_lazy' );
function minimall_logo_no_lazy( $html ) {

    $html = str_replace( 'class"custom-logo', 'data-no-lazy="true" class="custom-logo', $html );

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
    global $post;

    if( $post->post_type == 'post' ){
        $excerpt .= '<a class="more-link btn btn-default caps xs-text" href="'. get_the_permalink() .'">' . __("Continue reading","minimall") . '</a>';
    }else{
        $excerpt = $excerpt;
    }
    
    return $excerpt;
}

/**
 * Custom read more link 2
 */
add_filter( 'the_content_more_link', 'minimall_modify_read_more_link' );
function minimall_modify_read_more_link() {
    return '<div class="block"><a class="more-link btn btn-default caps xs-text" href="' . get_permalink() . '">'. esc_html__("Continue reading","minimall").'</a></div>';
}

/**
 * Display header
 */
add_action('minimall_header', 'minimall_display_header');
function minimall_display_header(){
?>
<header id="masthead" class="site-header line-height-3 flex items-center flex-wrap col-12 bg-white py2 px2 overflow-hidden lg-overflow-visible" role="banner">
        
    <div class="flex col-12 lg-col-auto justify-between items-center line-height-1 header-menu">
        <div class="site-branding flex-auto inline-flex items-center">
            <?php get_template_part( 'template-parts/custom', 'logo' ); ?>
            <?php do_action('minimall_after_custom_logo'); ?>
        </div><!-- .site-branding -->

        <?php if ( has_nav_menu( 'primary' ) || is_active_sidebar( 'header-sidebar' ) ) : ?>
            <button id="main_nav_toggle" class="menu-toggle lg-hide p0 border-none bg-white" aria-controls="primary-menu" aria-expanded="false">
                <svg class="menu-open" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" xml:space="preserve" width="64" height="64"><g class="" fill="#444444"><line data-color="color-2" fill="none" stroke="#444444" stroke-width="3" stroke-linecap="square" stroke-miterlimit="10" x1="4" y1="32" x2="60" y2="32" stroke-linejoin="miter"></line> <line fill="none" stroke="#444444" stroke-width="3" stroke-linecap="square" stroke-miterlimit="10" x1="4" y1="14" x2="60" y2="14" stroke-linejoin="miter"></line> <line fill="none" stroke="#444444" stroke-width="3" stroke-linecap="square" stroke-miterlimit="10" x1="4" y1="50" x2="60" y2="50" stroke-linejoin="miter"></line></g></svg>
                <svg class="menu-close" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" xml:space="preserve" width="64" height="64"><g class="" fill="#444444" transform="translate(0.5, 0.5)"><line fill="none" stroke="#444444" stroke-width="3" stroke-linecap="square" stroke-miterlimit="10" x1="54" y1="10" x2="10" y2="54" stroke-linejoin="miter"></line> <line fill="none" stroke="#444444" stroke-width="3" stroke-linecap="square" stroke-miterlimit="10" x1="54" y1="54" x2="10" y2="10" stroke-linejoin="miter"></line></g></svg>
            </button><!-- .menu-toggle -->
        <?php endif; ?>
    </div><!-- .header-menu -->
    
    <nav id="site-navigation" class="lg-flex flex-auto items-center <?php echo get_theme_mod('header_alignment','justify-end'); ?>  lg-pl2 sm-text">
        <?php do_action('minimall_header_sidebar'); ?>
    </nav>
    

</header>
<?php
}

/**
 * Display primary menu
 */
add_action('minimall_header_sidebar', 'minimall_display_primary_menu', 10);
function minimall_display_primary_menu(){
    if ( has_nav_menu( 'primary' ) ) :
        wp_nav_menu( array( 
                        'theme_location' => 'primary', 
                        'container' => '', 
                        'menu_class' => 'menu mxn2 p0 lg-m0 list-reset', 
                        'before' => '<span class="item">', 
                        'after'=>'</span>',
                        'items_wrap' => '<ul class="%2$s">%3$s</ul>'
        ) );
    endif;
}

/**
 * Add class to primary menu LI
 */
add_filter('nav_menu_css_class', 'minimall_primary_menu_more_classes_li', 1, 3);
function minimall_primary_menu_more_classes_li($classes, $item, $args) {
    if($args->theme_location == 'primary') {
        $classes[] = 'm0 lg-mx1 relative lg-inline-block lg-py1';
    }
    return $classes;
    
}

/**
 * Add class to primary menu a
 */
add_filter('wp_nav_menu','minimall_primary_menu_more_classes_link');
function minimall_primary_menu_more_classes_link( $initial ) {
    return preg_replace('/<a /', '<a class="text-color weight500 font-size-100 nowrap lg-p1"', $initial);
}

  
/**
 * Add top sidebar
 */
add_action('minimall_header_sidebar', 'minimall_top_header_sidebar', 20);
function minimall_top_header_sidebar(){
    if ( is_active_sidebar( 'header-sidebar' )  ) {
        dynamic_sidebar( 'header-sidebar' );
    }
}

/*
* Return full width template classes
*/
function minimall_get_full_width_template_class( $class = array() ){
	if(has_filter('minimall_full_width_template_class')) {
		$class = apply_filters('minimall_full_width_template_class', $class);
	}
 
	return $class;
}

/**
 * Add class to full width template
 */
add_filter('minimall_full_width_template_class','minimall_full_width_template_initial_class');
function minimall_full_width_template_initial_class( $class = array() ) {
    $class['initial'] = "clearfix break-word relative";
    $class['max-width'] = "max-width-5";
    $class['margin'] = 'ml-auto mr-auto mt3 lg-mt4 mb3';

    if( get_theme_mod('edd_checkout_boxed','0') && ( function_exists('edd_is_checkout') && edd_is_checkout() ) ) {
        $class['max-width'] = 'max-width-3';
    }

    $class = implode(" ",$class);
    
    return $class;
}

/** 
* Return Empty template classes
*/
function minimall_get_empty_template_class( $class = array() ){
	if(has_filter('minimall_empty_template_class')) {
		$class = apply_filters('minimall_empty_template_class', $class);
	}
 
	return $class;
}

/**
 * Add class to the Empty template
 */
add_filter('minimall_empty_template_class','minimall_empty_template_initial_class');
function minimall_empty_template_initial_class( $class = array() ) {
   
    $class = "entry-content max-width-3 ml-auto mr-auto first-mt0";

    return $class;
}

/** 
* Return Private template classes
*/
function minimall_get_private_template_class( $class = array() ){
	if(has_filter('minimall_private_template_class')) {
		$class = apply_filters('minimall_private_template_class', $class);
	}
 
	return $class;
}

/**
 * Add class to the private template
 */
add_filter('minimall_private_template_class','minimall_private_template_initial_class');
function minimall_private_template_initial_class( $class = array() ) {
   
    $class = "clearfix break-word relative max-width-5 px2 ml-auto mr-auto mt3 lg-mt4 mb3";

    return $class;
}


              
/*
* Add markup for after content hook
*/
add_action('minimall_after_post_content','minimall_after_content_begin', 1);
add_action('minimall_after_page_content','minimall_after_content_begin', 1);
function minimall_after_content_begin(){
    echo '<div class="px2">';
}

/*
* Add markup for after content hook
*/
add_action('minimall_after_post_content','minimall_after_content_end', 999);
add_action('minimall_after_page_content','minimall_after_content_end', 999);
function minimall_after_content_end(){
    echo '</div>';
}

/*
* Add posts cetagories and tags to posts footer
*/
add_action('minimall_after_post_content','minimall_display_entry_footer',40);
function minimall_display_entry_footer(){
    minimall_entry_footer();
}

/*
* Add before posts content sidebar
*/
add_action('minimall_before_post_content','minimall_post_header_sidebar', 10);
function minimall_post_header_sidebar(){
    global $post;

    if( !is_singular("post") ){ return false; }
    if( !is_active_sidebar( 'post-header-sidebar' ) ){ return false; }
    if( get_post_meta($post->ID, "minimall-hide-after-sidebar", true) ){ return false; }
?>
    <section class="widget-area px2" role="complementary">
        <?php dynamic_sidebar( 'post-header-sidebar' ); ?>
    </section>
<?php 
}

/*
* Add after posts content sidebar
*/
add_action('minimall_after_post_content','minimall_post_footer_sidebar', 50);
function minimall_post_footer_sidebar(){
    global $post;

    if( !is_singular("post") ){ return false; }
    if( !is_active_sidebar( 'post-footer-sidebar' ) ){ return false; }
    if( get_post_meta($post->ID, "minimall-hide-after-sidebar", true) ){ return false; }
?>
    <section class="mt4 mb4 widget-area" role="complementary">
        <?php dynamic_sidebar( 'post-footer-sidebar' ); ?>
    </section>
<?php 
}


/*
* Add before pages content sidebar
*/
add_action('minimall_before_page_content','minimall_pages_header_sidebar', 10);
function minimall_pages_header_sidebar(){

    global $post;

    if( !is_page() ){ return false; }
    if( !is_active_sidebar( 'page-header-sidebar' ) ){ return false; }
    if( get_post_meta($post->ID, "minimall-hide-before-sidebar", true) ){ return false; }
?>
        <section class="widget-area px2" role="complementary">
            <?php dynamic_sidebar( 'page-header-sidebar' ); ?>
        </section>
<?php
}

/*
* Add after pages content sidebar
*/
add_action('minimall_after_page_content','minimall_pages_footer_sidebar', 50);
function minimall_pages_footer_sidebar(){

    global $post;
    
    if( !is_page() ){ return false; }
    if( !is_active_sidebar( 'page-footer-sidebar' ) ){ return false; }
    if( get_post_meta($post->ID, "minimall-hide-after-sidebar", true) ){ return false; }
?>
        <section class="mt4 mb4 widget-area" role="complementary">
            <?php dynamic_sidebar( 'page-footer-sidebar' ); ?>
        </section>
    <?php
}

/*
* Add after content sidebar on the Empty template
*/
add_action('minimall_after_empty_content','minimall_empty_footer_sidebar', 50);
function minimall_empty_footer_sidebar(){
    global $post;

    if( !is_object($post) ){ return false; }   
    if( !is_active_sidebar( 'empty-footer-sidebar' ) ){ return false; }
    if( get_post_meta($post->ID, "minimall-hide-after-sidebar", true) ){ return false; }

?>
    <section class="mt4 mb4 widget-area" role="complementary">
        <?php dynamic_sidebar( 'empty-footer-sidebar' ); ?>
    </section>
<?php 
}

/*
* Add comment to posts and pages
*/
add_action('minimall_after_post_content','minimall_comment',100);
add_action('minimall_after_page_content','minimall_comment',100);
add_action('minimall_after_empty_content','minimall_comment',100);
function minimall_comment(){
    if ( ( comments_open() || get_comments_number() ) && !is_singular('download') ) :
        
        echo '<section class="comment-section max-width-3 ml-auto mr-auto">';

        comments_template();

    endif;
}

/*
* Add Minimall's footer hero
*/
add_action('minimall_footer','minimall_footer_hero', 10);
function minimall_footer_hero(){
    get_template_part( 'template-parts/footer/hero' );
}

/*
* Add Minimall's footer widgets
*/
add_action('minimall_footer','minimall_footer_widgets', 20);
function minimall_footer_widgets(){
    get_template_part( 'template-parts/footer/widgets' );
}

/*
* Add Minimall's footer copyright
*/
add_action('minimall_footer','minimall_footer_copyright', 30);
function minimall_footer_copyright(){
    get_template_part( 'template-parts/footer/copyright' );
}

/*
* Add edit post link
*/
add_action('minimall_after_post_content','minimall_edit_post_link',1);
add_action('minimall_after_page_content','minimall_edit_post_link',1);
function minimall_edit_post_link(){
    get_template_part( 'template-parts/edit-post-link' );
}