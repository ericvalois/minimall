<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package minimal
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header col-12 center negative-header max-width-5 ml-auto mr-auto bg-white px2 py2 lg-px4">

		<?php the_title( '<h1 class="entry-title mb0 lg-mb2">', '</h1>' ); ?>
        
	</header><!-- .entry-header -->

	<div class="entry-content max-width-3 ml-auto mr-auto px2 lg-px0 pt2">
        <?php the_content(); ?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer max-width-3 ml-auto mr-auto">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'minimal' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
