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
            
            <?php do_action('minimall_edd_first_column'); ?>

            <?php 
                $firstColumn = get_theme_mod('edd_single_layout','6');
                $secondColumn = 12 - $firstColumn;
            ?>
            <div class="lg-col-<?php echo esc_attr( $firstColumn ); ?> lg-pr2">
                <?php 
                    $image_id = get_post_thumbnail_id();
                    $thumb_data = wp_get_attachment_image_src( $image_id, 'large' ); 
                    $full_data = wp_get_attachment_image_src( $image_id, 'full' ); 
                ?>
                <a class="flex items-center justify-center col-12 inline-block" href="<?php echo $full_data[0]; ?>" data-size="<?php echo $full_data[1]; ?>x<?php echo $full_data[2]; ?>">
                    <img class="lazyload zoom-img" data-src="<?php echo $thumb_data[0]; ?>" data-id="<?php echo $image_id; ?>" alt="">
                </a>

                <?php if( function_exists( 'edd_di_display_images') ) : ?>
                    <div id="image-gallery" class="flex flex-wrap mxn1 mt1 gallery">
                        <?php edd_di_display_images(); ?>
                    </div>
                <?php endif; ?> 

            </div>

            <div class="lg-col-<?php echo esc_attr( $secondColumn ); ?> lg-px2">
                <?php do_action('minimall_edd_second_column'); ?>
            </div>
        </div>

        <?php if ( is_active_sidebar( 'download-tabs-sidebar' ) ): ?> 
            <section id="download-tabs-sidebar" class="widget-area col-12 block">
                <?php
                    

                    

                    /*$i = 1;
                    $widgets = wp_get_sidebars_widgets(); 
                    $widgets = $widgets['download-tabs-sidebar'];
                    foreach ($widgets as $widget) {
                        
                          echo "<h3>".$widget."</h3>";
                          $cn = $wp_registered_widgets[$widgets[$i%3]]['callback'][0];
                          $cn = get_class($cn);
                          the_widget($cn,$widgets[$i%3]);
                        
                       $i++;
                    }*/
                ?>
                <?php //dynamic_sidebar( 'download-tabs-sidebar' ); ?>
            </section><!-- #download-tabs-sidebar -->
        <?php endif; ?>


        <div class="">
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

	
</article><!-- #post-## -->
