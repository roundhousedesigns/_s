<?php
/**
 * Author Box
 */

$author = array(
	'ID'           => get_the_author_meta( 'ID' ),
	'display_name' => get_the_author_meta( 'display_name' ),
	'firstname'    => get_the_author_meta( 'user_firstname'),
	'description'  => get_the_author_meta( 'description' ),
);

$author_image = function_exists( 'mt_profile_img' )
? mt_profile_img(
	$author['ID'],
	array(
		'size' => 'medium',
		'attr' => array(
			'alt' => $author['display_name'],
		),
		'echo' => false,
	)
)
: get_avatar( $author['ID'], 96, 'wavatar', $author['display_name'] );
?>

<div class="post-author">
	<div class="post-author-image">
		<?php echo $author_image; ?>
	</div>
	<div class="post-author-content">
		<h3 class="post-author-content__name"><?php echo $author['display_name'] ?></h3>
		<?php if ( $author['description'] ): ?>
			<p class="post-author-content__description"><?php echo esc_textarea( $author['description'] ); ?></p>
		<?php endif;?>

		<a class="button" href="<?php echo home_url( '/about' ); ?>" rel="bookmark"><?php printf( '%1$s %2$s', __( 'About', 'rhd' ), $author['firstname'] ); ?></a>
	</div>
</div>