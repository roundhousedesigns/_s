<?php
/**
 * Default template for Related Post items.
 *
 * @package RHD
 */

echo RHD_Base::item_template__post( get_post_type(), 'film_event_category', false, array( 'related-post' ) );
?>