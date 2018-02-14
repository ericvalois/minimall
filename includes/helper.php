<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package minimal
 */

/*
* Show or hide content animation
*/
function minimall_content_animation(){

    return;

    if( minimall_get_field("perf_show_fade","option") == 1 ){
        return 'animated fadeIn opacity-zero';
    }else{
        return;
    }
}

/**
 * Custom comment markup
 */
function minimall_custom_comments($comment, $args, $depth) {
    global $post;
   
    $post_author = get_userdata($post->post_author);
    $GLOBALS['comment'] = $comment; ?>


    <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
            
        <div class="comment-intro clearfix line-height-4">
            <div class="left mr1 mb1 "><?php echo get_avatar( $comment->comment_author_email, 48, "", "", array("class" => "rounded") ); ?></div> 
            <span class="sm-text bold upper"><?php printf(__('%s','minimall'), get_comment_author_link()) ?> </span>
            <span><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
            <br>
            <span class="comment_date upper sm-text"><?php printf(__('%1$s','minimall'), get_comment_date(), get_comment_time()) ?></span>
        </div>
        
        <?php if ($comment->comment_approved == '0') : ?>
            <em><php _e('Your comment is awaiting moderation.','minimall'); ?></em><br />
        <?php endif; ?>

        <div class="sm-text comment-content mb2 py1">
            <?php comment_text(); ?>
        </div>
        
<?php } 


/**
 * Minify string on the fly
 *
 * @params  $minify  String to minify
 * @returns String minified
 */
function minimall_compress( $minify ){
    // Remove space after colons
    $minify = str_replace(': ', ':', $minify);
    // Remove whitespace
    $minify = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $minify);

    return $minify;
}


/**
 * Custom WordPress Menu Markup
 */
/*
function minimall_custom_menu( $theme_location ) {
    if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
        $menu = get_term( $locations[$theme_location], 'nav_menu' );
        $menu_items = wp_get_nav_menu_items($menu->term_id);

        $menu_list = '<ul class="list-reset m0 weight500">' ."\n";
 
        $count = 0;
        $submenu = false;
        
        global $post;

        if( is_array($menu_items) && !empty( $menu_items ) ){
            foreach( $menu_items as $menu_item ) {
                
                $link = $menu_item->url;
                $title = $menu_item->title;
                $class = $menu_item->classes;

                if( is_object( $post ) ){

                    if( $menu_item->object_id == $post->ID || ( $menu_item->object_id == get_option( 'page_for_posts' ) && is_home() ) ){
                        $active = ' active ';
                    }else{
                        $active = '';
                    }

                }else{
                    $active = '';
                }
                
                if ( !$menu_item->menu_item_parent ) {
                    $parent_id = $menu_item->ID;
                    
                    $menu_list .= '<li class="lg-ml1 mt2 mb2 lg-mt0 lg-mb0 item relative block lg-inline-block lg-px1 lg-py1 line-height-1">' ."\n";
                    $menu_list .= '<a href="'.$link.'" class="text-decoration-none sm-text black inline-flex items-center ' . $active . implode(" ",$class) . '">' ."\n";               
                    $menu_list .= $title ."\n";
                    $menu_list .= '</a>' ."\n";
                }
    
                if ( $parent_id == $menu_item->menu_item_parent ) {

                        
                    if ( !$submenu ) {
                        $submenu = true;
                        $menu_list .= '<button class="sub-menu-toggle px0 py0 z4"></button>';

                        $menu_list .= '<ul class="sub-menu  list-reset mt0 mb0 ml2 lg-ml0">' ."\n";
                    }
    
                    $menu_list .= '<li class="mt2 mb2 lg-mt0 lg-mb0 item block lg-inline-block">' ."\n";
                    $menu_list .= '<a href="'.$link.'" class="flex items-center black text-decoration-none sm-text border-none">'.$title.'</a>' ."\n";
                    $menu_list .= '</li>' ."\n";
                        
                    
                    if ( !isset( $menu_items[ $count + 1 ] ) || $menu_items[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ){
                        $menu_list .= '</ul>' ."\n";
                        $submenu = false;
                    }
    
                }
    
                if ( !isset( $menu_items[ $count + 1 ] ) || $menu_items[ $count + 1 ]->menu_item_parent != $parent_id ) { 
                    $menu_list .= '</li>' ."\n";      
                    $submenu = false;
                }
    
                $count++;
            }
        } // end if
         
        $menu_list .= '</ul>' ."\n";
 
    } else {
        $menu_list = '<!-- no menu defined in location "'.$theme_location.'" -->';
    }
    echo $menu_list;
}
*/

/**
 * Custom Pagination Markup
 */
function minimall_pagination($pages = '', $range = 2){  
    $showitems = ($range * 2)+1;  

    global $paged;
    if(empty($paged)) $paged = 1;

    if($pages == '')
    {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages)
        {
            $pages = 1;
        }
    }   
 
    if(1 != $pages)
    {
        echo '<nav class="pagination"><ul class="list-reset flex xxs-text caps">';
        if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo '<li><a class="btn btn-black btn-black btn-small" href="'.get_pagenum_link(1).'">' .esc_html__("First","minimal"). '</a></li>';
        if($paged > 1 && $showitems < $pages) echo '<li><a class="btn btn-black btn-black btn-small" href="'.get_pagenum_link($paged - 1).'">' .esc_html__("Previus page","minimal"). '</a></li>';

        for ($i=1; $i <= $pages; $i++)
        {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
            {
                echo '<li>';
                echo ($paged == $i)? '<a class="active btn btn-black btn-black btn-small" href="#">'.$i.'</a>':'<a href="'.get_pagenum_link($i).'"  class="btn btn-black inactive btn-black btn-small">'.$i.'</a>';
                echo "</li>";
            }
        }

        if ($paged < $pages && $showitems < $pages) echo '<li><a class="btn btn-black btn-black btn-small" href="'.get_pagenum_link($paged + 1).'">' .esc_html__("Next page","minimal"). '</a></li>';  
        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo '<li class=""><a class="btn btn-black btn-black btn-small" href="'.get_pagenum_link($pages).'">' .esc_html__("Last","minimal"). '</a></li>';
        echo "</ul></nav>\n";
    }
}

/*
* Hero image selection
*/
function minimall_get_default_hero( $post_id = null ){

    if( get_theme_mod('thumb_as_hero', false) && has_post_thumbnail() && $post_id ){
        $hero_img_id = get_post_thumbnail_id( $post_id );
    }else{
        $hero_img_id = get_theme_mod('default_hero_img', false);
    }
    
    $array = array();

    if( !empty( $hero_img_id ) && is_numeric( $hero_img_id ) ){
        $array['sm'] = wp_get_attachment_image_src( $hero_img_id, 'medium' );
        $array['sm'] = $array['sm'][0];

        $array['md'] = wp_get_attachment_image_src( $hero_img_id, 'medium_large' );
        $array['md'] = $array['md'][0];

        $array['lg'] = wp_get_attachment_image_src( $hero_img_id, 'large' );
        $array['lg'] = $array['lg'][0];
    }else{
        $array['sm'] = get_template_directory_uri() . '/assets/images/default-hero-sm.jpg';
        $array['md'] = get_template_directory_uri() . '/assets/images/default-hero-md.jpg';
        $array['lg'] = get_template_directory_uri() . '/assets/images/default-hero-lg.jpg';
    }

    return $array;
}

/*
* Get homepage hero
*/
function minimall_get_homepage_hero(){
    
    $hero_img_id = get_theme_mod('home_hero_image', false);
    $array = array();

    if( !empty( $hero_img_id ) && is_numeric( $hero_img_id ) ){
        $array['sm'] = wp_get_attachment_image_src( $hero_img_id, 'medium' );
        $array['sm'] = $array['sm'][0];

        $array['md'] = wp_get_attachment_image_src( $hero_img_id, 'medium_large' );
        $array['md'] = $array['md'][0];

        $array['lg'] = wp_get_attachment_image_src( $hero_img_id, 'large' );
        $array['lg'] = $array['lg'][0];
    }else{
        $array['sm'] = get_template_directory_uri() . '/assets/images/default-homepage-hero-sm.jpg';
        $array['md'] = get_template_directory_uri() . '/assets/images/default-homepage-hero-md.jpg';
        $array['lg'] = get_template_directory_uri() . '/assets/images/default-homepage-hero-lg.jpg';
    }

    return $array;
}

/**
 * Retrieves the response from the specified URL using one of PHP's outbound request facilities.
 *
 * @params  $url  The URL of the feed to retrieve.
 * @returns The response from the URL; null if empty.
 */
function minimall_get_response( $url ) {
    $response = null;

    // First, we try to use wp_remote_get
    $response = wp_remote_get( $url );

    // If the response is an array, it's coming from wp_remote_get,
    // so we just want to capture to the body index for json_decode.
    if( is_array( $response ) && !is_wp_error( $response ) ) {
        $response = $response['body'];
    }

    return $response;
}

/**
 * Return external attribute if needed
 */
function minimall_external_link( $target = false, $nofollow = false ){
    $attributes = '';
    if( $target && $nofollow ){
        $attributes .= 'target="_blank" rel="noopener noreferrer nofollow" ';
    }elseif( $nofollow ){
        $attributes .= 'rel="nofollow" ';
    }elseif( $target ){
        $attributes .= 'target="_blank" rel="noopener noreferrer" ';
    }

    return $attributes;
}


// retrieves the attachment ID from the file URL
function minimall_get_image_id( $image_url ) {
    $post_id = attachment_url_to_postid( $image_url );
    
    if ( ! $post_id ){
        $dir = wp_upload_dir();
        $path = $image_url;
        if ( 0 === strpos( $path, $dir['baseurl'] . '/' ) ) {
            $path = substr( $path, strlen( $dir['baseurl'] . '/' ) );
        }

        if ( preg_match( '/^(.*)(\-\d*x\d*)(\.\w{1,})/i', $path, $matches ) ){
            $url = $dir['baseurl'] . '/' . $matches[1] . $matches[3];
            $post_id = attachment_url_to_postid( $image_url );
        }
    }

    return (int) $post_id;
}

/**
 * Show a given widget based on it's id and it's sidebar index
 *
 * Example: minimall_show_widget( 'sidebar-1', 'calendar-2' ) 
 *
 * @param string $index. Index of the sidebar where the widget is placed in.
 * @param string $id. Id of the widget.
 * @return boolean. TRUE if the widget was found and called, else FALSE.
 */
function minimall_show_widget( $index, $id )
{
    global $wp_registered_widgets, $wp_registered_sidebars;
    $did_one = FALSE;

    // Check if $id is a registered widget
    if( ! isset( $wp_registered_widgets[$id] ) 
        || ! isset( $wp_registered_widgets[$id]['params'][0] ) ) 
    {
        return FALSE;
    }

    // Check if $index is a registered sidebar
    $sidebars_widgets = wp_get_sidebars_widgets();
    if ( empty( $wp_registered_sidebars[ $index ] ) 
        || empty( $sidebars_widgets[ $index ] ) 
        || ! is_array( $sidebars_widgets[ $index ] ) )
    {
        return FALSE;
    }

    // Construct $params
    $sidebar = $wp_registered_sidebars[$index];
    $params = array_merge(
                    array( array_merge( $sidebar, array('widget_id' => $id, 'widget_name' => $wp_registered_widgets[$id]['name']) ) ),
                    (array) $wp_registered_widgets[$id]['params']
              );

    // Substitute HTML id and class attributes into before_widget
    $classname_ = '';
    foreach ( (array) $wp_registered_widgets[$id]['classname'] as $cn )
    {
        if ( is_string($cn) )
            $classname_ .= '_' . $cn;
        elseif ( is_object($cn) )
            $classname_ .= '_' . get_class($cn);
    }
    $classname_ = ltrim($classname_, '_');
    $params[0]['before_widget'] = sprintf($params[0]['before_widget'], $id, $classname_);         
    $params = apply_filters( 'dynamic_sidebar_params', $params );

    // Run the callback
    $callback = $wp_registered_widgets[$id]['callback'];            
    if ( is_callable( $callback ) )
    {
        
         call_user_func_array( $callback, $params );
         $did_one = TRUE;
    }

    return $did_one;
}

/**
 * Conditional tag to check whether current page is wp-login.php or wp-register.php.
 */
if( ! function_exists( 'wp_is_login' ) ) {
	function wp_is_login() {
		return in_array( $GLOBALS[ 'pagenow' ], array( 'wp-login.php' , 'wp-register.php' ) );
	}
}

/* 
* Add gutenberg class
*/
function minimall_conditionnal_gutenberg_class( $is_class = "", $is_not_class = "" ){

    if( (!is_page() && !is_single()) ){ return false; }

    if( minimall_is_gutenberg_active() && function_exists('the_gutenberg_project') && gutenberg_post_has_blocks( get_the_ID() ) ){
        return $is_class;
    }else{
        return $is_not_class;
    }
}

/* 
* Is Gutenberg post
*/
function minimall_is_gutenberg_post(){

    if( minimall_is_gutenberg_active() && function_exists('the_gutenberg_project') && gutenberg_post_has_blocks( get_the_ID() ) ){
        return true;
    }

    return false;
    
}