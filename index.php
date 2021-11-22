<?php
/**
 * The main template file
 *
 * @package RHD
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		if ( have_posts() ) :
			if ( is_home() ) :
				$paged = get_query_var( 'paged' );
				?>
				<header>
					<h1 class="page-title"><?php single_post_title(); ?> <?php echo $paged > 1 ? '&bull; ' . __( 'Page ', 'rhd' ) . $paged : ''; ?></h1>
				</header> <?php
			endif;
			?>

			<div class="feed">
			
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', get_post_type() );
			endwhile;
			?>
			</div><!-- .feed -->

			<?php the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
