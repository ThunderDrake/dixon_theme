<?php
/**
 * Output a single payment method
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment-method.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php
if(WC()->cart->needs_shipping() && WC()->cart->show_shipping() )
{
	$chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
	$chosen_shipping = $chosen_methods[0];
	$chosen_shipping = preg_split('/\:/', $chosen_shipping);
	$chosen_shipping = array_shift($chosen_shipping);

	$fields = $checkout->get_checkout_fields( 'shipping' );

?>
<div class="woocommerce-checkout-shipping-special">
	<?php
	# START RFMAIL
	if($chosen_shipping == 'rfmail')
	{
	?>
	<div class="fields-group-label">Получатель</div>
	<?php
		if(isset($fields['shipping_first_name']))
		{
			$key = 'shipping_first_name';
			woocommerce_form_field( $key, $fields[$key], $checkout->get_value( $key ) );
		}
	?>
	<div class="fields-group-label">Адрес</div>
	<?php
		if(isset($fields['shipping_postcode']))
		{
			$key = 'shipping_postcode';
			woocommerce_form_field( $key, $fields[$key], $checkout->get_value( $key ) );
		}
		if(isset($fields['shipping_address_1']))
		{
			$key = 'shipping_address_1';
			woocommerce_form_field( $key, $fields[$key], $checkout->get_value( $key ) );
		}
	}
	# END RFMAIL
	if($chosen_shipping == 'courier')
	{
		if(isset($fields['shipping_address_1']))
		{
			$key = 'shipping_address_1';
			woocommerce_form_field( $key, $fields[$key], $checkout->get_value( $key ) );
		}
	}
	if($chosen_shipping == 'local_pickup_extended')
	{
		if(isset($fields['shipping_address_1']))
		{
			$key = 'shipping_address_1';
			woocommerce_form_field( $key, $fields[$key], $checkout->get_value( $key ) );
		}
	}
	if($chosen_shipping == 'pickpoint')
	{
		if(isset($fields['shipping_address_1_selected']))
		{
			$key = 'shipping_address_1_selected';
			$val = $checkout->get_value( $key );
			woocommerce_form_field( $key, $fields[$key], '' );
		}
		if(isset($fields['shipping_address_1']))
		{
			$key = 'shipping_address_1';
			$val = $checkout->get_value( $key );
			woocommerce_form_field( $key, $fields[$key], $val );
		}
		?>
		<div class="shipping_address_1-text" id="shipping_address_1_text"></div>
		<button type="button" data-action="select-pickpoint">Выберите постамат</button>
		<div class="required-error">Выберите постамат</div>
		<?php
	}
	?>
</div>
<?php
}
?>