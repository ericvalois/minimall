<?php
/*
* Template name: Full width
* Template Post Type: post, page
*/
get_header(); ?>

    <div id="site-content" <?php minimall_site_content_class(); ?>>
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <?php
                while ( have_posts() ) : the_post();

                    get_template_part( 'template-parts/content', 'full-width' );

                endwhile; // End of the loop.
                ?>

            </main><!-- #main -->
            
        </div><!-- #primary -->
    </div><!-- #site-content -->

<?php
get_footer();
