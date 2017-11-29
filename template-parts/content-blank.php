<?php
/**
 * Template part for displaying creativity content in templates/template-home.php
 *
 * @package minimal
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php the_content(); ?>

    <?php if ( get_edit_post_link() ) : ?>
        <footer class="entry-footer">
            <?php
                edit_post_link(
                    sprintf(
                        /* translators: %s: Name of current post */
                        esc_html__( 'Edit %s', 'minimall' ),
                        the_title( '<span class="screen-reader-text">"', '"</span>', false )
                    ),
                    '<span class="edit-link">',
                    '</span>'
                );
            ?>
        </footer><!-- .entry-footer -->
    <?php endif; ?>

</article><!-- #post-## -->