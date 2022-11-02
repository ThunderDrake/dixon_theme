<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
<div class="woocommerce-checkout-shipping">
<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

<?php wc_cart_totals_shipping_html(); ?>

<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
</div>
<?php endif; ?>