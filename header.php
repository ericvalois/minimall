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
	<a class="skip-link screen-reader-text hide" href="#content"><?php esc_html_e( 'Skip to content', 'minimall' ); ?></a>

    <?php do_action("minimall_before_header"); ?>

    <?php do_action("minimall_header"); ?>

    <?php do_action("minimall_after_header"); ?>