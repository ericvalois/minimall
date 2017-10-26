<?php
/*
* Template name: Homepage
*/
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <?php
                $theme_options = minimal_theme_options();
                $home_sections = $theme_options['homepage_section'];
                if( !empty( $home_sections ) ){
                    foreach ($home_sections as $key => $section) {
                        if( 'hero' === $section['sections_type'] ){
                            include( get_template_directory() . '/template-parts/home-hero.php' );
                        }else{
                            include( get_template_directory() . '/template-parts/home-content.php' );
                        }
                    }
                }
            ?>
		</main><!-- #main -->
        
	</div><!-- #primary -->

<?php
get_footer();
