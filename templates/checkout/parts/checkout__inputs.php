<?php 
$checkout = WC()->checkout();
$fields = $checkout->get_checkout_fields( 'billing' );
?>
<div class="checkout__form-wrapper">

	<div class="checkout-form__group">
		<div class="checkout-form__group-title"><span class="checkout-form__group-title-number">1</span>Ваши данные</div>
		<?php woocommerce_form_field( "billing_first_name", $fields["billing_first_name"], $checkout->get_value( "billing_first_name" ) ); ?>
		<?php woocommerce_form_field( "billing_last_name", $fields["billing_last_name"], $checkout->get_value( "billing_last_name" ) ); ?>
		<?php woocommerce_form_field( "billing_phone", $fields["billing_phone"], $checkout->get_value( "billing_phone" ) ); ?>
	</div>
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
			<a class="checkout-form__cart-title" href="<?= $_product->get_permalink() ?>"><?php echo $_product->get_title() ?></a>
			<div class="checkout-form__cart-quantity"><?php echo $cart_item['quantity'] ?> шт</div>
			<div class="checkout-form__cart-price"><?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ) ?></div>
		</div>
		<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
        <?php 
          endif;
		endforeach;
        ?>
	</div>
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
					<div class="checkout-form__shipping-wrapper">
						<?php
							printf( '<label class="custom-checkbox checkout-form__radio" for="shipping_method_%1$s_%2$s">', $i, esc_attr( sanitize_title( $method->id ) ) ); // WPCS: XSS ok.
								if ( 1 < count( $package['rates'] ) ) {
								printf( '<input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="custom-checkbox__field" %4$s />', $i, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ), checked( $method->id, $chosen_method, false ) ); // WPCS: XSS ok.
								} else {
								printf( '<input type="hidden" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" />', $i, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ) ); // WPCS: XSS ok.
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
				<?php endforeach; ?>
				<?php
			
				$first = false;
			} 
		?>
		<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
		<?php woocommerce_form_field( "billing_country", $fields["billing_country"], $checkout->get_value( "billing_country" ) ); ?>
		<?php woocommerce_form_field( "billing_state", $fields["billing_state"], $checkout->get_value( "billing_state" ) ); ?>
		<?php woocommerce_form_field( "billing_postcode", $fields["billing_postcode"], $checkout->get_value( "billing_postcode" ) ); ?>
		<?php woocommerce_form_field( "billing_city", $fields["billing_city"], $checkout->get_value( "billing_city" ) ); ?>
		<?php woocommerce_form_field( "billing_address_1", $fields["billing_address_1"], $checkout->get_value( "billing_address_1" ) ); ?>
	</div>

</div>
