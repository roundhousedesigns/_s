<?php
/**
 * The sidebar containing the footer widget areas
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package RHD
 */

?>

<aside id="footer-widget-area" class="widget-area widget-area__footer">
	<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
		<div class="widget-area__footer-right widget-area__footer__section">
			<?php dynamic_sidebar( 'sidebar-3' ); ?>
		</div>
		<?php endif;?>

		<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
			<div class="widget-area__footer-left widget-area__footer__section">
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			</div>
		<?php endif; ?>
</aside><!-- #secondary -->
