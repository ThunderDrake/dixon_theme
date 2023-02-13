<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>
	<section class="checkout">
		<div class="container checkout__container">
			<?php ct()->template( '/checkout/parts/checkout__header.php' ) ?>
			<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
				<div class="checkout__form checkout-form" style="position: relative">
					<div class="checkout__form-wrapper">
						<?php if ( $checkout->get_checkout_fields() ) : ?>

						<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
						<div class="checkout-form__group">
							<div class="checkout__form-wrapper" id="customer_details">
								<?php do_action( 'woocommerce_checkout_billing' ); ?>
							</div>
						</div>

						<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

						<?php endif; ?>

						<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>

						<div class="checkout-form__group">
							<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
							<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
							<div class="checkout-form__group-title"><span class="checkout-form__group-title-number">2</span>Ваш заказ</div>
							<?php 
							foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ):
							$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
							
							if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ):
							?>
							<div class="checkout-form__cart-item">
								<img loading="lazy" src="<?= wp_get_attachment_image_url( $_product->get_image_id(), 'full' ) ?>" class="checkout-form__cart-image" width="75" height="90" alt="">
								<div class="checkout-form__cart-title"><?php echo $_product->get_title() ?></div>
								<div class="checkout-form__cart-quantity"><?php echo $cart_item['quantity'] ?> шт</div>
								<div class="checkout-form__cart-price"><?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ) ?></div>
							</div>
							<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
							<?php 
							endif;
							endforeach;
							?>
						</div>

						<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

						<div id="order_review" class="woocommerce-checkout-review-order">
							<div class="checkout-form__group">
								<div class="checkout-form__group-title"><span class="checkout-form__group-title-number">3</span>Способ оплаты</div>
								<?php 
								if ( WC()->cart->needs_payment() ) {
								$available_gateways = WC()->payment_gateways()->get_available_payment_gateways();
								WC()->payment_gateways()->set_current_gateway( $available_gateways );
								} else {
								$available_gateways = array();
								}

								if ( WC()->cart->needs_payment() )  {
									if ( ! empty( $available_gateways ) ) {
									foreach ( $available_gateways as $gateway ) {
										wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
									}
									} else {
									echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) : esc_html__( 'Please fill in your details above to see available payment methods.', 'woocommerce' ) ) . '</li>'; // @codingStandardsIgnoreLine
									}
								} ?>
							</div>
							<div class="checkout-form__group">
								<div class="checkout-form__group-title"><span class="checkout-form__group-title-number">4</span>Способ получения</div>
								<?php do_action( 'woocommerce_checkout_order_review' ); ?>
								<?php $fields = $checkout->get_checkout_fields( 'billing' ); ?>
								<?php woocommerce_form_field( "billing_country", $fields["billing_country"], $checkout->get_value( "billing_country" ) ); ?>
								<?php woocommerce_form_field( "billing_state", $fields["billing_state"], $checkout->get_value( "billing_state" ) ); ?>
								<?php woocommerce_form_field( "billing_city", $fields["billing_city"], $checkout->get_value( "billing_city" ) ); ?>
								<?php woocommerce_form_field( "billing_address_1", $fields["billing_address_1"], $checkout->get_value( "billing_address_1" ) ); ?>
								<?php woocommerce_form_field( "billing_postcode", $fields["billing_postcode"], $checkout->get_value( "billing_postcode" ) ); ?>
								<div class="checkout__pickup hidden">
									<?= get_field('contact_address', 'options') ?>
								</div>
							</div>
						</div>

						<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
					</div>
				</div>
			</form>
			
		</div>
	</section>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
