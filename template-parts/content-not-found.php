<?php
/**
 * Template part for displaying 404 content in 404.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package minimall
 */

?>
<article id="page-404">
	<header class="entry-header col-12 center negative-header max-width-5 ml-auto mr-auto bg-white px2 py2 lg-px4">

        <h1 class="entry-title mb0 lg-mb2"><?php _e('Oops! That page can’t be found.','minimall'); ?></h1>
        
	</header><!-- .entry-header -->

	<div class="entry-content max-width-3 ml-auto mr-auto px2 lg-px0 pt2">
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
	</div><!-- .entry-content -->

</article><!-- #post-## -->