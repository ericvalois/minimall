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

	<div class="max-width-5 ml-auto mr-auto  lg-px0 pt4">
        <div class="lg-flex col-12 flex-wrap">
            
            <?php do_action('minimall_edd_first_column'); ?>

            <?php 
                $firstColumn = get_theme_mod('edd_single_layout','6');
                $secondColumn = 12 - $firstColumn;
            ?>
            <div class="lg-col-<?php echo esc_attr( $firstColumn ); ?> px2">
                <a class="flex items-center justify-center col-12 inline-block" href="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>">
                    <img class="lazyload zoom-img" data-src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>" alt="">
                </a>

                <?php if( function_exists( 'edd_di_display_images') ) : ?>
                    <div id="image-gallery" class="flex flex-wrap mxn1 mt1 gallery">
                        <?php edd_di_display_images(); ?>
                    </div>
                <?php endif; ?> 

            </div>

            <div class="lg-col-<?php echo esc_attr( $secondColumn ); ?> px2">
                <?php do_action('minimall_edd_second_column'); ?>
            </div>
        </div>

        <div class="px2">
            <ul class="minimall-tabs" role="tablist">
                <?php do_action('minimall_edd_tabs'); ?>
            </ul>

            <?php do_action('minimall_edd_tabs_content'); ?>
        </div>   

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
