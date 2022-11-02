<?php
/**
 * Header Cart
 *
 * Contains the markup for the header-cart, used by the cart widget.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="cart-content" id="cart-content-fragment">
	<p>В Вашей корзине:</p>
	<div class="line">
		<div class="label">Товаров:</div>
		<div class="value"><?=WC()->cart->get_cart_contents_count()?></div>
	</div>
	<div class="line">
		<div class="label">На сумму:</div>
		<div class="value"><?=WC()->cart->get_cart_subtotal()?></div>
	</div>
</div>