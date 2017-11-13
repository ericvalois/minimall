<div class="edd_download_buy_button mt2 mb2">
    <?php 
        $price = get_theme_mod('edd_hide_price_btn', '0');
        if( $price == 1 ){
            $price = false;
        }else{
            $price = true;
        }
    ?>
	<?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID(), 'price' => $price ) ); ?>
</div>
