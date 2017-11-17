<?php if( get_theme_mod('footer_hero', true) && !is_page_template('templates/private-dashboard.php') ): ?>
    <section class="py4 mt4 px2 footer-hero <?php if( get_theme_mod('edd_checkout_hide_footer_hero',false) == '1' && ( function_exists('edd_is_checkout') && edd_is_checkout() ) ){ echo 'display-none'; } ?>">
        <div class="block center">
            <?php if( get_theme_mod('footer_hero_label') ): ?>
                <span class="caps xs-text"><?php echo esc_html( get_theme_mod('footer_hero_label') ); ?></span>
            <?php endif; ?>

            <?php if( get_theme_mod('footer_hero_title') ): ?>
                <h4 class="hero-text h0 lighter mt2 mb3"><?php echo wp_kses_post( nl2br( get_theme_mod('footer_hero_title') ) ); ?></h4>
            <?php endif; ?>

            <?php if( get_theme_mod('footer_cta') ): ?>
                <div class="flex justify-center ">
                    <?php $link = minimall_get_link_helper( get_theme_mod('footer_cta') ); ?>
                    <a <?php echo minimall_external_link( $link['target'], $link['rel'] ); ?> href="<?php echo esc_url( $link['url'] ); ?>" class="btn btn-primary btn-big lg-text">
                        <span class="mr1 footer_cta_label"><?php echo do_shortcode( wp_kses_post( $link['title'] ) ); ?></span>
                    </a>
                </div>
            <?php endif; ?>

        </div>
    </section>
<?php endif; ?>