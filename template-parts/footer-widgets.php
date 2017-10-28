<?php $theme_options = minimall_theme_options(); ?>
<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) : ?>
    <section class="footer-widgets clearfix hide-print break-word max-width-5 ml-auto mr-auto line-height-4">

        <?php 
            if( !empty( $theme_options['footer_widget_layout'] ) ){
                $layout = $theme_options['footer_widget_layout'];
            }else{
                $layout = 4;
            }

            if( !empty( $theme_options['footer_widget_spacing'] ) ){
                $padding = $theme_options['footer_widget_spacing'];
            }else{
                $padding = 'px2';
            }

            if( !empty( $theme_options['footer_widget_breakpoints'] ) ){
                $break = $theme_options['footer_widget_breakpoints'];
            }else{
                $break = 'lg';
            }
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