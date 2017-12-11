<?php
/*
* Create Jetpack Panels
*/
Minimall_Kirki::add_section( 'jetpack_performance', array(
    'title'      => esc_attr__( 'Jetpack', 'minimall' ),
    'priority'   => 60,
    'panel'		 => 'performance',
    'capability' => 'edit_theme_options',
) );

/*
* Create EDD Archive Controls
*/
Minimall_Kirki::add_field( 'minimall', array(
    'type'        => 'checkbox',
    'settings'    => 'jetpack_optimization',
    'label'       => __( 'Activate Jetpack Optimization', 'minimall' ),
    'description' => __( 'This option removes devicepx script and jetpack stylesheet. Activate only if you know what you are doing.', 'minimall' ),
    'section'     => 'jetpack_performance',
    'default'     => '0',
    'priority'    => 10,
) );

/*
* Disable Jetpack scripts and styles
*/
add_action('init', 'minimall_optimiazation_jetpack');
function minimall_optimiazation_jetpack(){
    if( get_theme_mod('jetpack_optimization',false) ):
        wp_dequeue_script( 'devicepx' );
    endif;
}

/*
* Remove comment from jetpack galleries
*/
add_filter( 'comments_open', 'minimall_remove_jetpack_gallery_comment', 10 , 2 );
function minimall_remove_jetpack_gallery_comment( $open, $post_id ) {
    if( is_singular('download') ){
        $post = get_post( $post_id );
        if( $post->post_type == 'attachment' ) {
            return false;
        }
    }
    
    return $open;
}

/*
<section class="main_features mt3 mb3 py1 line-height-3"><div class="flex items-center"><div class="px2"> <svg class="nc-icon nc-icon-grid-48 nc-icon-outline stroke-2"><use href="#nc-podium-trophy"></use></svg></div><div> Highest<br> Google PageSpeed Score <a class="sm-text" target="_blank" rel="noopener noreferrer" href="https://developers.google.com/speed/pagespeed/insights/?url=https%3A%2F%2Flightbold.ttfb.io%2F&amp;tab=desktop">Check the score</a></div></div><hr class="muted mt2 mb2"><div class="flex items-center"><div class="px2"> <svg class="nc-icon nc-icon-grid-48 nc-icon-outline stroke-2 "><use href="#nc-dashboard-30"></use></svg></div><div> Lightning Fast Load Time <a class="sm-text" target="_blank" rel="noopener noreferrer" href="https://tools.pingdom.com/#!/dmJ34t/https://lightbold.ttfb.io/">Check the speed</a></div></div><hr class="muted mt2 mb2"><div class="flex items-center"><div class="px2"> <svg class="nc-icon nc-icon-grid-48 nc-icon-outline stroke-2 "><use href="#nc-flash-24"></use></svg></div><div> Speed Index Under 1000 <a class="sm-text" target="_blank" rel="noopener noreferrer" href="http://www.webpagetest.org/result/170621_Q8_0697a82e55f5ae1b6324a070cf876537/">Check the speed</a></div></div></section>
*/