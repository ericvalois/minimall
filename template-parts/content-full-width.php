<?php
/**
 * Template part for displaying full width content
 *
 * @package minimal
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header <?php if( get_theme_mod('edd_checkout_boxed','0') && ( function_exists('edd_is_checkout') && edd_is_checkout() ) ) { echo 'center'; }else{ echo 'left-separator'; } ?>">
        <?php the_title( '<h1 class="entry-title mb0 lg-mb2 mt0">', '</h1>' ); ?>
    </header><!-- .entry-header -->

    <div class="py2">
        <?php the_content(); ?>

        <?php get_template_part( 'template-parts/edit-post-link' ); ?>
    </div><!-- .entry-content -->

</article><!-- #post-## -->
