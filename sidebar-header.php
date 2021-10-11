<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package RHD
 */

if ( ! is_active_sidebar( 'sidebar-header' ) ) {
	return;
}
?>

<nav id="header-widget-area" class="widget-area widget-area__header off-canvas">
	<?php dynamic_sidebar( 'sidebar-header' ); ?>
</nav>
