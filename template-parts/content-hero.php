<section class="hero bg-black relative z1">
    <?php
        $minimal_image_id = minimal_select_hero_image();

        if( $minimal_image_id ):
            $minimal_image_src_sm = wp_get_attachment_image_src( $minimal_image_id, 'minimal-hero-sm' );
            $minimal_image_src_md = wp_get_attachment_image_src( $minimal_image_id, 'minimal-hero-md' );
            $minimal_image_src_lg = wp_get_attachment_image_src( $minimal_image_id, 'minimal-hero-lg' );
            ?>
        
        <div class="grayscale z1 bg-default absolute top-0 right-0 bottom-0 left-0 bg-cover bg-center"></div>
        <div class="grayscale z2 absolute top-0 right-0 bottom-0 left-0 bg-cover bg-center lazyload"   
            data-sizes="auto"
            data-bgset="<?php echo esc_url( $minimal_image_src_lg[0] ); ?> [(min-width: 64em)] | 
            <?php echo esc_url( $minimal_image_src_md[0] ); ?> [(min-width: 40em)] | 
            <?php echo esc_url( $minimal_image_src_sm[0] ); ?>">
        </div>

    <?php endif; ?>
</section>