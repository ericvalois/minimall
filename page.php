<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package minimal
 */

get_header(); ?>

    <?php get_template_part( 'template-parts/content', 'hero' ); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
			while ( have_posts() ) : the_post();

                do_action('minimall_before_page_content');

				get_template_part( 'template-parts/content', 'page' );

                do_action('minimall_after_page_content');

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
        
	</div><!-- #primary -->

<?php
get_footer();
