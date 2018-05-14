<?php
/**
 * Template part for displaying full width content
 *
 * @package minimal
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header mb2 <?php if( get_theme_mod('edd_checkout_boxed','0') && ( function_exists('edd_is_checkout') && edd_is_checkout() ) ) { echo 'center'; }else{ echo 'left-separator'; } ?>">
        <?php the_title( '<h1 class="entry-title mb0 mt0 lg-mb2 ">', '</h1>' ); ?>
    </header><!-- .entry-header -->

    <?php the_content(); ?>

    <?php get_template_part( 'template-parts/edit-post-link' ); ?>

</article><!-- #post-## -->
