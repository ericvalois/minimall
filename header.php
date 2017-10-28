<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package minimal
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="overflow-scroll">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'minimall' ); ?></a>

	<header id="masthead" class="site-header line-height-3 flex items-center flex-wrap col-12 bg-white" role="banner">
        
        <div class="flex justify-between items-center lg-flex col-12 lg-col-3 line-height-1 header-menu">
            <div class="site-branding flex-auto col-6 lg-col-2 flex items-center">
                <?php get_template_part( 'template-parts/custom', 'logo' ); ?>
            </div><!-- .site-branding -->

            <button id="main_nav_toggle" class="menu-toggle lg-hide p0 border-none bg-white" aria-controls="primary-menu" aria-expanded="false">
                <svg class="menu-open" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" xml:space="preserve" width="64" height="64"><g class="nc-icon-wrapper" fill="#444444"><line data-color="color-2" fill="none" stroke="#444444" stroke-width="3" stroke-linecap="square" stroke-miterlimit="10" x1="4" y1="32" x2="60" y2="32" stroke-linejoin="miter"></line> <line fill="none" stroke="#444444" stroke-width="3" stroke-linecap="square" stroke-miterlimit="10" x1="4" y1="14" x2="60" y2="14" stroke-linejoin="miter"></line> <line fill="none" stroke="#444444" stroke-width="3" stroke-linecap="square" stroke-miterlimit="10" x1="4" y1="50" x2="60" y2="50" stroke-linejoin="miter"></line></g></svg>
                <svg class="menu-close" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" xml:space="preserve" width="64" height="64"><g class="nc-icon-wrapper" fill="#444444" transform="translate(0.5, 0.5)"><line fill="none" stroke="#444444" stroke-width="3" stroke-linecap="square" stroke-miterlimit="10" x1="54" y1="10" x2="10" y2="54" stroke-linejoin="miter"></line> <line fill="none" stroke="#444444" stroke-width="3" stroke-linecap="square" stroke-miterlimit="10" x1="54" y1="54" x2="10" y2="10" stroke-linejoin="miter"></line></g></svg>
            </button><!-- .menu-toggle -->
        </div><!-- .header-menu -->
        

        <nav id="site-navigation" class="main-navigation lg-block col-12 lg-col-9" role="navigation">
            <?php
                if ( has_nav_menu( 'primary' ) ) {
                    minimall_custom_menu('primary');
                }
            ?>
        </nav><!-- .main-navigation -->

    </header>

    <?php do_action("minimall_after_header"); ?>