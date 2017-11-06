<div class="lg-flex flex-wrap lg-mxn2">
    <?php
        $layout = get_theme_mod('home_blog_layout', '3');
        $col_width = 12 / $layout; 
        $posts_number = get_theme_mod('home_blog_quantity', '3');
    ?>
    
    <?php 
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $posts_number,
        );
        
        $latest_post = new WP_Query( $args );
        $count = $latest_post->post_count;
        $cpt = 1;
    ?>
    <?php if ( $latest_post->have_posts() ) : ?>

        <?php while ( $latest_post->have_posts() ) : $latest_post->the_post(); ?>
            <div class="lg-col-<?php echo esc_attr( $col_width ); ?> lg-px2 <?php if( $cpt != $count ){ echo 'mb3'; } ?>">
                <?php if( get_theme_mod('home_blog_thumb') ): ?>
                    <?php $image_url = get_the_post_thumbnail_url(get_the_ID(), "large"); ?>
                    <a href="<?php the_permalink(); ?>" class="block py4 relative z1">
                        <div class="z3 absolute top-0 right-0 bottom-0 left-0 bg-cover bg-center grayscale lazyload bg-black" data-sizes="auto" data-bgset="<?php echo esc_url( $image_url ); ?>"></div>
                    </a>
                <?php endif; ?>
                <h3 class="bold caps mb0 lg-mt2"><a class="black" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <div class="entry-meta sm-text">
                    <?php minimall_posted_on(); ?>
                </div>
            </div>
            <?php $cpt++; ?>
        <?php endwhile; ?>
        

        <?php wp_reset_postdata(); ?>

    <?php else : ?>
        <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
    <?php endif; ?>
        
</div>