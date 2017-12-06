<?php
/*
* Dequeue webfont-loader from kirki
*/
add_action( 'wp_head', 'wpdocs_dequeue_script', 999 );
function wpdocs_dequeue_script() {
    wp_deregister_script('webfont-loader');
    wp_dequeue_script('webfont-loader');
 }
 