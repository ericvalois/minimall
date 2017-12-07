<section class="hero bg-black relative z1">
    <?php $hero = minimall_get_default_hero(); ?>
    <?php if( !empty( $hero ) ): ?>
        <div id="hero-img" class="grayscale z2 absolute top-0 right-0 bottom-0 left-0 bg-cover bg-center"   
            data-sizes="auto"
            data-bgset="<?php echo esc_url( $hero['lg'] ); ?> [(min-width: 64em)] | 
            <?php echo esc_url( $hero['md'] ); ?> [(min-width: 40em)] | 
            <?php echo esc_url( $hero['sm'] ); ?>">
        </div>
    <?php endif; ?>
</section>