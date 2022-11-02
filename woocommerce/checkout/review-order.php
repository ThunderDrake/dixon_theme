<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
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
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$thumb_size = [60,60];
$count = WC()->cart->get_cart_contents_count();
?>
<div class="shop_table woocommerce-checkout-review-order-table">
	<div class="products">
		<?php /*
			do_action( 'woocommerce_review_order_before_cart_contents' );

			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item )
			{
				$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

				if($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key))
				{
		?>
		<div class="products-product">
			<div class="product-image">
				<?php
					$image = get_thumb($_product->get_id(),$thumb_size,true);
					if(!$image)
					{
						$image = wc_placeholder_img( 'woocommerce_thumbnail' );
					}
					echo $image;
				?>
			</div>
			<div class="product-info">
				<div class="product-name">
					<?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;'; ?>
					<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
				</div>
				<div class="product-total">
					<div class="product-price"><?php echo WC()->cart->get_product_price( $_product ); ?> / шт.</div>
					<div class="product-quantity"><?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', sprintf( '%s шт.', $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?></div>
					<div class="product-subtotal"><?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?></div>
				</div>
			</div>
		</div>
		<?php
				}
			}

			do_action( 'woocommerce_review_order_after_cart_contents' );
		?>
	</div>
	<div class="totals">

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

		<?php do_action( 'woocommerce_review_order_after_order_total' ); */?>
		<div class="count__items"><?=$count?> <?=plural_form($count,['товар','товара','товаров'])?><span><?php wc_cart_totals_subtotal_html(); ?></span></div>
		<div class="total">К оплате: <span><?php wc_cart_totals_subtotal_html(); ?></span></div>
		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</div>
</div>
