<?php
/**
 * Product loop featured flash
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

$new = false;;

$terms = get_the_terms( $product->get_id(), 'product_tag' );
if($terms)
{
	foreach($terms as $term)
	{
		if($term->term_id == 1730)
		{
			$new = true;
			break;
		}
	}
}

if($new)
{
	echo apply_filters( 'woocommerce_featured_flash', '<span class="badge">Новинка</span>', $post, $product );
}
?>