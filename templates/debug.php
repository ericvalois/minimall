<?php
/*
* Template name: Debug
*/
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <?php
                $theme_options = minimall_theme_options();

                echo '<pre>';
                print_r( $theme_options );
                echo '</pre>';
            ?>
		</main><!-- #main -->
        
	</div><!-- #primary -->

<?php
get_footer();
