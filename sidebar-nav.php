<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package RHD
 */

if ( ! is_active_sidebar( 'sidebar-4' ) ) {
	return;
}
?>

<div id="off-canvas-navigation" class="widget-area widget-area__nav">
	<?php dynamic_sidebar( 'sidebar-4' ); ?>
</div><!-- #secondary -->
