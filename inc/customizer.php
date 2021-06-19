<?php
/**
 * RHD Theme Customizer
 *
 * @package RHD
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function rhd_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'rhd_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'rhd_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'rhd_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function rhd_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function rhd_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function rhd_customize_preview_js() {
	wp_enqueue_script( 'rhd-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), RHD_VERSION, true );
}
add_action( 'customize_preview_init', 'rhd_customize_preview_js' );

/**
 * Adds fields to the Customizer
 * @param WP_Customize_Manager $wp_customize
 * @return void
 */
function rhdwp_customizer_options( $wp_customize ) {
	/**
	 * Sections
	 */
	$wp_customize->add_section(
		'rhdwp_theme_options',
		array(
			'title'    => __( 'Theme Options', 'rhdwp' ),
			'priority' => 20,
		)
	);

	/**
	 * Settings
	 */
	$wp_customize->add_setting(
		'footer_heading_text',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'esc_textarea',
		)
	);

	$wp_customize->add_setting(
		'rhdwp_options[secondary_logo]',
		array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_setting(
		'rhdwp_options[cover_block_parallax]',
		array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'rhdwp_sanitize_checkbox',
		)
	);

	/**
	 * Controls
	 */
	$wp_customize->add_control(
		'rhdwp_options[cover_block_parallax]',
		array(
			'label'    => __( 'Cover Block parallax effect: ', 'rhdwp' ),
			'section'  => 'rhdwp_theme_options',
			'settings' => 'rhdwp_options[cover_block_parallax]',
			'type'     => 'checkbox',
		)
	);

	$wp_customize->add_control( new WP_Customize_Media_Control(
		$wp_customize,
		'rhdwp_options[secondary_logo]',
		array(
			'label'     => __( 'Secondary Logo: ', 'rhdwp' ),
			'section'   => 'title_tagline',
			'settings'  => 'rhdwp_options[secondary_logo]',
			'mime_type' => 'image',
		)
	)
	);

	$wp_customize->add_control(
		'footer_heading_text',
		array(
			'label'    => __( 'Footer Heading Text', 'rhdwp' ),
			'section'  => 'rhdwp_theme_options',
			'settings' => 'footer_heading_text',
			'type'     => 'input',
		)
	);
}
add_action( 'customize_register', 'rhdwp_customizer_options' );

/**
 * Sanitizes a checkbox input
 *
 * @param boolean $input
 * @return boolean True if checkbox is checked
 */
function rhdwp_sanitize_checkbox( $input ) {
	return ( isset( $input ) ? true : false );
}