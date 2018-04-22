<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package minimal
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content max-width-3 ml-auto mr-auto first-mt0">
        <?php the_content(); ?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
