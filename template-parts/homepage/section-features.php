<?php $content_feature = get_theme_mod('home_'.$section.'_features'); ?>
<?php if( $content_feature ): ?>
    <div class="lg-flex flex-wrap lg-mxn2">
        <?php
            $layout = get_theme_mod('home_'.$section.'_layout', '3');
            $col_width = 12 / $layout; 
            $item_number = count( $content_feature );
        ?>
        <?php foreach ($content_feature as $key => $item): ?>
            <div class="lg-col-<?php echo esc_attr( $col_width ); ?> <?php if( $item_number != $key + 1 ){ echo 'mb3 lg-mb0';} ?> lg-px2">
                
                <?php if( $item['icon'] ): ?>
                    <div class="h1 mt2 line-height-1 <?php if( !empty( $image ) ){ echo 'white'; } ?>"><?php echo wp_kses_post( $item['icon'] ); ?></div>
                <?php endif; ?>

                <?php if( $item['title'] ): ?>
                    <h5 class="bold mb1 mt2"><?php echo wp_kses_post( $item['title'] ); ?></h5>
                <?php endif; ?>

                <?php if( $item['desc'] ): ?>
                    <p class="sm-text mt1 mb0"><?php echo wp_kses_post( nl2br($item['desc']) ); ?></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>