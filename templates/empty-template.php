<?php
/*
* Template name: Empty
* Template Post Type: post, page, download
*/
get_header(); ?>

    <div id="empty-template" class="<?php echo minimall_get_empty_template_class(); ?>">

        <?php

            do_action('minimall_before_empty_content');

            while ( have_posts() ) : the_post();

                the_content();

            endwhile; // End of the loop.

            do_action('minimall_after_empty_content');

        ?>

    </div><!-- #empty-template -->

<?php
get_footer();