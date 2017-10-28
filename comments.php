<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area hide-print max-width-3 ml-auto mr-auto">

	<?php if ( have_comments() ) : ?>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list list-reset">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 56,
					'callback'	  => 'minimall_custom_comments',
				) );
			?>
		</ol><!-- .comment-list -->

		<?php the_comments_navigation(); ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'minimall' ); ?></p>
	<?php endif; ?>

	<?php

		comment_form( array(
			'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title separator h1 center separator mt4 mb4">',
			'title_reply_after'  => '</h3>',
			'class_submit'		 => 'btn btn-black btn-big col-12 mb2 btn_comment',
			'class_form' => ' ',
			'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( '<a href="%1$s" class="tags">Logged in as %2$s</a> <a href="%3$s" class="tags" title="Log out of this account">Log out?</a>','minimall' ), esc_url( admin_url( 'profile.php' ) ), $user_identity, esc_url( wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) ) . '</p>',
			'comment_field' => '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Comment', 'minimall' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" ></textarea></p>',
			'fields' => apply_filters( 'comment_form_default_fields', array(

			'author' =>
				'<p class="comment-form-author">' .
				'<label for="author">' . esc_html__( 'Name', 'minimall' ) . '</label> ' .
				( $req ? '<span class="required red">*</span>' : '' ) .
				'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
				'" size="30" aria-required="true" required /></p>',

			'email' =>
				'<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'minimall' ) . '</label> ' .
				( $req ? '<span class="required red">*</span>' : '' ) .
				'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
				'" size="30" aria-required="true" required /></p>',

			'url' =>
				'<p class="comment-form-url"><label for="url">' .
				esc_html__( 'Website', 'minimall' ) . '</label>' .
				'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
				'" size="30" /></p></div>'
			))
		) );

	?>

</div><!-- .comments-area -->