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
 * RHDWP Related Posts
 */
if ( function_exists( 'rhdwp_related_posts' ) ) {
	// Unhook to allow manual placement
	remove_action( 'the_content', 'rhdwp_related_posts_content_hook' );
}

/**
 * Removes the Website field from comment forms
 *
 * @param array $fields
 * @return void
 */
function rhd_comments_unset_url_field( $fields ) {
	if ( isset( $fields['url'] ) ) {
		unset( $fields['url'] );
	}

	return $fields;
}

add_filter( 'comment_form_default_fields', 'rhd_comments_unset_url_field' );

add_filter( 'excerpt_length', function($length) {
	return 20;
}, PHP_INT_MAX );
