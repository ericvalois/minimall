<?php
if ( ! is_user_logged_in() && get_theme_mod('private_dashboard_private',false) && $_SERVER['HTTP_HOST'] != 'minimall.local' ) {
    $redirect_url = get_theme_mod('private_dashboard_login_url', home_url('login'));
    wp_redirect( $redirect_url, 301 ); exit;
}
/*
* Template name: Private Dashboard
*/
get_header(); ?>

    <div id="site-content" class="<?php echo minimall_get_private_template_class(); ?>">
        <header class="">
            <?php the_title( '<h1 class="entry-title mb3 mt0">', '</h1>' ); ?>
        </header><!-- .entry-header -->

        <div id="primary" class="content-area bg-white px2 lg-px0 py2 clearfix" >
            <main id="main" class="site-main col lg-col-9 lg-px3" role="main">
                <?php
                while ( have_posts() ) : the_post();

                    get_template_part( 'template-parts/content', 'private-dashboard' );

                endwhile; // End of the loop.
                ?>

            </main><!-- #main -->
            
            <?php if ( is_active_sidebar( 'private-dashboard' ) ): ?>
                <aside id="secondary" class="widget-area private-dashboard-widget-area col lg-col-3" role="complementary">
                    <?php dynamic_sidebar( 'private-dashboard' ); ?>
                </aside><!-- #secondary --> 
            <?php endif; ?>

        </div><!-- #primary -->
    </div><!-- #site-content -->

<?php
get_footer();
