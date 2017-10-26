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

				get_template_part( 'template-parts/content', 'page' );

                echo '<div class="max-width-3 ml-auto mr-auto px2 lg-px0">';
            
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :

                        echo '<h3 class="comments-title separator mt4 mb4 h1 center bold">';
                
                            $comments_number = get_comments_number();
                            if ( 1 === $comments_number ) {
                                /* translators: %s: post title */
                                esc_html_e("Comment","minimal");
                            } else {
                                esc_html_e("Comments","minimal");
                            }
                            
                        echo '</h3>';

                        comments_template();
                    endif;

                echo '</div>';

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
        
	</div><!-- #primary -->

<?php
get_footer();
