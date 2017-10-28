<?php $theme_options = minimall_theme_options(); ?>
<?php if( !empty( $theme_options['footer_hero'] ) ): ?>
    <section class="py4 mt4 px2 footer-hero">
        <div class="block cta center">
            <?php if( !empty( $theme_options['footer_hero_label'] ) ): ?>
                <span class="caps xxsm-text"><?php echo esc_html( $theme_options['footer_hero_label'] ); ?></span>
            <?php endif; ?>

            <?php if( !empty( $theme_options['footer_hero_title'] ) ): ?>
                <h4 class="hero-text h0 weight1 mt2 mb3"><?php echo nl2br( $theme_options['footer_hero_title'] ); ?></h4>
            <?php endif; ?>

            <?php if( !empty( $theme_options['footer_cta_url'] ) ): ?>
                <div class="flex justify-center ">
                    <a <?php echo minimall_external_link( $theme_options['footer_cta_options']['blank'] ); ?> href="<?php echo esc_url( $theme_options['footer_cta_url'] ); ?>" class="btn btn-primary btn-big flex items-center xl-text">
                        <span class="mr1 footer_cta_label"><?php echo esc_html( $theme_options['footer_cta_label'] ); ?></span>
                        <?php echo minimall_get_fa( $theme_options['footer_cta_icon'] ); ?>
                    </a>
                </div>
            <?php endif; ?>

        </div>
    </section>
<?php endif; ?>