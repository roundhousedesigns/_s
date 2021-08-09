<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package RHD
 */

?>
	<footer id="colophon" class="site-footer">
		<div class="site-info default-max-width">
			<?php printf( esc_html__( '&copy; %s %s', 'rhd' ), date('Y'), get_bloginfo( 'name' ) ); ?>
			<span class="sep"> | </span>
			<?php printf( __( 'Site by <a href="%s" target="_blank">%s</a>', 'rhd' ), 'https://roundhouse-designs.com', 'Roundhouse Designs' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
