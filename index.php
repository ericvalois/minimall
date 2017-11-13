<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package minimal
 */

get_header(); ?>

    <div id="site-content" <?php minimall_site_content_class(); ?>>
        
        <div id="primary" class="content-area lg-flex justify-center">
            <main id="main" class="site-main lg-col-8 <?php if( is_active_sidebar( 'blog-sidebar' ) ){ echo 'lg-pr4'; } ?>" role="main">
                <header class="mb4">
                    <?php 
                        if( is_home() ){
                            $title = esc_html( get_the_title( get_option('page_for_posts', true) ) ); 
                            $description = esc_html( get_bloginfo( "description" ) ); 
                        }elseif( is_search() ){
                            $title = esc_html__( 'Search Results for: ', 'minimall' ) . '<span>' . get_search_query() . '</span>';
                        
                        }else{
                            $title = get_the_archive_title();
                            $description = get_the_archive_description();
                        }
                    ?>
                    <h1 class="page-title h4 caps mb1 mt0"><?php echo $title; ?></h1>
                    <?php if( isset( $description ) ): ?>
                        <h6 class="mt0 mb0 regular lower"><?php echo $description; ?></h6>
                    <?php endif; ?>
                </header>

                <?php
                if ( have_posts() ) :

                    while ( have_posts() ) : the_post();

                        get_template_part( 'template-parts/content', get_post_format() );

                    endwhile;

                    minimall_pagination();

                else :

                    get_template_part( 'template-parts/content', 'none' );

                endif; ?>

            </main><!-- #main -->

            <?php get_sidebar(); ?>

        </div><!-- #primary -->
    </div>
<?php
get_footer();
