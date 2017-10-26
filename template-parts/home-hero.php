<?php 
/*echo '<pre>';
print_r( $theme_options );
echo '</pre>';*/
$image = minimal_get_image_id($theme_options['hero_image_'.$key]);
$title = $theme_options['hero_title_'.$key];
$description = $theme_options['hero_description_'.$key];
$links = $theme_options['hero_links_'.$key];
?>
<?php if( !empty( $image ) ): ?>
    <?php
        // Get image placeholder
        $path = wp_get_attachment_image_src( $image, 'minimal-hero-placeholder' );
        $type = pathinfo($path[0], PATHINFO_EXTENSION);
        $data = minimal_get_response($path[0]);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        // Get image sizes
        $minimal_image_src_sm = wp_get_attachment_image_src( $image, 'minimal-hero-sm' );
        $minimal_image_src_md = wp_get_attachment_image_src( $image, 'minimal-hero-md' );
        $minimal_image_src_lg = wp_get_attachment_image_src( $image, 'minimal-hero-lg' );
    ?>
    <style>
        .default-bg{ background-image: url(<?php echo $base64; ?>);}
    </style>
<?php endif; ?>
<div id="home-hero" class="clc-wrapper bg-black relative z1 lg-py3">
    <?php if ( $image ) : ?>
        <div class="z-3 absolute top-0 right-0 bottom-0 left-0 muted-2">
            <div class="default-bg grayscale z1 bg-default absolute top-0 right-0 bottom-0 left-0 bg-cover bg-center"></div>
            <div class="grayscale z2 absolute top-0 right-0 bottom-0 left-0 bg-cover bg-center lazyload "   
                data-sizes="auto"
                data-bgset="<?php echo esc_url( $minimal_image_src_lg[0] ); ?> [(min-width: 64em)] | 
                <?php echo esc_url( $minimal_image_src_md[0] ); ?> [(min-width: 40em)] | 
                <?php echo esc_url( $minimal_image_src_sm[0] ); ?>">
            </div>
        </div>
    <?php endif; ?>
    <div class="py4 relative z3">

        <div class="max-width-4 ml-auto mr-auto white px2 lg-px0">
            <h1 class="title white mt0 mb2 line-height-2 light"><?php echo nl2br($title); ?></h1>
            <div class="content lg-text light"><?php echo nl2br($description); ?></div>
            <?php if ( !empty( $links ) ) : ?>
                <div class="links mt2">
                    <?php foreach( $links as $link ) : ?>
                        <a <?php echo minimal_external_link($link['link_target'], $link['link_nofollow']); ?> class="<?php echo esc_attr($link['link_class']); ?> mr2 light" href="<?php echo esc_url($link['link_url']); ?>"><?php echo esc_html($link['link_label']); ?></a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>