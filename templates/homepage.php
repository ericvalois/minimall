<?php
/*
* Template name: Homepage
*/
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <?php
                $theme_options = minimall_theme_options();
                
                include( get_template_directory() . '/template-parts/home-hero.php' );

                if( !empty( $theme_options['homepage_layout'] ) ){
                    foreach ($theme_options['homepage_layout'] as $key => $section) {
                        include( get_template_directory() . '/template-parts/home-'. $section .'.php' );
                    }
                }
            ?>
		</main><!-- #main -->
        
	</div><!-- #primary -->

<?php
get_footer();
