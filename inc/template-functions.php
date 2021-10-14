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
	if ( ! is_active_sidebar( 'sidebar' ) ) {
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
 * Filter wp_nav_menu() to add additional links and other output. Requires WooCommerce.
 *
 * @param string $items The current nav HTML.
 * @return string The filtered HTML.
 */
function new_nav_menu_items( $items ) {
	if ( ! function_exists( 'wc_get_cart_url' ) ) {
		return;
	}

	$cart_link = sprintf(
		'<li class="menu-item menu-item-custom menu-item-cart"><a href="%1$s" title="%3$s">%2$s</a></li>',
		wc_get_cart_url( '/' ),
		rhd_get_svg_template_part( 'cart' ),
		__( 'Cart', 'rhd' )
	);

	$items = $items . $cart_link;

	return $items;
}
add_filter( 'wp_nav_menu_items', 'new_nav_menu_items' );