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


    <li <?php comment_class("py1"); ?> id="comment-<?php comment_ID() ?>">
            
        <div class="comment-intro clearfix">
            <div class="left mr1 mb1 "><?php echo get_avatar( $comment->comment_author_email, 57, "", "", array("class" => "rounded") ); ?></div> 
            <span class="small-p bold upper"><?php printf(__('%s','minimall'), get_comment_author_link()) ?> </span>
            <strong><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></strong>
            <?php 
                if( $comment->comment_author_email == $post_author->user_email ){
                    echo '<span class="comment_author">' . __("Author","minimal") . '</span>';
                }
            ?>
            <br>
            <span class="comment_date upper small-p"><?php printf(__('%1$s','minimall'), get_comment_date(), get_comment_time()) ?></span>
        </div>
        
        <?php if ($comment->comment_approved == '0') : ?>
            <em><php _e('Your comment is awaiting moderation.','minimall'); ?></em><br />
        <?php endif; ?>

        <div class="sm-text">
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
function minimall_custom_menu( $theme_location ) {
    if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
        $menu = get_term( $locations[$theme_location], 'nav_menu' );
        $menu_items = wp_get_nav_menu_items($menu->term_id);

        $menu_list = '<ul class="list-reset m0 lg-right weight500">' ."\n";
 
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
                    $menu_list .= '<a href="'.$link.'" class="text-decoration-none sm-text black ' . $active . implode(" ",$class) . '">'.$title.'</a>' ."\n";
                }
    
                if ( $parent_id == $menu_item->menu_item_parent ) {

                        
                    if ( !$submenu ) {
                        $submenu = true;
                        $menu_list .= '<button class="sub-menu-toggle px0 py0 z4"></button>';

                        $menu_list .= '<ul class="sub-menu  list-reset mt0 mb0 ml2 lg-ml0">' ."\n";
                    }
    
                    $menu_list .= '<li class="mt2 mb2 lg-mt0 lg-mb0 item block lg-inline-block">' ."\n";
                    $menu_list .= '<a href="'.$link.'" class="block black text-decoration-none sm-text border-none">'.$title.'</a>' ."\n";
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
function minimall_select_hero_image(){


    $header_img = get_theme_mod('default_hero_img','');

    if( $header_img ){
        return minimall_get_image_id( $header_img );
    }else{
        return false;
    }
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

// Get link from custom link controls
function minimall_get_link_helper( $string = '' ){
    if( empty( $string ) )
        return false;

    $output = array();
    foreach(explode("|", urldecode($string)) as $pair){
        $stuff  = explode(":", $pair, 2); 
        if( count($stuff) > 1 ){
            $output[$stuff[0]] = $stuff[1];
        }
    }

    if ( !array_key_exists("url", $output) ){
        $output['url'] = '';
    }

    if ( !array_key_exists("title", $output) ){
        $output['title'] = '';
    }

    if ( !array_key_exists("target", $output) ){
        $output['target'] = '';
    }

    if ( !array_key_exists("rel", $output) ){
        $output['rel'] = '';
    }

    return $output;
    
}