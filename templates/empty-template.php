<?php
/*
* Template name: Empty
* Template Post Type: post, page, download
*/
get_header(); ?>

    <div id="empty-template" class="entry-content max-width-3 ml-auto mr-auto first-mt0">
        <?php
            while ( have_posts() ) : the_post();

                the_content();

            endwhile; // End of the loop.
        ?>

        <?php 
            if( comments_open() ): 
                comments_template();
            endif;
        ?>

        
        
    </div><!-- #empty-template -->

<?php
get_footer();