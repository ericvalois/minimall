<header class="entry-header col-12 mb2 <?php if( is_single() ){ echo 'center negative-header max-width-5 ml-auto mr-auto bg-white px2 py2 lg-px4'; }else{ echo 'left-separator'; } ?>">
    <?php if( is_singular("post") && !get_theme_mod('hide_post_avatar') ): ?>
        <div class="entry-avatar">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 100, '', '', array('class' => 'ml-auto mr-auto') ); ?> 
        </div>
    <?php endif; ?>

    <?php
        if ( is_single() ) :
            the_title( '<h1 class="entry-title mb2 center">', '</h1>' );
        else :
            the_title( '<h2 class="entry-title mb1 mt0"><a class="black border-none" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        endif;
    ?>
    
    <?php if ( 'post' === get_post_type() && !get_theme_mod('hide_post_metas') ) : ?>
        <div class="entry-meta sm-text">
            <?php minimall_posted_on(); ?>
        </div><!-- .entry-meta -->
    <?php endif; ?>
</header><!-- .entry-header -->