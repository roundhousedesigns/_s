<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package RHD
 */

if ( ! function_exists( 'rhd_posted_on' ) ):
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function rhd_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'rhd' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'rhd_posted_by' ) ):
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function rhd_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'rhd' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'rhd_entry_footer' ) ):
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function rhd_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'rhd' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'rhd' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'rhd' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'rhd' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'rhd' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'rhd' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'rhd_post_thumbnail' ) ):
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function rhd_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ): ?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail();?>
			</div><!-- .post-thumbnail -->

			<?php
		else: ?>

		<a class="post-thumbnail" href="<?php the_permalink();?>" aria-hidden="true" tabindex="-1">
			<?php
				the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
		</a>

		<?php
	endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ):
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

/**
 * Prints the hamburger icon's HTML.
 *
 * @param string $style Button animation style (rot, htx, htla, htra)
 * @return void
 **/
if ( ! function_exists( 'rhd_menu_toggle' ) ) {
	function rhd_menu_toggle( $style ) {
		$allowed_styles = array( 'rot', 'htx', 'htla', 'htra' );
		$style          = $style && in_array( $style, $allowed_styles ) ? $style : 'rot';

		printf(
			'<button id="hamburger" class="menu-toggle c-hamburger c-hamburger--%s" aria-controls="primary-menu" aria-expanded="false">
<span>%s</span>
</button>',
			$style,
			esc_html( 'Main Menu', 'rhd' )
		);
	}
}


/**
 * Renders the custom logo, if set, or falls back to the site title and description.
 *
 * @return void
 */
if ( function_exists( 'rhd_custom_logo' ) ):
	function rhd_custom_logo() {
		if ( has_custom_logo() ) {
			$title = get_custom_logo();
		} else {
			$title = '<h1 class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . get_bloginfo( 'name' ) . '</a></h1>';
			if ( $description = get_bloginfo( 'description', 'display' ) || is_customize_preview() ) {
				$title .= '<p class="site-description">' . $description . '</p>';
			}
		}

		echo $title;
	}
endif;