<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="woocommerce-order">
	<?php
	if($order)
	{
		$show_customer_details = true;//is_user_logged_in() && $order->get_user_id() === get_current_user_id();
		if($order->has_status('failed'))
		{
	?>
	<h1 class="page-title"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></h1>
	<div class="white-holder">
		<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
			<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'woocommerce' ) ?></a>
			<?php if ( is_user_logged_in() ) : ?>
				<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'My account', 'woocommerce' ); ?></a>
			<?php endif; ?>
		</p>
	</div>
	<?php
		}
		else
		{
	?>
	<h1 class="page-title"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), $order ); ?></h1>
	<div class="white-holder">
		<div class="row">
			<div class="col-xs-12 col-md-6">
				<div class="checkout-block">
					<div class="checkout-block-header">Информация о заказе</div>
					<div class="checkout-block-content">
						<table class="order-info">
							<tr>
								<td><?php _e( 'Order number:', 'woocommerce' ); ?></td>
								<td><?php echo $order->get_order_number(); ?></td>
							</tr>
							<tr>
								<td><?php _e( 'Date:', 'woocommerce' ); ?></td>
								<td><?php echo wc_format_datetime( $order->get_date_created() ); ?></td>
							</tr>
							<?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
							<tr>
								<td><?php _e( 'Email:', 'woocommerce' ); ?></td>
								<td><?php echo $order->get_billing_email(); ?></td>
							</tr>
							<?php endif; ?>
							<tr>
								<td><?php _e( 'Total:', 'woocommerce' ); ?></td>
								<td><?php echo $order->get_formatted_order_total(); ?></td>
							</tr>
							<?php if ( $order->get_payment_method_title() ) : ?>
							<tr>
								<td><?php _e( 'Payment method:', 'woocommerce' ); ?></td>
								<td><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></td>
							</tr>
							<?php endif; ?>
						</table>
					</div>
				</div>
				<?php
					do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() );
				?>

				<?php
					if ( $show_customer_details ) {
						wc_get_template( 'order/order-details-customer.php', array( 'order' => $order ) );
					}
				?>
			</div>
			<div class="col-xs-12 col-md-6">
				<?php 
					do_action( 'woocommerce_thankyou', $order->get_id() );
				?>
			</div>
		</div>
	</div>
	<?php
	}
}
else
{
?>
<h1 class="page-title"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></h1>
<?php
}
?>