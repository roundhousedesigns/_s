<?php
/**
 * The template for displaying WooCommerce products.
 *
 * @package RHD
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="entry-title"><?php _e( 'Shop', 'rhd' ); ?></h1>
			</header><!-- .page-header -->

			<ul class="product-list">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/content', 'product' ); ?>
				<?php endwhile; ?>
			</ul>

			<?php
			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
