<?php
/**
 * Downloads archive page.
 * This is used by default unless EDD_DISABLE_ARCHIVE is set to true.
 */
get_header(); ?>

    <div id="site-content" <?php minimall_site_content_class(); ?>>
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <?php
                while ( have_posts() ) : the_post();

                    get_template_part( 'template-parts/content-download-grid' );

                endwhile; // End of the loop.
                ?>

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
			
