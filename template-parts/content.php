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
	<header class="entry-header col-12 <?php if( is_single() ){ echo 'center negative-header max-width-5 ml-auto mr-auto bg-white px2 py2 lg-px4'; } ?>">
        <?php if( is_singular("post") ): ?>
            <div class="entry-avatar">
                <?php echo get_avatar( get_the_author_meta( 'ID' ), 100, '', '', array('class' => 'ml-auto mr-auto') ); ?> 
            </div>
        <?php endif; ?>

		<?php
            if ( is_single() ) :
                the_title( '<h1 class="entry-title mb2 center">', '</h1>' );
            else :
                the_title( '<h2 class="entry-title lg-h0 mb1 mt0 weight700"><a class="black border-none" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            endif;
        ?>
        
        <?php if ( 'post' === get_post_type() ) : ?>
            <div class="entry-meta sm-text">
                <?php minimall_posted_on(); ?>
            </div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content <?php if( is_single() ){ echo 'content-full pt2 px2 lg-px0'; } ?>">
		<?php
            if( is_single() ){
                the_content();
            }else{
                if ( has_excerpt() ) {
                    the_excerpt();
                }else {
                    the_content();
                }
            }
			

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'minimall' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
