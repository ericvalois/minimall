<?php $content_list = get_theme_mod('home_'.$section.'_list'); ?>
<?php if( $content_list ): ?>
<div class="sm-flex flex-wrap sm-mxn2 pt2">
    <?php
        $layout_tablet = get_theme_mod('home_'.$section.'_layout_tablet', '2');
        $layout_desktop = get_theme_mod('home_'.$section.'_layout_desktop', '3');
        $tablet_width = 12 / $layout_tablet; 
        $desktop_width = 12 / $layout_desktop; 
        $item_number = count( $content_list );
    ?>
    <?php foreach ($content_list as $key => $item): ?>
        <div class="sm-col-<?php echo esc_attr( $tablet_width ); ?> lg-col-<?php echo esc_attr( $desktop_width ); ?> <?php if( $item_number != $key + 1 ){ echo 'mb3';} ?> sm-px2">
            
            <?php if( $item['title'] ): ?>
                <h3 class="regular mb0 mt0 h4"><?php echo wp_kses_post( nl2br( $item['title'] ) ); ?></h3>
                <?php endif; ?>

            <?php if( $item['desc'] ): ?>
                <p class="mt2 "><?php echo wp_kses_post( nl2br($item['desc']) ); ?></p>
            <?php endif; ?>
                
            <?php if( $item['link_url'] ): ?>
                <a class="btn <?php if( !empty( $image ) ){ echo 'btn-white'; }else{ echo 'btn-black'; } ?> " href="<?php echo esc_url( $item['link_url'] ); ?>"><?php echo esc_html( $item['link_text'] ); ?></a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>