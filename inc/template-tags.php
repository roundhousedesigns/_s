<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package RHD
 */

/**
 * Prints HTML with meta information for the current post-date/time.
 *
 * @param string $append Text to append to the post date (Default: '')
 */
function rhd_posted_on( $append = '' ) {
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

/**
 * Prints HTML with meta information for the categories, tags and comments.
 *
 * @param boolean $show_taxonomies False to hide categories and tags (Default: true).
 * @return void
 */
function rhd_entry_footer( $show_taxonomies = true ) {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() && $show_taxonomies ) {
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

/**
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * @param string $size Thumbnail size.
 * @return void
 */
function rhd_post_thumbnail( $size = 'post-thumbnail' ) {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) {
		echo '<div class="post-thumbnail">' . the_post_thumbnail( $size ) . '</div>';
	} else {
		printf(
			'<a class="post-thumbnail" href="%s" aria-hidden="true" tabindex="-1">%s</a>',
			get_the_permalink(),
			the_post_thumbnail(
				'post-thumbnail',
				array(
					'alt' => the_title_attribute(
						array(
							'echo' => false,
						)
					),
				)
			)
		);
	}
}

/**
 * Shim for sites older than 5.2.
 *
 * @link https://core.trac.wordpress.org/ticket/12563
 */
if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

/**
 * Prints the hamburger icon's HTML.
 *
 * @param string $style Button animation style (rot, htx, htla, htra)
 * @return void
 **/
function rhd_menu_toggle( $style ) {
	$allowed_styles = array( 'rot', 'htx', 'htla', 'htra' );
	$style          = $style && in_array( $style, $allowed_styles ) ? $style : 'rot';

	printf(
		'<button id="hamburger" class="menu-toggle c-hamburger c-hamburger--%s" aria-controls="primary-menu" aria-expanded="false">
<span class="menu"></span><span class="label">%s</span>
</button>',
		$style,
		esc_html__( 'Menu', 'rhd' )
	);
}

/**
 * Renders the custom logo, if set, or falls back to the site title and description.
 *
 * @return void
 */
function rhd_custom_logo() {
	if ( has_custom_logo() ) {
		$title = get_custom_logo();
	} else {
		$title = '<h1 class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . get_bloginfo( 'name' ) . '</a></h1>';
	}

	echo $title;
}

/**
 * Renders the secondary logo, if set.
 *
 * @return void
 */
function rhd_secondary_logo() {
	$options = get_option( 'rhd_options' );
	$img     = '';
	if ( isset( $options['secondary_logo'] ) && $options['secondary_logo'] > 0 ) {
		$img = wp_get_attachment_image( $options['secondary_logo'], 'full', false, array( 'class' => 'secondary-logo' ) );
	}

	echo wp_kses_post( $img );
}

/**
 * Renders footer byline/links.
 *
 * Adds the Roundhouse Designs "site by" line if %rhd% placeholder isn't present.
 *
 * @return void
 */
function rhd_footer_site_info() {
	$placeholders = array(
		'year'            => date( 'Y' ),
		'sitename'        => get_bloginfo( 'name' ),
		'sitedescription' => get_bloginfo( 'description' ),
		'rhd'             => sprintf(
			'<a class="site-info-link" href="%1$s" target="_blank">Site by %2$s</a>',
			esc_url( 'https://roundhouse-designs.com' ),
			esc_html__( 'Roundhouse Designs', 'rhd' )
		),
	);

	$bylines = array(
		get_theme_mod( 'rhd_footer_byline_text' ),
		get_theme_mod( 'rhd_footer_byline_text-2' ),
	);

	// Check for `rhd` placeholder, and if not found, append to second line.
	$found = false;
	foreach ( $bylines as $line ) {
		if ( stripos( $line, '%rhd%' ) !== false ) {
			$found = true;
		}
	}
	$bylines[1] .= false === $found ? $placeholders['rhd'] : '';

	foreach ( $placeholders as $placeholder => $replacement ) {
		$pattern = "/%${placeholder}%/";
		$bylines = preg_replace( $pattern, $replacement, $bylines );
	}

	$filtered = sprintf( '<p>%s</p>', implode( '</p><p>', $bylines ) );

	echo wp_kses_post( $filtered );
}

/**
 * Renders the header SVG background image
 *
 * @param array $classes Additional classes
 * @return void
 */
function rhd_header_background_svg( $classes = array() ) {
	$classes = array_merge( $classes, array( 'svg' ) );

	printf( '<img src="%s" alt="" class="%s" />', get_stylesheet_directory_uri() . '/assets/svg/header.svg', implode( ' ', $classes ) );
}

/**
 * Retrieves the main image for use in the template.
 *
 * For `film` and `live_event` post types, looks for an Agile image first.
 *
 * @param int    $id The post id.
 * @param string $sub Additional optional text.
 * @return string The HTML output.
 */
function rhd_single_banner_image( $id = null, $sub = '' ) {
	$id = $id ? $id : get_the_id();

	$image = in_array( get_post_type(), array( 'film', 'live_event' ) ) ? get_post_meta( $id, 'agile_image_main', true ) : get_the_post_thumbnail_url( $id, 'full' );

	$html = '';
	if ( $image ) {
		$html = sprintf(
			'<figure class="banner-image"><img src="%1$s" /><figcaption class="banner-image__title"><span class="title">%2$s<span class="sub">%3$s</span></span></figcaption></figure>',
			esc_url( $image ),
			get_the_title(),
			$sub ? esc_textarea( $sub ) : '',
		);
	}

	return $html;
}

/**
 * Displays `film` and `live_event` metadata, with labels.
 *
 * @param int   $id The post ID (defaults to the current post).
 * @param array $fields Display labels keyed by meta key.
 * @return string The HTML output.
 */
function rhd_film_event_meta( $id, $fields ) {
	$lines = array();
	foreach ( $fields as $key => $value ) {
		$meta = maybe_unserialize( get_post_meta( $id, $key, true ) );

		if ( $meta ) {
			switch ( $value ) {
			case 'Directed by':
				$schema = 'director';
				break;

			case 'Starring':
				$schema = 'actor';
				break;

			case 'Produced by':
				$schema = 'producer';
				break;

			case 'Music by':
				$schema = 'musicBy';
				break;

			case 'Original Language':
				$schema = 'inLanguage';
				break;

			case 'Production Country':
				$schema = 'countryOfOrigin';
				break;

			case 'Rating':
				$schema = 'contentRating';
				break;

			case 'Run Time':
				$schema = 'duration';
				break;

			default:
				$schema = null;
			}

			if ( gettype( $meta ) === 'array' ) {
				// Structured data.
				$i = 0;
				if ( $schema ) {
					foreach ( $meta as $val ) {
						$meta[$i] = sprintf( '<span itemprop="%1$s">%2$s</span>', $schema, $val );
						$i++;
					}
				}

				$meta = implode( '<br />', $meta );
			} else {
				if ( $schema ) {
					if ( 'Run Time' === $value ) {
						// Add 'min' suffix to `duration` meta.
						$duration = sprintf( 'PT%1$sM', $meta );
						$meta .= esc_html__( ' min', 'rhd' );
						$meta = sprintf( '<span itemprop="%1$s" content="%2$s">%3$s</span>', $schema, $duration, $meta );
					} else {
						$meta = sprintf( '<span itemprop="%1$s">%2$s</span>', $schema, $meta );
					}
				}
			}

			$lines[] = sprintf(
				'<dt>%1$s:</dt><dd>%2$s</dd>',
				esc_textarea( $value ),
				$meta,
			);
		}
	}

	return $lines ? sprintf( '<dl class="film-live_event-meta">%s</dl>', implode( "\n", $lines ) ) : '';
}

/**
 * Displays `film` and `live_event` metadata formatted links, with labels.
 *
 * @param int   $id The post ID (defaults to the current post).
 * @param array $fields Display labels keyed by meta key.
 * @return string The HTML output.
 */
function rhd_film_event_meta_link( $id, $fields ) {
	$lines = array();
	foreach ( $fields as $key => $value ) {
		$meta = maybe_unserialize( get_post_meta( $id, $key, true ) );

		if ( $meta ) {
			if ( gettype( $meta ) === "array" ) {
				$meta = implode( '<br />', $meta );
			}

			$lines[] = sprintf( '<dt>%1$s:</dt><dd><a href="%2$s" rel="nofollow" target="_blank">%2$s</a></dd>', esc_textarea( $value ), wp_kses_post( $meta ) );
		}
	}

	return $lines ? sprintf( '<dl class="film-live_event-meta">%s</dl>', implode( "\n", $lines ) ) : '';
}

/**
 * Renders the Sponsor section for `film` and `live_event` post types.
 *
 * @param int $id The post id.
 * @return string The HTML output.
 */
function rhd_film_event_sponsor( $id = null ) {
	$id = $id ? $id : get_the_id();

	$sponsor = array(
		'text'  => get_post_meta( $id, 'sponsor_name', true ),
		'image' => get_post_meta( $id, 'sponsor_image', true ),
		'link'  => get_post_meta( $id, 'sponsor_link', true ),
	);

	$post_type = get_post_type_object( get_post_type() );

	$html = esc_html__(
		sprintf(
			'This %1$s needs a sponsor, could it be you?',
			strtolower( $post_type->labels->singular_name ),
		)
	) . ' ' . sprintf(
		'<a href="%1$s" rel="bookmark" style="font-weight: 600;">SPONSOR THIS EVENT</a>',
		esc_url( home_url( '/support/film-event-sponsors' ) )
	);

	if ( ! empty( $sponsor ) ) {
		$image = isset( $sponsor['image'] ) ? $sponsor['image'] : '';
		$text  = isset( $sponsor['text'] ) ? $sponsor['text'] : '';
		$link  = isset( $sponsor['link'] ) ? $sponsor['link'] : '';

		if ( $image ) {
			$html = sprintf(
				'<figure class="sponsor-image">%1$s<figcaption class="screen-reader-text">%2$s</figcaption></figure>',
				wp_get_attachment_image( $image, 'small', false, array( 'class' => $text ) ),
				$text
			);
		} elseif ( $text ) {
			$html = sprintf( '<p>%1$s</p>', esc_textarea( $text ) );
		}

		if ( $link ) {
			$html = '<a href="' . esc_url( $link ) . '" target="_blank">' . $html . '</a>';
		}
	}

	return wp_kses_post( '<p>' . $html . '</p>' );
}

/**
 * Renders a video/trailer for `film` and `live_event` post types.
 *
 * @param int $id The post id.
 * @return string The HTML output.
 */
function rhd_film_event_video( $id = null ) {
	$id = $id ? $id : get_the_id();

	$meta = get_post_meta( $id, 'youtube_id', true );

	$html = '';

	if ( $meta ) {
		$html = wp_oembed_get( 'https://youtube.com/watch?v=' . $meta, array( 'width' => '900' ) );
	}

	return $html;
}

/**
 * Gets a set of terms for a post's taxonomies based on its post type.
 *
 * @param int $id The post ID (defaults to the current post).
 * @return void
 */
function rhd_taxonomy_badges( $id = null ) {
	$id   = $id ? $id : get_the_id();
	$html = '';

	switch ( get_post_type() ) {
	case 'post':
		$taxonomies = array( 'category', 'tag' );
		break;

	case 'film':
		$taxonomies = array( 'film_event_category', 'film_genre' );
		break;

	case 'live_event':
		$taxonomies = array( 'film_event_category' );
		break;
	}

	foreach ( $taxonomies as $taxonomy ) {
		$terms = get_the_terms( $id, $taxonomy );

		if ( $terms ) {
			$html .= '<ul class="entry-taxonomies">';
			foreach ( $terms as $term ) {
				$html .= sprintf(
					'<li class="taxonomy-badge %1$s"><a class="post-item-taxonomy-link %4$s type-%5$s" href="%2$s" rel="bookmark">%3$s</a></li>',
					$term->slug,
					get_term_link( $term, $taxonomy ),
					$term->name,
					$taxonomy,
					get_post_type(),
				);
			}
			$html .= '</ul>';
		}

	}

	$html .= '</ul>';

	echo $html;
}