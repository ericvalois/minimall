<?php $content_feature = get_theme_mod('home_'.$section.'_features_list'); ?>
<?php if( $content_feature ): ?>
    <div class="sm-flex flex-wrap sm-mxn2 pt2">
        <?php
            $layout_tablet = get_theme_mod('home_'.$section.'_layout_tablet', '2');
            $layout_desktop = get_theme_mod('home_'.$section.'_layout_desktop', '3');
            $tablet_width = 12 / $layout_tablet; 
            $desktop_width = 12 / $layout_desktop; 
            $item_number = count( $content_feature );
        ?>

        <?php foreach ($content_feature as $key => $item): ?>
            <div class="sm-col-<?php echo esc_attr( $tablet_width ); ?> lg-col-<?php echo esc_attr( $desktop_width ); ?> <?php if( $item_number != $key + 1 ){ echo 'mb3';} ?>  sm-px2">
                
                <?php if( $item['icon'] ): ?>
                    <div class="h1 mt0 line-height-1 <?php echo esc_attr( $section_color ); ?>"><?php echo wp_kses_post( $item['icon'] ); ?></div>
                <?php endif; ?>

                <?php if( $item['title'] ): ?>
                    <h5 class="regular mb1 mt2"><?php echo wp_kses_post( $item['title'] ); ?></h5>
                <?php endif; ?>

                <?php if( $item['desc'] ): ?>
                    <p class="sm-text mt1 mb0"><?php echo wp_kses_post( nl2br($item['desc']) ); ?></p>
                <?php endif; ?>

                <?php if( !empty( $item['link_label'] ) && !empty( $item['link_url'] ) ): ?>
                    <a class="btn mt2" href="<?php echo esc_url( $item['link_url'] ); ?>"><?php echo esc_html( $item['link_label'] ); ?></a>
                <?php endif; ?>

            </div>
        <?php endforeach; ?>

    </div>

<?php endif; ?>