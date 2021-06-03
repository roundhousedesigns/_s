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
		<?php get_sidebar( 'footer' ); ?>

		<?php rhdwp_social_icons( true ); ?>

		<div class="site-info default-max-width">
			<?php
			/* translators: %s: CMS name, i.e. WordPress. */
			printf( esc_html__( '&copy; %s %s', 'rhd' ), date('Y'), get_bloginfo('name') );
			?>
			<span class="sep"> | </span>
			Site by <a href="https://roundhouse-designs.com" target="_blank">Roundhouse Designs</a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
