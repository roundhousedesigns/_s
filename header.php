<?php
	/**
	 * The header for our theme
	 *
	 * This is the template that displays all of the <head> section and everything up until <div id="content">
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	 *
	 * @package RHD
	 */

?>
<!doctype html>
<html                                                                            <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo( 'charset' );?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head();?>
</head>

<body                                                                            <?php body_class();?>>
<?php wp_body_open();?>


<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'rhd' );?></a>

	<header id="masthead" class="site-header" style="background-image: url(<?php echo get_theme_mod( 'header_image' ); ?>)">
		<div class="site-branding">
			<?php rhd_custom_logo();?>
		</div><!-- .site-branding -->

		<?php rhd_menu_toggle( 'htx' );?>

		<div id="site-navigation" class="main-navigation">
			<nav>
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						)
					);
				?>
			</nav>
			<div class="site-social-search">
				<div id="header-search" class="search">
					<?php get_template_part('template-parts/module', 'search'); ?>
				</div>
				<?php
					if ( function_exists( 'rhdwp_social_icons' ) ) {
						rhdwp_social_icons( true );
					}
				?>
			</div>
		</div><!-- #site-navigation -->
	</header><!-- #masthead -->
