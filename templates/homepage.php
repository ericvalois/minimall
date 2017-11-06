<?php
/*
* Template name: Homepage
*/
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <?php
                get_template_part( 'template-parts/homepage/hero' );

                if( get_theme_mod('homepage_layout') ){
                    foreach (get_theme_mod('homepage_layout') as $key => $section) {
                        include( locate_template('/template-parts/homepage/section.php' ) );
                    }
                }
            ?>
		</main><!-- #main -->
        
	</div><!-- #primary -->

<?php
get_footer();
