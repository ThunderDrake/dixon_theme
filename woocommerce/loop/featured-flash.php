<?php
/**
 * Product loop featured flash
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

if($product->get_featured())
{
	echo apply_filters( 'woocommerce_featured_flash', '<span class="badge">Хит</span>', $post, $product );
}
?>