<?php
    $image = get_theme_mod('home_'.$section.'_img');
    if( $image ){
        $image = minimall_get_image_id( $image );
    }
    $section_id = $key + 1;
    $section_header = get_theme_mod('home_'.$section.'_header');
    $section_title = get_theme_mod('home_'.$section.'_title');
    $section_desc = get_theme_mod('home_'.$section.'_desc');

    if( $image ):
        $minimall_image_src_sm = wp_get_attachment_image_src( $image, 'minimall-hero-sm' );
        $minimall_image_src_md = wp_get_attachment_image_src( $image, 'minimall-hero-md' );
        $minimall_image_src_lg = wp_get_attachment_image_src( $image, 'minimall-hero-lg' );
    endif; 
?>
<section id="home-section-<?php echo esc_attr( $section ); ?>" class="py4 px2 relative z1 home-section <?php if( !empty( $image ) ){ echo 'bg-black white'; } ?>">

    <?php if ( $image ) : ?>
        <div class=" z2 absolute top-0 right-0 bottom-0 left-0 bg-cover bg-center grayscale muted-2"></div>
        <div class="bg-section z3 absolute top-0 right-0 bottom-0 left-0 bg-cover bg-center grayscale lazyload"   
            data-sizes="auto"
            data-bgset="<?php echo esc_url( $minimall_image_src_lg[0] ); ?> [(min-width: 64em)] | 
            <?php echo esc_url( $minimall_image_src_md[0] ); ?> [(min-width: 40em)] | 
            <?php echo esc_url( $minimall_image_src_sm[0] ); ?>">
        </div>
    <?php endif; ?>

    <div class="max-width-5 ml-auto mr-auto lg-py3 relative z4">
        <?php if( $section_header ): ?>
            <header class="entry-header mb2">
                <?php if( $section_title ): ?>
                    <h2 class="title mt0 mb0 h3 <?php if( !empty( $image ) ){ echo 'white'; } ?>"><?php echo wp_kses_post( $section_title  ); ?></h2>
                <?php endif; ?>

                <?php if( $section_desc ): ?>
                    <div class="desc"><?php echo wp_kses_post( $section_desc ); ?></div>
                <?php endif; ?>
            </header>
        <?php endif; ?>

        <?php 
            if( $section == 'service' ){
                include( locate_template('/template-parts/homepage/section-content-list.php') );
            }elseif( $section == 'brands' ){
                include( locate_template('/template-parts/homepage/section-brands-list.php') );
            }elseif( $section == 'blog' ){
                include( locate_template('/template-parts/homepage/section-blog.php') );
            }elseif( $section == 'features' ){
                include( locate_template('/template-parts/homepage/section-features.php') );
            }
        ?>
    </div>
</section>