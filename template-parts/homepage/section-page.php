<?php $content_page = get_theme_mod('home_'.$section.'_page',false); ?>
<?php if( $content_page ): ?>
    <?php
        $post = get_post( $content_page );
        $post_content = $post->post_content;
        if( !empty( $post_content ) ){
            echo apply_filters( 'the_content', $post_content );
        }
    ?>
<?php endif; ?>