<?php
/**
 * Download tag custom taxonomy.
 */
get_header(); ?>

    <div id="site-content" class="<?php echo minimall_get_full_width_template_class(); ?>">
        <div id="primary" class="content-area">
            <main id="main" class="site-main " role="main">
                <header class="entry-header px2 <?php if( get_theme_mod('edd_checkout_boxed','0') && ( function_exists('edd_is_checkout') && edd_is_checkout() ) ) { echo 'center'; }else{ echo 'left-separator'; } ?>">
                    <h1 class="entry-title mb0 lg-mb2 mt0"><?php single_term_title( __('Tag: ','minimall'), true ) ?></h1>
                </header><!-- .entry-header -->

                <div class="mt2 edd_downloads_list">
                <?php
                    while ( have_posts() ) : the_post();

                        edd_get_template_part( 'shortcode', 'download' );

                    endwhile; // End of the loop.
                ?>
                </div>
            

                <?php
                    /**
                    * Download pagination
                    */
                    if( function_exists("minimall_edd_download_nav") ){
                        minimall_edd_download_nav();
                    }
                ?>

            </main><!-- #main -->
            
        </div><!-- #primary -->
    </div><!-- #site-content -->

<?php
get_footer();