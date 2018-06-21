<?php
/*
* Template name: Full width
* Template Post Type: post, page, download
*/
get_header(); ?>

    <div id="primary" class="<?php echo minimall_get_full_width_template_class(); ?>">
        <main id="main" class="site-main" role="main">
            <?php
            while ( have_posts() ) : the_post();

                get_template_part( 'template-parts/content', 'full-width' );

            endwhile; // End of the loop.
            ?>

        </main><!-- #main -->
        
    </div><!-- #primary -->

<?php
get_footer();
