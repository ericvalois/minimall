<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) : ?>
    <section class="footer-widgets clearfix hide-print break-word max-width-5 ml-auto mr-auto line-height-4 <?php if( get_theme_mod('edd_checkout_hide_footer_widgets',false) == '1' && ( function_exists('edd_is_checkout') && edd_is_checkout() ) ){ echo 'display-none'; } ?>">
        <?php 
            $layout = get_theme_mod('footer_widget_layout', '4');
            $padding = get_theme_mod('footer_widget_spacing','px2');
            $break = get_theme_mod('footer_widget_breakpoints','lg');
        ?>
        
        <div class="clearfix mt3 mb3 lg-mt4 px2 lg-px2 ">
            <?php $index = 1; ?>
            <?php $col_width = 12 / $layout; ?>
            <?php while ( $layout >= 1 ) : ?>
            
                <div class="<?php echo esc_attr( $break ); ?>-col <?php echo esc_attr( $break ); ?>-col-<?php echo esc_attr( $col_width ); ?> <?php echo esc_attr( $break ); ?>-<?php echo esc_attr( $padding ); ?>">
                    <?php dynamic_sidebar( 'footer-' . $index ); ?>
                </div>

                <?php $layout--; $index++; ?>
            <?php endwhile; ?>
        </section>

    </div>

<?php endif; ?>