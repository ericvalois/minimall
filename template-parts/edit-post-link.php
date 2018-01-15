<?php if ( get_edit_post_link() ) : ?>
    <?php
        if( is_page_template('templates/full-width.php') ){
            $max_width = 'max-width-5';
        }else{
            $max_width = 'max-width-3';
        }
    ?>
    <footer class="entry-footer <?php echo $max_width; ?> ml-auto mr-auto mt2">
        <?php
            edit_post_link(
                sprintf(
                    /* translators: %s: Name of current post */
                    esc_html__( 'Edit %s', 'minimall' ),
                    the_title( '<span class="screen-reader-text">"', '"</span>', false )
                ),
                '<span class="edit-link">',
                '</span>'
            );
        ?>
    </footer><!-- .entry-footer -->
<?php endif; ?>