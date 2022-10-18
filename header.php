<?php
	/**
	 * The theme header.
	 *
	 * @package RHD
	 */

?>
<!doctype html>
<html                                    <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo( 'charset' );?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head();?>
</head>

<body                                    <?php body_class();?>>
<?php wp_body_open();?>


<nav id="site-navigation" class="main-navigation">
	<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
			)
		);
	?>
</nav><!-- #site-navigation -->

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'rhd' );?></a>

	<header class="site-header">
		<div class="site-branding">
			<?php rhd_custom_logo();?>
<?php rhd_secondary_logo();?>
<?php rhd_menu_toggle( 'htx' );?>
		</div><!-- .site-branding -->

	</header><!-- #masthead -->
