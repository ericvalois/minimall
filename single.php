<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package minimal
 */

get_header(); ?>

    <?php get_template_part( 'template-parts/content', 'hero' ); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

            <?php
                while ( have_posts() ) : the_post();
                    
                    get_template_part( 'template-parts/content-header','single' );
                
                    do_action('minimall_before_post_content');
                
                    get_template_part( 'template-parts/content' );
    
                    do_action('minimall_after_post_content');

                endwhile; // End of the loop.
            ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
