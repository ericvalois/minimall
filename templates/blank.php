<?php
/*
* Template name: Blank
*/
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'blank' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
        
	</div><!-- #primary -->

<?php
get_footer();
