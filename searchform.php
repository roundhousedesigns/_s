<?php
/**
 * Search form.
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo home_url(); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Search for' );?>:</span>
		<input type="search" class="search-field" placeholder="Search..." name="s" value>
	</label>
	<input type="submit" class="search-submit" value="Go">
</form>