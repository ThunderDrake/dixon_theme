<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
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

/** @global WC_Checkout $checkout */

?>
<div class="woocommerce-billing-fields">
	
	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>
	
	<?php $billing = $checkout->get_checkout_fields( 'billing' ); ?>
	<div class="checkout-block">
		<div class="checkout-block-header">Клиент</div>
		<div class="checkout-block-content">
			<?php

			/*
			if(isset($billing['billing_first_name']))
			{
				$key = 'billing_first_name';
				woocommerce_form_field( $key, $billing[$key], $checkout->get_value( $key ) );
			}

			if(isset($billing['billing_phone']))
			{
				$key = 'billing_phone';
				woocommerce_form_field( $key, $billing[$key], $checkout->get_value( $key ) );
			}

			if(isset($billing['billing_email']))
			{
				$key = 'billing_email';
				woocommerce_form_field( $key, $billing[$key], $checkout->get_value( $key ) );
			}
			*/
			foreach ( $billing as $key => $field ) {
				woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
			}

			?>
		</div>
	</div>
	<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>