<?php
/**
 * The sidebar containing the main widget area
 *
 * @package RHD
 */

if ( ! is_active_sidebar( 'sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area widget-area__sidebar">
	<?php dynamic_sidebar( 'sidebar' ); ?>
</aside><!-- #secondary -->
