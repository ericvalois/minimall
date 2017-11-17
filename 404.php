<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package minimal
 */

get_header(); ?>

    <?php get_template_part( 'template-parts/content', 'hero' ); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php

				get_template_part( 'template-parts/content', 'not-found' );

			?>

		</main><!-- #main -->
        
	</div><!-- #primary -->

<?php
get_footer();