<?php
/**
 * The template for displaying single download
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package minimal
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

            <?php
                while ( have_posts() ) : the_post();
                
                    do_action('minimall_before_content');
                
                    get_template_part( 'template-parts/content', 'download' );
    
                    do_action('minimall_after_content');

                endwhile; // End of the loop.
            ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
