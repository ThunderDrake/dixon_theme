<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$ms = $product->managing_stock();
$sc = 1;
$ba = false;
if($ms)
{
	$sc = $product->get_stock_quantity();
	$ba = $product->backorders_allowed();
}

if($ms and $sc <= 0 and !$ba)
{
	echo sprintf('<span class="%1$s" title="%2$s">%2$s</span>',
		esc_attr( 'button out-of-stock' ),
		'Нет в наличии'
	);
}
else
{

	$product_id = $product->get_id();
	$product_cart_id = WC()->cart->generate_cart_id( $product_id );
	$in_cart = WC()->cart->find_product_in_cart( $product_cart_id );

	if($in_cart)
	{
		echo sprintf('<a href="%1$s" class="added_to_cart wc-forward" title="%2$s">%2$s</a>',
				wc_get_cart_url(),
				'В корзине'// 'Оформить заказ'
			);
	}
	else
	{
		$button_text = ($ms and $sc <= 0 and $ba) ? 'Предзаказ' : $product->add_to_cart_text();
		echo apply_filters('woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
			sprintf( '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
				esc_url( $product->add_to_cart_url() ),
				esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
				esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
				isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
				esc_html( $button_text )
			),
		$product, $args);
	}
}