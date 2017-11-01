<?php $content_list = minimall_get_option($theme_options, 'home_'.$section.'_list'); ?>
<?php if( $content_list ): ?>
<div class="lg-flex flex-wrap lg-mxn2">
    <?php
        $layout = minimall_get_option($theme_options, 'home_'.$section.'_layout', '3');
        $col_width = 12 / $layout; 
        $item_number = count( $content_list );
    ?>
    <?php foreach ($content_list as $key => $item): ?>
        <div class="lg-col-<?php echo esc_attr( $col_width ); ?> <?php if( $item_number != $key + 1 ){ echo 'mb3';} ?> lg-px2">

            <h3 class="bold mb0 <?php if( !empty( $image ) ){ echo 'white'; } ?> <?php if( 0 === $key ){ echo 'mt2'; }else{ echo 'mt3'; } ?> lg-mt2"><?php echo esc_html( $item['title'] ); ?></h3>
            <p class="mt2 "><?php echo esc_html( $item['desc'] ); ?></p>
            <a class="btn <?php if( !empty( $image ) ){ echo 'btn-white'; }else{ echo 'btn-black'; } ?> btn-big sm-text" href="<?php echo esc_url( $item['link_url'] ); ?>"><?php echo esc_html( $item['link_text'] ); ?></a>

        </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>