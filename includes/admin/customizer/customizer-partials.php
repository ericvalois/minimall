<?php
function minimal_get_home_hero_title( $theme_options = false ){
    if( !$theme_options ){
        $theme_options = minimall_theme_options();
    }
    $title = minimall_get_option($theme_options, 'home_hero_title');
    return $title;
}
