<?php $content_list = get_theme_mod('home_'.$section.'_list'); ?>
<?php if( $content_list ): ?>
<div class="lg-flex flex-wrap lg-mxn2">
    <?php
        $layout = get_theme_mod('home_'.$section.'_layout', '3');
        $col_width = 12 / $layout; 
        $item_number = count( $content_list );
    ?>
    <?php foreach ($content_list as $key => $item): ?>
        <div class="lg-col-<?php echo esc_attr( $col_width ); ?> <?php if( $item_number != $key + 1 ){ echo 'mb3';} ?> lg-px2">
            
            <?php if( $item['title'] ): ?>
                <h3 class="bold mb0 h4 <?php if( !empty( $image ) ){ echo 'white'; } ?> <?php if( 0 === $key ){ echo 'mt2'; }else{ echo 'mt3'; } ?> lg-mt2"><?php echo wp_kses_post( nl2br( $item['title'] ) ); ?></h3>
                <?php endif; ?>

            <?php if( $item['desc'] ): ?>
                <p class="mt2 "><?php echo wp_kses_post( nl2br($item['desc']) ); ?></p>
            <?php endif; ?>
                
            <?php if( $item['link_url'] ): ?>
                <a class="btn <?php if( !empty( $image ) ){ echo 'btn-white'; }else{ echo 'btn-black'; } ?> btn-big sm-text" href="<?php echo esc_url( $item['link_url'] ); ?>"><?php echo esc_html( $item['link_text'] ); ?></a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>