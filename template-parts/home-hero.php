<?php
    $image = minimall_get_image_id($theme_options['home_hero_img']);
    $title = $theme_options['home_hero_title'];
    $description = $theme_options['home_hero_desc'];
    if( !empty($theme_options['home_hero_main_link']) ){ $main_link = minimall_get_link_data($theme_options['home_hero_main_link']); }else{ $main_link = ''; }
    $link_icon = $theme_options['home_hero_main_link_icon'];
?>
<?php if( !empty( $image ) ): ?>
    <?php
        // Get image placeholder
        $path = wp_get_attachment_image_src( $image, 'minimall-hero-placeholder' );
        $type = pathinfo($path[0], PATHINFO_EXTENSION);
        $data = minimall_get_response($path[0]);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        // Get image sizes
        $minimall_image_src_sm = wp_get_attachment_image_src( $image, 'minimall-hero-sm' );
        $minimall_image_src_md = wp_get_attachment_image_src( $image, 'minimall-hero-md' );
        $minimall_image_src_lg = wp_get_attachment_image_src( $image, 'minimall-hero-lg' );
    ?>
    <style>
        .default-bg{ background-image: url(<?php echo $base64; ?>);}
    </style>
<?php endif; ?>
<div id="home-hero" class="clc-wrapper bg-black relative z1 lg-py4">
    <?php if ( $image ) : ?>
        <div class=" z2 absolute top-0 right-0 bottom-0 left-0 default-bg bg-cover bg-center grayscale muted-2"></div>
        <div class=" z3 absolute top-0 right-0 bottom-0 left-0 bg-cover bg-center grayscale lazyload"   
            data-sizes="auto"
            data-bgset="<?php echo esc_url( $minimall_image_src_lg[0] ); ?> [(min-width: 64em)] | 
            <?php echo esc_url( $minimall_image_src_md[0] ); ?> [(min-width: 40em)] | 
            <?php echo esc_url( $minimall_image_src_sm[0] ); ?>">
        </div>
    <?php endif; ?>
    <div class="py4 relative z4">

        <div class="max-width-5 ml-auto mr-auto white px2 lg-px0">
            <?php if( !empty( $title ) ): ?>
                <h1 class="hero_title title white mt0 mb2 line-height-2 caps"><?php echo nl2br($title); ?></h1>
            <?php endif; ?>

            <?php if( !empty( $description ) ): ?>
                <div class="hero_desc content lighter xl-text mb2"><?php echo nl2br($description); ?></div>
            <?php endif; ?>
            
            <?php if ( !empty( $main_link ) ) : ?>
                <div class="links py1">
                    <?php if( !empty( $main_link ) && isset( $main_link['url'] ) && isset( $main_link['title'] ) ): ?>
                        <a <?php echo minimall_external_link($main_link['target'], $main_link['rel']); ?> class="hero_link main_link line-height-2 lg-text btn btn-white bolder" href="<?php echo esc_url($main_link['url']); ?>">
                            <span class="mr1"><?php echo esc_html($main_link['title']); ?></span>
                            <?php if( !empty( $link_icon ) ): ?>
                                <?php echo minimall_get_fa( $link_icon ); ?>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>