<?php 
    $content = get_theme_mod('home_'.$section.'_free',false); 
    if( !empty( $content ) ): 
        echo apply_filters( 'the_content', $content );
    endif; 
?>