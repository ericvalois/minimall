<section class="hero bg-black relative z1">
    <?php
        $hero = minimall_select_hero_image();
        
        if( $hero ):
            if( is_numeric( $hero ) ){
                $image_array_sm = wp_get_attachment_image_src( $hero, 'medium' );
                $image_url_sm = $image_array_sm[0];

                $image_array_md = wp_get_attachment_image_src( $hero, 'medium_large' );
                $image_url_md = $image_array_md[0];

                $image_array_lg = wp_get_attachment_image_src( $hero, 'large' );
                $image_url_lg = $image_array_lg[0];
            }else{
                $image_url_sm = $hero;
                $image_url_md = $hero;
                $image_url_lg = $hero;
            }
        else:
            $default_img = get_template_directory_uri() . '/assets/images/default-hero.jpg';
            $image_url_sm = $default_img;
            $image_url_md = $default_img;
            $image_url_lg = $default_img;
        endif;
            
        ?>
        
        <div id="hero-img" class="grayscale z2 absolute top-0 right-0 bottom-0 left-0 bg-cover bg-center"   
            data-sizes="auto"
            data-bgset="<?php echo esc_url( $image_url_lg ); ?> [(min-width: 64em)] | 
            <?php echo esc_url( $image_url_md ); ?> [(min-width: 40em)] | 
            <?php echo esc_url( $image_url_sm ); ?>">
        </div>

</section>