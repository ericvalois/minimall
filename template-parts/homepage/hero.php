<?php
    $image = get_theme_mod('home_hero_img');
    if( $image ){
        $image = minimall_get_image_id( $image );
    }

?>
<?php if( $image ): ?>
    <?php
        // Get image placeholder
        $path = wp_get_attachment_image_src( $image, 'minimall-hero-placeholder' );
        if( !empty( $path ) ){
            $type = pathinfo($path[0], PATHINFO_EXTENSION);
            $data = minimall_get_response($path[0]);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        }

        $minimall_image_src_sm = wp_get_attachment_image_src( $image, 'minimall-hero-sm' );
        $minimall_image_src_md = wp_get_attachment_image_src( $image, 'minimall-hero-md' );
        $minimall_image_src_lg = wp_get_attachment_image_src( $image, 'minimall-hero-lg' );
    ?>
    <?php if( isset( $base64 ) ): ?>
        <style>
            .default-bg{ background-image: url(<?php echo $base64; ?>);}
        </style>
    <?php endif; ?>
<?php endif; ?>
<div id="home-hero" class="clc-wrapper bg-black relative z1 lg-py4 px2">
    <?php if ( $image ) : ?>
        <div class=" z2 absolute top-0 right-0 bottom-0 left-0 default-bg bg-cover bg-center grayscale muted-2"></div>
        <div class="main_image z3 absolute top-0 right-0 bottom-0 left-0 bg-cover bg-center grayscale lazyload"   
            data-sizes="auto"
            data-bgset="<?php echo esc_url( $minimall_image_src_lg[0] ); ?> [(min-width: 64em)] | 
            <?php echo esc_url( $minimall_image_src_md[0] ); ?> [(min-width: 40em)] | 
            <?php echo esc_url( $minimall_image_src_sm[0] ); ?>">
        </div>
    <?php endif; ?>
    <div class="py4 relative z4">

        <div class="max-width-5 ml-auto mr-auto white home_hero_content">
            <h1 class="hero_title title white mt0 mb2 line-height-2"><?php echo wp_kses_post( nl2br( get_theme_mod('home_hero_title') ) ); ?></h1>
            <div class="hero_desc content"><?php echo wp_kses_post( get_theme_mod('home_hero_desc') ); ?></div>
        </div>
    </div>
</div>