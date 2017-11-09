<?php
/**
 * Template part for displaying EDD content
 *
 * @package minimal
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header col-12 ml-auto mr-auto px2 <?php if( get_theme_mod('edd_checkout_boxed','0') && ( function_exists('edd_is_checkout') && edd_is_checkout() ) ) { echo 'max-width-3 center'; }else{ echo 'max-width-5 left-separator'; } ?>">

        <?php the_title( '<h1 class="entry-title mb0 lg-mb2">', '</h1>' ); ?>
        
    </header><!-- .entry-header -->

    <div class="col-12 ml-auto mr-auto  py2 <?php if( get_theme_mod('edd_checkout_boxed','0') && ( function_exists('edd_is_checkout') && edd_is_checkout() ) ) { echo 'max-width-3'; }else{ echo 'max-width-5'; } ?>">
        <?php the_content(); ?>
    </div><!-- .entry-content -->

    <?php if ( get_edit_post_link() ) : ?>
        <footer class="entry-footer max-width-3 ml-auto mr-auto">
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
