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
 *
 * @param WP_Customize_Manager $wp_customize
 * @return void
 */
function rhd_customizer_options( $wp_customize ) {
	/**
	 * Sections
	 */
	$wp_customize->add_section(
		'rhd_theme_options',
		array(
			'title'    => __( 'Theme Options', 'rhd' ),
			'priority' => 20,
		)
	);

	/**
	 * Settings
	 */
	$wp_customize->add_setting(
		'rhd_footer_byline_text',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_setting(
		'rhd_footer_byline_text-2',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_setting(
		'rhd_options[secondary_logo]',
		array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'manage_options',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_setting(
		'rhd_options[fallback_thumb]',
		array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'manage_options',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_setting(
		'rhd_options[cart_link]',
		array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'manage_options',
			'sanitize_callback' => 'esc_url',
		)
	);

	$wp_customize->add_setting(
		'rhd_options[venue_address_street]',
		array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'manage_options',
			'sanitize_callback' => 'esc_textarea',
		)
	);
	
	$wp_customize->add_setting(
		'rhd_options[venue_address_city]',
		array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'manage_options',
			'sanitize_callback' => 'esc_textarea',
		)
	);
	
	$wp_customize->add_setting(
		'rhd_options[venue_address_state]',
		array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'manage_options',
			'sanitize_callback' => 'esc_attr',
		)
	);
	
	$wp_customize->add_setting(
		'rhd_options[venue_address_zip]',
		array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'manage_options',
			'sanitize_callback' => 'esc_attr',
		)
	);

	/**
	 * Controls
	 */
	$wp_customize->add_control(
		'rhd_footer_byline_text',
		array(
			'label'       => __( 'Footer byline ', 'rhd' ),
			'description' => __( 'Site info. HTML allowed, along with the following placeholders:<br />%year%, %sitename%, %sitedescription%, %rhd%', 'rhd' ),
			'section'     => 'rhd_theme_options',
			'settings'    => 'rhd_footer_byline_text',
			'type'        => 'textarea',
		)
	);

	$wp_customize->add_control(
		'rhd_footer_byline_text-2',
		array(
			'label'       => __( 'Footer Byline 2 (HTML)', 'rhd' ),
			'description' => __( 'Site info. HTML allowed, along with the following placeholders:<br />%year%, %sitename%, %sitedescription%, %rhd%', 'rhd' ),
			'section'     => 'rhd_theme_options',
			'settings'    => 'rhd_footer_byline_text-2',
			'type'        => 'textarea',
		)
	);

	$wp_customize->add_control(
		'rhd_options[cart_link]',
		array(
			'label'    => __( 'Shopping Cart Link', 'rhd' ),
			'section'  => 'rhd_theme_options',
			'settings' => 'rhd_options[cart_link]',
			'type'     => 'url',
		)
	);

	$wp_customize->add_control(
		'rhd_options[venue_address_street]',
		array(
			'label'    => __( 'Venue Address: Street', 'rhd' ),
			'section'  => 'rhd_theme_options',
			'settings' => 'rhd_options[venue_address_street]',
			'type'     => 'text',
		)
	);
	
	$wp_customize->add_control(
		'rhd_options[venue_address_city]',
		array(
			'label'    => __( 'Venue Address: City', 'rhd' ),
			'section'  => 'rhd_theme_options',
			'settings' => 'rhd_options[venue_address_city]',
			'type'     => 'text',
		)
	);
	
	$wp_customize->add_control(
		'rhd_options[venue_address_state]',
		array(
			'label'    => __( 'Venue Address: State', 'rhd' ),
			'section'  => 'rhd_theme_options',
			'settings' => 'rhd_options[venue_address_state]',
			'type'     => 'text',
		)
	);
	
	$wp_customize->add_control(
		'rhd_options[venue_address_zip]',
		array(
			'label'    => __( 'Venue Address: Zip', 'rhd' ),
			'section'  => 'rhd_theme_options',
			'settings' => 'rhd_options[venue_address_zip]',
			'type'     => 'text',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'rhd_options[secondary_logo]',
			array(
				'label'     => __( 'Secondary Logo', 'rhd' ),
				'section'   => 'rhd_theme_options',
				'settings'  => 'rhd_options[secondary_logo]',
				'mime_type' => 'image',
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'rhd_options[fallback_thumb]',
			array(
				'label'     => __( 'Fallback Post Thumbnail', 'rhd' ),
				'section'   => 'rhd_theme_options',
				'settings'  => 'rhd_options[fallback_thumb]',
				'mime_type' => 'image',
			)
		)
	);
}
add_action( 'customize_register', 'rhd_customizer_options' );
