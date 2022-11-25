<noscript>
<?php
/* translators: $1 and $2 opening and closing emphasis tags respectively */
printf( esc_html__( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ), '<em>', '</em>' );
?>
<br/><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>"><?php esc_html_e( 'Update totals', 'woocommerce' ); ?></button>
</noscript>
<?php 
$current_shipping_cost = WC()->cart->get_cart_shipping_total(); 
$current_quantity = WC()->cart->get_cart_contents_count(); 
$cart_subtotal = WC()->cart->get_cart_subtotal();
$cart_total = WC()->cart->get_total();
?>
<div class="checkout__total">
	<div class="checkout__total-title">Ваш заказ</div>
	<div class="checkout__total-table">
		<div class="checkout__total-row">
			<div class="checkout__total-position"><?php echo $current_quantity ?> товара на</div>
			<div class="checkout__total-value"><?php echo $cart_subtotal; ?> Р.</div>
		</div>
		<div class="checkout__total-row">
			<div class="checkout__total-position">Доставка</div>
			<div class="checkout__total-value"><?php echo $current_shipping_cost ?></div>
		</div>
	</div>
	<div class="checkout__total-row checkout__amount">
		<div class="checkout__total-position">Всего к оплате</div>
		<div class="checkout__total-value"><?php echo $cart_total; ?> Р.</div>
	</div>
	<?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="btn btn-reset btn--main checkout__submit" name="woocommerce_checkout_place_order" id="place_order" value="Оформить покупку" data-value="Оформить покупку">Оформить покупку</button>' ); ?>
	<label class="custom-checkbox checkout__policy">
		<input type="checkbox" class="custom-checkbox__field">
		<span class="custom-checkbox__content">Подтверждая заказ, я принимаю условия <a href="<?= get_privacy_policy_url() ?>">Пользовательского соглашения</a></span>
	</label>
	<?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
</div>