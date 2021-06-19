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
		<?php rhd_zeitgeist_footer_heading();?>

		<?php get_sidebar( 'footer' );?>

		<div class="site-info default-max-width">
			<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( '&copy; %s %s', 'rhd' ), date( 'Y' ), get_bloginfo( 'name' ) );
			?>
			<span class="sep"> | </span>
				<?php
					printf( '<a href="%s" rel="nofollow">%s</a>', 'https://roundhouse-designs.com', __( 'Site by Roundhouse Designs', 'rhd' ) );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer();?>

</body>
</html>
