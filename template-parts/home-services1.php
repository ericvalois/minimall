<section id="home-service1" class="py4 px2 lg-px0">
    <div class="max-width-5 ml-auto mr-auto lg-py3">
        <?php if( !empty( $theme_options['home_service1_header'] ) ): ?>
            <header class="entry-header">
                <?php if( !empty( $theme_options['home_service1_title'] ) ): ?>
                    <h2 class="title mt0 mb0"><?php echo wp_kses_post( $theme_options['home_service1_title'] ); ?></h2>
                <?php endif; ?>

                <?php if( !empty( $theme_options['home_service1_desc'] ) ): ?>
                    <div class="desc"><?php echo wp_kses_post( $theme_options['home_service1_desc'] ); ?></div>
                <?php endif; ?>
            </header>
        <?php endif; ?>

        <?php if( !empty( $theme_options['home_service1_list'] ) ): ?>
            <div class="clearfix lg-mxn2">
                <?php
                    if( !empty( $theme_options['home_service1_layout'] ) ){
                        $layout = $theme_options['home_service1_layout'];
                    }else{
                        $layout = 3;
                    }
                    $col_width = 12 / $layout; 
                ?>
                <?php foreach ($theme_options['home_service1_list'] as $key => $service): ?>
                    <div class="lg-col lg-col-<?php echo esc_attr( $col_width ); ?> lg-px2">
                        <h3 class=" bold mb0 <?php if( 0 === $key ){ echo 'mt2'; }else{ echo 'mt3'; } ?> lg-mt2"><?php echo esc_html( $service['title'] ); ?></h3>
                        <p class="mt2 "><?php echo esc_html( $service['desc'] ); ?></p>
                        <a class="btn btn-black btn-big sm-text" href="<?php echo esc_url( $service['link_url'] ); ?>"><?php echo esc_html( $service['link_text'] ); ?></a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>