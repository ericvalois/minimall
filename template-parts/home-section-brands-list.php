<?php if( !empty( $theme_options['home_'.$section.'_list'] ) ): ?>
<div class="clearfix lg-flex flex-wrap">
    <?php
        if( !empty( $theme_options['home_'.$section.'_layout'] ) ){
            $layout = $theme_options['home_'.$section.'_layout'];
        }else{
            $layout = 3;
        }
        $col_width = 12 / $layout; 
    ?>
    <?php foreach ($theme_options['home_'.$section.'_list'] as $key => $service): ?>
        <?php $image = wp_get_attachment_image_src( $service['image'], 'full' ); ?>
        <div class="flex-auto lg-col-<?php echo esc_attr( $col_width ); ?> lg-px2">
            <img src="<?php echo $image[0]; ?>" alt="">
        </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>