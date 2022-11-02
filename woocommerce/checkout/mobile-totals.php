<div class="mobile-totals">
	<div class="totals-row cart-subtotal">
		<div class="label"><?php _e( 'Subtotal', 'woocommerce' ); ?></div>
		<div class="value"><?php wc_cart_totals_subtotal_html(); ?></div>
	</div>

	<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
	<div class="totals-row cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
		<div class="label"><?php wc_cart_totals_coupon_label( $coupon ); ?></div>
		<div class="value"><?php wc_cart_totals_coupon_html( $coupon ); ?></div>
	</div>
	<?php endforeach; ?>

	<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
	<div class="totals-row fee">
		<div class="label"><?php echo esc_html( $fee->name ); ?></div>
		<div class="value"><?php wc_cart_totals_fee_html( $fee ); ?></div>
	</div>
	<?php endforeach; ?>

	<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
	<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
	<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
	<div class="totals-row tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
		<div class="label"><?php echo esc_html( $tax->label ); ?></div>
		<div class="value"><?php echo wp_kses_post( $tax->formatted_amount ); ?></div>
	</div>
	<?php endforeach; ?>
	<?php else : ?>
	<div class="totals-row tax-total">
		<div class="label"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></div>
		<div class="value"><?php wc_cart_totals_taxes_total_html(); ?></div>
	</div>
	<?php endif; ?>
	<?php endif; ?>

	<?php if ($shipping = WC()->cart->get_cart_shipping_total()) : ?>
	<div class="totals-row fee">
		<div class="label">Доставка</div>
		<div class="value"><?php echo $shipping; ?></div>
	</div>
	<?php endif; ?>

	<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

	<div class="totals-row order-total">
		<div class="label"><?php _e( 'Total', 'woocommerce' ); ?></div>
		<div class="value"><?php wc_cart_totals_order_total_html(); ?></div>
	</div>

	<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
</div>