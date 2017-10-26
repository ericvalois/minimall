<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ): ?>
    <?php the_custom_logo(); ?>
<?php else: ?>
    <a id="text-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="border-none xs-text black line-height-3">
        <span class="blogname"><?php echo esc_html( get_bloginfo("name") ); ?></span><br>
        <span class="blogdescription"><?php echo esc_html( get_bloginfo("description") ); ?></span>
    </a>
<?php endif; ?>