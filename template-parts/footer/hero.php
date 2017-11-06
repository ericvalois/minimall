<?php if( get_theme_mod('footer_hero') ): ?>
    <section class="py4 mt4 px2 footer-hero">
        <div class="block cta center">
            <?php if( get_theme_mod('footer_hero_label') ): ?>
                <span class="caps xxsm-text"><?php echo esc_html( get_theme_mod('footer_hero_label') ); ?></span>
            <?php endif; ?>

            <?php if( get_theme_mod('footer_hero_title') ): ?>
                <h4 class="hero-text h0 weight1 mt2 mb3"><?php echo wp_kses_post( nl2br( get_theme_mod('footer_hero_title') ) ); ?></h4>
            <?php endif; ?>

            <?php if( get_theme_mod('footer_cta') ): ?>
                <div class="flex justify-center ">
                    <?php $link = minimall_get_link_helper( get_theme_mod('footer_cta') ); ?>
                    <a <?php echo minimall_external_link( $link['target'], $link['rel'] ); ?> href="<?php echo esc_url( $link['url'] ); ?>" class="btn btn-primary btn-big flex items-center xl-text">
                        <span class="mr1 footer_cta_label"><?php echo esc_html( $link['title'] ); ?></span>
                        <?php echo minimall_get_fa( get_theme_mod('footer_cta_icon') ); ?>
                    </a>
                </div>
            <?php endif; ?>

        </div>
    </section>
<?php endif; ?>