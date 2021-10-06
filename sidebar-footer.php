<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package RHD
 */

if ( ! is_active_sidebar( 'sidebar-footer' ) ) {
	return;
}
?>

<aside id="footer-widget-area" class="widget-area widget-area__footer">
	<?php dynamic_sidebar( 'sidebar-footer' ); ?>
</aside><!-- #secondary -->
