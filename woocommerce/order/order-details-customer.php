<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;

$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>
<div class="checkout-block">
	<div class="checkout-block-header">Контактные данные</div>
	<div class="checkout-block-content">
		<table class="order-info">
			<tr>
				<td>Имя</td>
				<td><?php echo wp_kses_post( $order->get_formatted_billing_address( esc_html__( 'N/A', 'woocommerce' ) ) ); ?></td>
			</tr>
			<?php if ( $order->get_billing_phone() ) : ?>
			<tr>
				<td>Телефон</td>
				<td><?php echo esc_html( $order->get_billing_phone() ); ?></td>
			<?php endif; ?>
			</tr>
			<?php if ( $order->get_billing_email() ) : ?>
			<tr>
				<td>E-mail</td>
				<td><?php echo esc_html( $order->get_billing_email() ); ?></td>
			</tr>
			<?php endif; ?>
			<?php if ( $show_shipping ) : ?>
			<tr>
				<td>Адрес</td>
				<td><?php echo wp_kses_post( $order->get_formatted_shipping_address( esc_html__( 'N/A', 'woocommerce' ) ) ); ?></td>
			</tr>
			<?php endif; ?>
		</table>
		<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>
	</div>
</div>