<?php
    $image = get_theme_mod('home_hero_img');
    if( $image ){
        $image = minimall_get_image_id( $image );
        
        $minimall_image_src_sm = wp_get_attachment_image_src( $image, 'medium' );
        $minimall_image_src_md = wp_get_attachment_image_src( $image, 'medium_large' );
        $minimall_image_src_lg = wp_get_attachment_image_src( $image, 'large' );
    }
?>
<div id="home-hero" class="clc-wrapper bg-black relative z1 md-py2 lg-py4 px2">
    <?php if ( $image ) : ?>
        <div class="main_image z3 absolute top-0 right-0 bottom-0 left-0 bg-cover bg-center grayscale lazyload"   
            data-sizes="auto"
            data-bgset="<?php echo esc_url( $minimall_image_src_lg[0] ); ?> [(min-width: 64em)] | 
            <?php echo esc_url( $minimall_image_src_md[0] ); ?> [(min-width: 40em)] | 
            <?php echo esc_url( $minimall_image_src_sm[0] ); ?>">
        </div>
    <?php endif; ?>

    <div class="max-width-5 py4 ml-auto mr-auto white home_hero_content relative z4">
        <h1 class="hero_title title white mt2 mb2 line-height-2"><?php echo wp_kses_post( nl2br( get_theme_mod('home_hero_title') ) ); ?></h1>
        <div class="hero_desc content mb2"><?php echo wp_kses_post( get_theme_mod('home_hero_desc') ); ?></div>
    </div>
</div>