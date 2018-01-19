<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package minimal
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
	
    
    <?php if( is_single() ): ?>
	    <div class="entry-content <?php echo esc_attr( minimall_conditionnal_gutenberg_class('gutenberg-content', 'max-width-3 ml-auto mr-auto') ); ?>">
            <?php the_content(); ?>

            <?php
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'minimall' ),
                    'after'  => '</div>',
                ) );
            ?>
        </div>
    <?php else: ?>
        
        <?php get_template_part( 'template-parts/content-header','single' ); ?>
        
        <div class="entry-content">
            <?php
                if ( has_excerpt() ) {
                    the_excerpt();
                }else {
                    the_content();
                }
            ?>
        </div>
    <?php endif; ?>

</article><!-- #post-## -->
