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
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;
?>

	<div class="shop_table woocommerce-checkout-review-order-table" style="position: static !important;">
		<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>
		<?php 
			WC()->cart->calculate_shipping();
			$packages = WC()->shipping()->get_packages();
			$first    = true;
			foreach ( $packages as $i => $package ) {
				$chosen_method = isset( WC()->session->chosen_shipping_methods[ $i ] ) ? WC()->session->chosen_shipping_methods[ $i ] : '';
				$product_names = array();
			
				if ( count( $packages ) > 1 ) {
				foreach ( $package['contents'] as $item_id => $values ) {
					$product_names[ $item_id ] = $values['data']->get_name() . ' &times;' . $values['quantity'];
				}
				$product_names = apply_filters( 'woocommerce_shipping_package_details_array', $product_names, $package );
				}
				$formatted_destination    = isset( $formatted_destination ) ? $formatted_destination : WC()->countries->get_formatted_address( $package['destination'], ', ' );
				$has_calculated_shipping  = ! empty( $has_calculated_shipping );
				$show_shipping_calculator = ! empty( $show_shipping_calculator );
				$calculator_text          = '';

				?>
				<?php foreach ( $package['rates'] as $method ) : ?>
					<?php if( count( $package['rates'] ) > 1): ?>
						<?php if('local_pickup' !== $method->method_id): ?>
						<div class="checkout-form__shipping-wrapper">
							<?php
								printf( '<label class="custom-checkbox checkout-form__radio" for="shipping_method_%1$s_%2$s">', $i, esc_attr( sanitize_title( $method->id ) ) ); // WPCS: XSS ok.
									if ( 1 < count( $package['rates'] ) ) {
									printf( '<input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="custom-checkbox__field" %4$s />', $i, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ), checked( $method->id, $chosen_method, false ) ); // WPCS: XSS ok.
									} else {
										printf( '<input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="custom-checkbox__field" %4$s />', $i, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ), checked( $method->id, $chosen_method, false ) ); // WPCS: XSS ok.
									}
								printf('<span class="custom-checkbox__content">%1$s</span>', wc_cart_totals_shipping_method_label( $method ));
								printf( '</label>' ); // WPCS: XSS ok.
								printf('<div class="checkout-form__shipping-popup">');
									if('rpaefw_post_calc:5' === $method->id){
									printf('<img loading="lazy" src="'.get_template_directory_uri().'/static/img/cart/delivery-pochta.svg" class="checkout-form__shipping-logo" width="200" height="auto" alt="Доставка Почтой России">');
									} else {
									printf('<img loading="lazy" src="'.get_template_directory_uri().'/static/img/cart/delivery-cdek.svg" class="checkout-form__shipping-logo" width="200" height="auto" alt="Доставка Почтой России">');
									}
									printf('<div class="checkout-form__shipping-info">');
										printf('<div class="checkout-form__shipping-price">от %1$s Р</div>', $method->get_cost() );
									printf('</div>');
								printf('</div>');
								do_action( 'woocommerce_after_shipping_rate', $method, $i );
							?>
						</div>
						<?php endif; ?>
					<?php else: ?>
						<?php if('local_pickup' === $method->method_id): ?>
						<div class="checkout-form__shipping-wrapper hidden">
							<?php
								printf( '<label class="custom-checkbox checkout-form__radio" for="shipping_method_%1$s_%2$s">', $i, esc_attr( sanitize_title( $method->id ) ) ); // WPCS: XSS ok.
									if ( 1 < count( $package['rates'] ) ) {
									printf( '<input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="custom-checkbox__field" %4$s />', $i, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ), checked( $method->id, $chosen_method, false ) ); // WPCS: XSS ok.
									} else {
										printf( '<input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="custom-checkbox__field" %4$s />', $i, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ), checked( $method->id, $chosen_method, false ) ); // WPCS: XSS ok.
									}
								printf('<span class="custom-checkbox__content">%1$s</span>', wc_cart_totals_shipping_method_label( $method ));
								printf( '</label>' ); // WPCS: XSS ok.
								printf('<div class="checkout-form__shipping-popup">');
									if('rpaefw_post_calc:5' === $method->id){
									printf('<img loading="lazy" src="'.get_template_directory_uri().'/static/img/cart/delivery-pochta.svg" class="checkout-form__shipping-logo" width="200" height="auto" alt="Доставка Почтой России">');
									} else {
									printf('<img loading="lazy" src="'.get_template_directory_uri().'/static/img/cart/delivery-cdek.svg" class="checkout-form__shipping-logo" width="200" height="auto" alt="Доставка Почтой России">');
									}
									printf('<div class="checkout-form__shipping-info">');
										printf('<div class="checkout-form__shipping-price">от %1$s Р</div>', $method->get_cost() );
									printf('</div>');
								printf('</div>');
								do_action( 'woocommerce_after_shipping_rate', $method, $i );
							?>
						</div>
						<?php endif; ?>
					<?php endif; ?>
				<?php endforeach; ?>
				<?php
			
				$first = false;
			} 
		?>
		<?php ct()->template( '/checkout/parts/checkout__total.php' ) ?>
		<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
	</div>
	