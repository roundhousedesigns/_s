<?php
/**
 * The sidebar containing the footer widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package RHD
 */

if ( ! is_active_sidebar( 'footer-widgets' ) ) {
	return;
}
?>

<aside id="footer-widget-area" class="widget-area widget-area__footer">
	<?php dynamic_sidebar( 'footer-widgets' ); ?>
</aside><!-- #secondary -->
