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

<div class="wc_payment_method payment_method_<?php echo esc_attr( $gateway->id ); ?> update_totals_on_change">
	<label class="custom-checkbox checkout-form__radio" for="payment_method_<?php echo esc_attr( $gateway->id ); ?>" title="<?=$gateway->get_title()?>">
		<input id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" type="radio" class="custom-checkbox__field" name="payment_method" data-shipping="<?=$gateway->get_title()?>" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>">
		<span class="custom-checkbox__content"><?php echo $gateway->get_title(); ?></span>
	</label>
	<?php
	if($gateway->has_fields())
	{
	?>
	<div class="payment_box payment_method_<?php echo esc_attr( $gateway->id ); ?>"<?php if(!$gateway->chosen){ ?> style="display:none;"<?php } ?>>
		<?php $gateway->payment_fields(); ?>
	</div>
	<?php
	}
	?>
</div>
