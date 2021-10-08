<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package RHD
 */

?>
	<footer id="colophon" class="site-footer">
		<?php get_sidebar( 'footer' ); ?>

		<div class="site-info">
			<?php rhd_footer_site_info(); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
