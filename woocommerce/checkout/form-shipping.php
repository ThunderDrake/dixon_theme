<?php
/**
 * Checkout shipping information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-shipping.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<?php if ( true === WC()->cart->needs_shipping_address() ) : ?>
<div class="woocommerce-shipping-fields">
	<?php $shipping = $checkout->get_checkout_fields( 'shipping' ); ?>
	<div class="checkout-block">
		<div class="checkout-block-header">Доставка</div>
		<div class="checkout-block-content">
			<input id="ship-to-different-address-checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" type="hidden" name="ship_to_different_address" value="1" />
			<?php

			/*
			if(isset($shipping['shipping_country']))
			{
				$key = 'shipping_country';
				woocommerce_form_field( $key, $shipping[$key], $checkout->get_value( $key ) );
			}

			if(isset($shipping['shipping_state']))
			{
				$key = 'shipping_state';
				woocommerce_form_field( $key, $shipping[$key], $checkout->get_value( $key ) );
			}

			
			if(isset($shipping['shipping_city']))
			{
				$key = 'shipping_city';
				woocommerce_form_field( $key, $shipping[$key], $checkout->get_value( $key ) );
			}
			*/ ?>
			<div class="shipping__info">
				<?php 
				foreach ( $shipping as $key => $field ) {
					woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
				} ?>
				
			</div>
		</div>
	</div>
	<?php /*
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
	
	<div class="checkout-block">
		<div class="checkout-block-header">Оплата</div>
		<div class="checkout-block-content">
			<?php woocommerce_checkout_payment(); ?>
		</div>
	</div>
	*/ ?>
</div>
<?php endif; ?>
<?php /*
<div class="woocommerce-additional-fields">
	<div class="checkout-block">
		<div class="checkout-block-header">Дополнительная информация</div>
		<div class="checkout-block-content">
			<?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>

			<?php if ( apply_filters( 'woocommerce_enable_order_notes_field', 'yes' === get_option( 'woocommerce_enable_order_comments', 'yes' ) ) ) : ?>
			<div class="woocommerce-additional-fields__field-wrapper">
			<?php foreach ( $checkout->get_checkout_fields( 'order' ) as $key => $field ) : ?>
				<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
			<?php endforeach; ?>
			</div>
			<?php endif; ?>

			<?php do_action( 'woocommerce_after_order_notes', $checkout ); ?>
		</div>
	</div>
</div>
*/ ?>