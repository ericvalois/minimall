<?php
/**
 * Template part for displaying download content in single-download.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package minimal
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <div class="lg-flex col-12 flex-wrap mb4 lg-mb0">
            
            <?php 
                $firstColumn = get_theme_mod('edd_single_layout','6');
                $secondColumn = 12 - $firstColumn;
            ?>
            <div class="lg-col-<?php echo esc_attr( $firstColumn ); ?> lg-pr2">

                <?php do_action('minimall_edd_first_column'); ?>

            </div>

            <div class="lg-col-<?php echo esc_attr( $secondColumn ); ?> lg-px2">
                <?php do_action('minimall_edd_second_column'); ?>
            </div>
        </div>

        <?php if ( is_active_sidebar( 'download-tabs-sidebar' ) ): ?>
            <section class="download-tabs-section">
                <ul class="minimall-tabs" role="tablist">
                    <?php do_action('minimall_edd_tabs'); ?>
                </ul>

                <?php do_action('minimall_edd_tabs_content'); ?>
            </section>   
        <?php endif; ?>

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
