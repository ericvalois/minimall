<?php
/*
* Template name: Empty
*/
get_header(); ?>

    <div id="empty-template">
        <?php
            while ( have_posts() ) : the_post();

                the_content();

            endwhile; // End of the loop.
        ?>
    </div><!-- #empty-template -->

<?php
get_footer();
