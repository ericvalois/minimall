<?php
/**
 * A single download inside of the [downloads] shortcode.
 *
 * @since 2.8.0
 *
 * @package EDD
 * @category Template
 * @author Easy Digital Downloads
 * @version 1.0.0
 */

global $edd_download_shortcode_item_atts, $edd_download_shortcode_item_i;
?>

<?php 
    $schema = edd_add_schema_microdata() ? 'itemscope itemtype="http://schema.org/Product" ' : ''; 
    $desktop_products = round( 12 / get_theme_mod('edd_desktop_products','4') );
    $tablet_products = round( 12 / get_theme_mod('edd_tablet_products','2') );

?>

<div <?php echo $schema; ?>class="col-12 sm-col-<?php echo esc_attr($tablet_products); ?> lg-col-<?php echo esc_attr($desktop_products); ?> mb3 <?php echo esc_attr( apply_filters( 'edd_download_class', 'px2', get_the_ID(), $edd_download_shortcode_item_atts, $edd_download_shortcode_item_i ) ); ?>" id="edd_download_<?php the_ID(); ?>">

	<div class="p0 m0 <?php echo esc_attr( apply_filters( 'edd_download_inner_class', 'edd_download_inner', get_the_ID(), $edd_download_shortcode_item_atts, $edd_download_shortcode_item_i ) ); ?>">

		<?php
			do_action( 'edd_download_before' );

			if ( 'false' !== $edd_download_shortcode_item_atts['thumbnails'] ) :
				edd_get_template_part( 'shortcode', 'content-image' );
				do_action( 'edd_download_after_thumbnail' );
			endif;

            if( !get_theme_mod('edd_hide_shop_title', false) ):
                edd_get_template_part( 'shortcode', 'content-title' );
            endif;

            do_action( 'edd_download_after_title' );
            
            if( !get_theme_mod('edd_hide_shop_price', false) ):
                echo '<div class="mt1 mb1">';
                echo '<a class="edd_price" href="' . get_the_permalink() . '">' . edd_price(get_the_ID() , false) . '</a>';
                echo '</div>';
                do_action( 'edd_download_after_price' );
            endif;
              

            if( !get_theme_mod('edd_hide_shop_desc', false) ):
                edd_get_template_part( 'shortcode', 'content-excerpt' );
                do_action( 'edd_download_after_content' );
            endif;

            if( !get_theme_mod('edd_hide_shop_btn', false) ):
                edd_get_template_part( 'shortcode', 'content-cart-button' );
            endif;

			do_action( 'edd_download_after' );
		?>

	</div>

</div>
