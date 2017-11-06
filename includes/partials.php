<?php
/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function minimall_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function minimall_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Render the homepage hero title
 */
/*function minimal_get_homepage_hero_title(){
    return nl2br( get_theme_mod('home_hero_title') );
}*/

/**
 * Render the homepage hero description
 */
/*function minimal_get_homepage_hero_desc(){
    return get_theme_mod('home_hero_desc');
}*/

/**
 * Render the homepage hero image
 */
/*function minimal_get_homepage_hero_image(){
    return get_theme_mod('home_hero_img');
}*/

/**
 * Render the homepage hero image
 */
function minimal_partial_get_home_section_header(){
    //return get_theme_mod('home_hero_img');
}