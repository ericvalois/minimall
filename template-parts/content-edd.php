<?php
/**
 * Template part for displaying EDD content
 *
 * @package minimal
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header <?php if( get_theme_mod('edd_checkout_boxed','0') && ( function_exists('edd_is_checkout') && edd_is_checkout() ) ) { echo 'center'; }else{ echo 'left-separator'; } ?>">

        <?php the_title( '<h1 class="entry-title mb0 lg-mb2 mt0">', '</h1>' ); ?>
        
    </header><!-- .entry-header -->

    <div class="py2 mxn2">
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
    </div><!-- .entry-content -->

</article><!-- #post-## -->
