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