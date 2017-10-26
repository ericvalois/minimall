<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package minimal
 */

if ( ! is_active_sidebar( 'page-sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area lg-col-4" role="complementary">
	<?php dynamic_sidebar( 'page-sidebar' ); ?>
</aside><!-- #secondary -->
