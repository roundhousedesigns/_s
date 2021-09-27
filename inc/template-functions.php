<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package RHD
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function rhd_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'rhd_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function rhd_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'rhd_pingback_header' );

/**
 * Set automatic excerpt length max.
 *
 * @param int $length
 * @return int The new length.
 */
function rhd_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'rhd_excerpt_length', PHP_INT_MAX );

/**
 * Excerpt Read More.
 *
 * @param string $more The Read More text.
 * @return string The filtered Read More content.
 */
function new_excerpt_more( $more ) {
	global $post;

	return sprintf( ' [&hellip;]<br /><a class="button moretag" href="%1$s">%2$s</a>', get_permalink( $post->ID ), __( 'Read More', 'rhd' ) );
}
add_filter( 'excerpt_more', 'new_excerpt_more' );