<?php

defined( 'ABSPATH' ) || exit;

global $product;
$featured_product_classes = wc_get_loop_prop('product_additional_classes');

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$classes = 'items-grid-item-holder col-xs-12 col-md-3 col-sm-6';
if($featured_product_classes)
{
	$classes = $classes.' '.$featured_product_classes;
}

?>
<div class="<?=$classes?>">
	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked diamond_template_loop_product_wrapper_open - 5
	 * @hooked diamond_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * Hook: woocommerce_before_shop_loop_item_title.
	 *
	 * @hooked diamond_template_loop_product_thumbnail_wrapper - 5
	 * @hooked diamond_template_loop_product_thumbnail - 10
	 * @hooked diamond_template_loop_product_thumbnail_wrapper_end - 15
	 */
	do_action( 'woocommerce_before_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_shop_loop_item_title.
	 *
	 * @hooked diamond_template_loop_product_title - 10
	 */
	do_action( 'woocommerce_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked diamond_template_loop_product_link_close - 5
	 * @hooked diamond_template_loop_add_to_cart_wrapper - 9
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 * @hooked diamond_template_loop_add_to_cart_wrapper_close - 11
	 * @hooked diamond_template_loop_product_wrapper_close - 15
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
	?>
</div>