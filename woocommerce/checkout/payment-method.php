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
	<input id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>" />

	<label for="payment_method_<?php echo esc_attr( $gateway->id ); ?>" title="<?=$gateway->get_title()?>">
		<?php
		$icon = $gateway->get_icon();
		if(!$icon)
		{
			echo $gateway->get_title();
		}
		else
		{
			echo $icon;
		}
		?>
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