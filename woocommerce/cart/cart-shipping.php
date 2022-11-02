<?php
/**
 * Shipping Methods Display
 *
 * In 2.1 we show methods per package. This allows for multiple methods per order if so desired.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-shipping.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

$formatted_destination    = isset( $formatted_destination ) ? $formatted_destination : WC()->countries->get_formatted_address( $package['destination'], ', ' );
$has_calculated_shipping  = ! empty( $has_calculated_shipping );
$show_shipping_calculator = ! empty( $show_shipping_calculator );
$calculator_text          = '';

if($available_methods)
{
?>
<div class="woocommerce-shipping-methods">
	<?php
	foreach($available_methods as $method)
	{
	?>
	<div class="shipping-method">
		<?php
		printf('<input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" %4$s />', $index, esc_attr(sanitize_title($method->id)), esc_attr($method->id), checked($method->id, $chosen_method, false));
		printf('<label for="shipping_method_%1$s_%2$s">%3$s</label>', $index, esc_attr(sanitize_title($method->id)), wc_cart_totals_shipping_method_label($method));
		do_action('woocommerce_after_shipping_rate', $method, $index);
		?>
	</div>
	<?php
	} # foreach($available_methods as $method)
	?>
</div>
<?php
}
elseif(!$has_calculated_shipping || !$formatted_destination)
{
?>
	<p class="no-shipping-methods"><?php esc_html_e( 'Enter your address to view shipping options.', 'woocommerce' ); ?></p>
<?php
}
elseif(!is_cart())
{
?>
	<p class="no-shipping-methods"><?php echo wp_kses_post( apply_filters( 'woocommerce_no_shipping_available_html', __( 'There are no shipping methods available. Please ensure that your address has been entered correctly, or contact us if you need any help.', 'woocommerce' ) ) ); ?></p>
<?php
}
else
{
	echo wp_kses_post( apply_filters( 'woocommerce_cart_no_shipping_available_html', sprintf( esc_html__( 'No shipping options were found for %s.', 'woocommerce' ) . ' ', '<strong>' . esc_html( $formatted_destination ) . '</strong>' ) ) );
	$calculator_text = __( 'Enter a different address', 'woocommerce' );
}
?>

<?php if ( $show_package_details ) : ?>
	<?php echo '<p class="woocommerce-shipping-contents"><small>' . esc_html( $package_details ) . '</small></p>'; ?>
<?php endif; ?>

<?php if ( $show_shipping_calculator ) : ?>
	<?php woocommerce_shipping_calculator( $calculator_text ); ?>
<?php endif; ?>