<?php $images = minimall_get_homepage_hero(); ?>
<div id="home-hero" class="clc-wrapper bg-black relative z1 md-py2 lg-py4 px2">
    <?php if ( $images ) : ?>
        <div id="hero-img" class="z3 absolute top-0 right-0 bottom-0 left-0 bg-cover bg-center grayscale"   
            data-sizes="auto"
            data-bgset="<?php echo esc_url( $images['lg'] ); ?> [(min-width: 64em)] | 
            <?php echo esc_url( $images['md'] ); ?> [(min-width: 40em)] | 
            <?php echo esc_url( $images['sm'] ); ?>">
        </div>
    <?php endif; ?>

    <div class="max-width-5 py4 ml-auto mr-auto white home_hero_content relative z4 break-word">
        <h1 class="hero_title title white mt2 mb2 line-height-2"><?php echo wp_kses_post( nl2br( get_theme_mod('home_hero_title') ) ); ?></h1>
        <div class="hero_desc content mb2"><?php echo apply_filters('the_content', get_theme_mod('home_hero_desc')); ?></div>
    </div>
</div>