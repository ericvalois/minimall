<?php
/*
* Template name: Empty
* Template Post Type: post, page
*/
get_header(); ?>

    <div id="empty-template" class="entry-content <?php echo esc_attr( minimall_conditionnal_gutenberg_class('gutenberg-content', '') ); ?>">
        <?php
            while ( have_posts() ) : the_post();

                the_content();

            endwhile; // End of the loop.
        ?>
    </div><!-- #empty-template -->

<?php
get_footer();
