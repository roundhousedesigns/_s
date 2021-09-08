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
		<div class="site-footer__inner">
			<?php get_sidebar( 'footer' ); ?>
		</div>
		<div class="site-info">
			<?php rhd_footer_site_info(); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
