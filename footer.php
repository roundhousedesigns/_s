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
			<?php
			/* translators: %s: CMS name, i.e. WordPress. */
			printf( esc_html__( '&copy; %s %s', 'rhd' ), date('Y'), 'Community Hospice' );
			?>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				_e( 'For internal use only.', 'rhd' );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
