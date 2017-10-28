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

			<section class="error-404 not-found max-width-3 ml-auto mr-auto">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'minimall' ); ?></h1>
				</header>

				<div class="page-content">

                    <section id="404-full-sidebar" class="lg-text" role="complementary">
                        <?php dynamic_sidebar( '404-full-sidebar' ); ?>
                    </section>

					<div class="lg-flex mxn2">
                        <aside id="404-left-sidebar" class="lg-col-6 px2" role="complementary">
                            <?php dynamic_sidebar( '404-left-sidebar' ); ?>
                        </aside>

                        <aside id="404-right-sidebar" class="lg-col-6 px2" role="complementary">
                            <?php dynamic_sidebar( '404-right-sidebar' ); ?>
                        </aside>
                    </div>


				</div>
			</section>

		</main>
	</div>

<?php
get_footer();
