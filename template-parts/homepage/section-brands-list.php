<?php $item_list = get_theme_mod('home_'.$section.'_list'); ?>
<?php if( $item_list ): ?>
<div class="clearfix lg-flex flex-wrap">
    <?php
        $layout = get_theme_mod('home_'.$section.'_layout', '3');
        $col_width = 12 / $layout; 
    ?>
    <?php foreach ( $item_list as $key => $service): ?>
        <?php $image = wp_get_attachment_image_src( $service['image'], 'full' ); ?>
        <div class="flex-auto lg-col-<?php echo esc_attr( $col_width ); ?> lg-px2">
            <img data-src="<?php echo $image[0]; ?>" src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" class="lazyload">
        </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>