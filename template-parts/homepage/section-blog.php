<div class="sm-flex flex-wrap sm-mxn2 pt2">
    <?php
        $layout_tablet = get_theme_mod('home_'.$section.'_layout_tablet', '2');
        $layout_desktop = get_theme_mod('home_'.$section.'_layout_desktop', '3');
        $tablet_width = 12 / $layout_tablet; 
        $desktop_width = 12 / $layout_desktop;
    
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
            <div class="sm-col-<?php echo esc_attr( $tablet_width ); ?> lg-col-<?php echo esc_attr( $desktop_width ); ?> sm-px2 <?php if( $cpt != $count ){ echo 'mb3'; } ?>">
                <?php if( get_theme_mod('home_blog_thumb') ): ?>
                    <a href="<?php the_permalink(); ?>" class="relative z1 bg-white inline-block mb2 hover-opacity">
                        <?php the_post_thumbnail( 'post-thumbnail', ['class' => 'grayscale muted'] ); ?>       
                    </a>
                <?php endif; ?>
                
                <h3 class="regular caps mb0 mt0 h5"><a class="black" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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