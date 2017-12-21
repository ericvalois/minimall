<?php
/*
* Dequeue webfont-loader from kirki
*/
add_action( 'wp_head', 'minimall_kirki_dequeue_webfont_loader', 999 );
function minimall_kirki_dequeue_webfont_loader() {
    wp_deregister_script('webfont-loader');
    wp_dequeue_script('webfont-loader');
 }
 