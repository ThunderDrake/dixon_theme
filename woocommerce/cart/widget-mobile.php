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
<a class="cart" id="mobile-cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>"><?php $cc = WC()->cart->get_cart_contents_count(); if($cc > 0) { echo "<span>{$cc}</span>"; } ?></a>