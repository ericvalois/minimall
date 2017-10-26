<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package minimal
 */

if ( ! function_exists( 'minimal_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function minimal_posted_on() {
	$minimal_time_string = '<span class="posted-on"><time class="entry-date published updated" datetime="%1$s">%2$s</time></span> ';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$minimal_time_string = '<span class="posted-on"><time class="updated" datetime="%3$s">%4$s</time></span> ';
	}

	$minimal_time_string = sprintf( $minimal_time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$minimal_posted_on = $minimal_time_string;

	$minimal_byline = '<span class="author vcard"><a class="url fn n border-none" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

    echo $minimal_byline;
    echo " - ";
	echo $minimal_posted_on;

    if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
        echo " - ";
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'minimal' ), esc_html__( '1 Comment', 'minimal' ), esc_html__( '% Comments', 'minimal' ) );
		echo '</span>';
	}
    
	

	/*$minimal_categories = get_the_category();
	$cat_separator = ', ';
	$minimal_output = '';
	if ( ! empty( $minimal_categories ) ) {

		echo '<span class="cat">' . __("Categories", "minimal") . ': ';

	    foreach( $minimal_categories as $category ) {
	        $minimal_output .= '<a class="white-color upper" href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>' . $cat_separator;
	    }
	    echo trim( $minimal_output, $cat_separator );

	    echo '</span>';

	}*/


	/*$minimal_posttags = get_the_tags();
	if ($minimal_posttags) {

		echo '<span class="tag">' . __("Tags", "minimal") . ': ';
		$cpt = 1;
		foreach($minimal_posttags as $tag) {
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

if ( ! function_exists( 'minimal_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function minimal_entry_footer() {
    echo '<section class="mt3 mb3 sm-text black-link">';
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		
		$categories = get_the_category();
        $separator = ', ';
        $output = '';
        if ( ! empty( $categories ) ) {
            foreach( $categories as $category ) {
                $output .= '<a class="black" href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'minimal' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
            }
        }

		if ( ! empty( $categories ) && minimal_categorized_blog() ) {
            echo '<div class="col-12 flex items-center">';
            echo '<svg class="nc-align-to-text mr1"><use href="#nc-folder-15"/></svg>';
			echo '<span class="ml1">';
            echo trim( $output, $separator );
            echo '</span>';
            echo '</div>';
		}

		$tags_list = get_the_tags();
        $output = '';
        if ( ! empty( $tags_list ) ) {
            foreach( $tags_list as $tag ) {
                $output .= '<a class="black" href="' . esc_url( get_category_link( $tag->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'minimal' ), $tag->name ) ) . '">' . esc_html( ucfirst($tag->name) ) . '</a>' . $separator;
            }
        }

		if ( $tags_list ) {
			echo '<div class="col-12 flex items-center">';
            echo '<svg class="nc-align-to-text mr1"><use href="#nc-tag"/></svg>';
			echo '<span class="ml1">' . trim( $output, $separator ) . '</span>';
            echo '</div>';
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'minimal' ), esc_html__( '1 Comment', 'minimal' ), esc_html__( '% Comments', 'minimal' ) );
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
function minimal_categorized_blog() {
	if ( false === ( $minimal_all_the_cool_cats = get_transient( 'minimal_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$minimal_all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$minimal_all_the_cool_cats = count( $minimal_all_the_cool_cats );

		set_transient( 'minimal_categories', $minimal_all_the_cool_cats );
	}

	if ( $minimal_all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so minimal_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so minimal_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in minimal_categorized_blog.
 */
function minimal_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'minimal_categories' );
}
add_action( 'edit_category', 'minimal_category_transient_flusher' );
add_action( 'save_post',     'minimal_category_transient_flusher' );



/**
 * Allow HTML in author bio section 
 */
remove_filter('pre_user_description', 'wp_filter_kses');

/**
 * Add our function to the post content filter 
 */
function minimal_author_info_box( ) {

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
