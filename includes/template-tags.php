<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package minimal
 */

if ( ! function_exists( 'minimall_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function minimall_posted_on() {
	$minimall_time_string = '<span class="posted-on"><time class="entry-date published updated" datetime="%1$s">%2$s</time></span> ';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$minimall_time_string = '<span class="posted-on"><time class="updated" datetime="%3$s">%4$s</time></span> ';
	}

	$minimall_time_string = sprintf( $minimall_time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$minimall_posted_on = $minimall_time_string;

	$minimall_byline = '<span class="author vcard"><a class="url fn n border-none" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

    echo $minimall_byline;
    echo " - ";
	echo $minimall_posted_on;

    if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
        echo " - ";
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'minimall' ), esc_html__( '1 Comment', 'minimall' ), esc_html__( '% Comments', 'minimall' ) );
		echo '</span>';
	}
    
	

	/*$minimall_categories = get_the_category();
	$cat_separator = ', ';
	$minimall_output = '';
	if ( ! empty( $minimall_categories ) ) {

		echo '<span class="cat">' . __("Categories", "minimall") . ': ';

	    foreach( $minimall_categories as $category ) {
	        $minimall_output .= '<a class="white-color upper" href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>' . $cat_separator;
	    }
	    echo trim( $minimall_output, $cat_separator );

	    echo '</span>';

	}*/


	/*$minimall_posttags = get_the_tags();
	if ($minimall_posttags) {

		echo '<span class="tag">' . __("Tags", "minimall") . ': ';
		$cpt = 1;
		foreach($minimall_posttags as $tag) {
			if( $cpt != 1){
				echo ', ';
			}
			echo '<a class="white-color upper" href="' . get_tag_link($tag->term_id) . '">';
			echo $tag->name;
			echo '</a> ';
			$cpt++;
		}

		echo '</span>';
	}*/

}
endif;

if ( ! function_exists( 'minimall_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function minimall_entry_footer() {
    echo '<section class="mt3 mb3 sm-text black-link max-width-3 ml-auto mr-auto">';
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() && !get_theme_mod('hide_post_cat') ) {
		
		$categories = get_the_category();
        $separator = ', ';
        $output = '';
        if ( ! empty( $categories ) ) {
            foreach( $categories as $category ) {
                $output .= '<a class="black" href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'minimall' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
            }
        }

		if ( ! empty( $categories ) && minimall_categorized_blog() ) {
            echo '<div class="col-12 flex items-center">';
            echo '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" xml:space="preserve" width="16" height="16"><g class="" fill="#3a4145"><path fill="#3a4145" d="M15,3H8.4L5.7,0.3C5.5,0.1,5.3,0,5,0H1C0.4,0,0,0.4,0,1v14c0,0.6,0.4,1,1,1h14c0.6,0,1-0.4,1-1V4 C16,3.4,15.6,3,15,3z"></path></g></svg>';
			echo '<span class="ml1">';
            echo trim( $output, $separator );
            echo '</span>';
            echo '</div>';
		}

		$tags_list = get_the_tags();
        $output = '';
        if ( ! empty( $tags_list ) ) {
            foreach( $tags_list as $tag ) {
                $output .= '<a class="black" href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'minimall' ), $tag->name ) ) . '">' . esc_html( ucfirst($tag->name) ) . '</a>' . $separator;
            }
        }

		if ( $tags_list ) {
			echo '<div class="col-12 flex items-center">';
            echo '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" xml:space="preserve" width="16" height="16"><g class="" fill="#3a4145"><path fill="#3a4145" d="M15.7,8.3l-8-8C7.5,0.1,7.3,0,7,0H1C0.4,0,0,0.4,0,1v6c0,0.3,0.1,0.5,0.3,0.7l8,8C8.5,15.9,8.7,16,9,16 s0.5-0.1,0.7-0.3l6-6C16.1,9.3,16.1,8.7,15.7,8.3z M4,5C3.4,5,3,4.6,3,4s0.4-1,1-1c0.6,0,1,0.4,1,1S4.6,5,4,5z"></path></g></svg>';
			echo '<span class="ml1">' . trim( $output, $separator ) . '</span>';
            echo '</div>';
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) && !get_theme_mod('hide_post_cat') ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'minimall' ), esc_html__( '1 Comment', 'minimall' ), esc_html__( '% Comments', 'minimall' ) );
		echo '</span>';
	}

	echo '</section>';
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function minimall_categorized_blog() {
	if ( false === ( $minimall_all_the_cool_cats = get_transient( 'minimall_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$minimall_all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$minimall_all_the_cool_cats = count( $minimall_all_the_cool_cats );

		set_transient( 'minimall_categories', $minimall_all_the_cool_cats );
	}

	if ( $minimall_all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so minimall_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so minimall_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in minimall_categorized_blog.
 */
function minimall_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'minimall_categories' );
}
add_action( 'edit_category', 'minimall_category_transient_flusher' );
add_action( 'save_post',     'minimall_category_transient_flusher' );



/**
 * Allow HTML in author bio section 
 */
remove_filter('pre_user_description', 'wp_filter_kses');

/**
 * Add our function to the post content filter 
 */
function minimall_author_info_box( ) {

    global $post;

    // Detect if it is a single post with a post author
    if ( is_single() && isset( $post->post_author ) ) {

        // Get author's display name 
        $display_name = get_the_author_meta( 'display_name', $post->post_author );

        // If display name is not available then use nickname as display name
        if ( empty( $display_name ) )
        $display_name = get_the_author_meta( 'nickname', $post->post_author );

        // Get author's biographical information or description
        $user_description = get_the_author_meta( 'user_description', $post->post_author );

        // Get author's website URL 
        $user_website = get_the_author_meta('url', $post->post_author);

        // Get link to the author archive page
        $user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));
        
        if ( ! empty( $display_name ) )

        $author_details = '<p class="author_name">About ' . $display_name . '</p>';

        if ( ! empty( $user_description ) )
        // Author avatar and bio

        $author_details .= '<p class="author_details">' . get_avatar( get_the_author_meta('user_email') , 90 ) . nl2br( $user_description ). '</p>';

        $author_details .= '<p class="author_links"><a href="'. $user_posts .'">View all posts by ' . $display_name . '</a>';  

        // Check if author has a website in their profile
        if ( ! empty( $user_website ) ) {

        // Display author website link
        $author_details .= ' | <a href="' . $user_website .'" target="_blank" rel="nofollow">Website</a></p>';

        } else { 
        // if there is no author website then just close the paragraph
        $author_details .= '</p>';
        }

        // Pass all this info to post content  
        $content = '<footer class="author_bio_section" >' . $author_details . '</footer>';
    }

    echo $content;
}
