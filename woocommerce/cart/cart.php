<?php
defined( 'ABSPATH' ) || exit;
global $GS;
$count = WC()->cart->get_cart_contents_count();
do_action( 'woocommerce_before_cart' );
?>
<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>
	<table class="cart-table woocommerce-cart-form__contents" cellspacing="0">
<!-- 		<thead>
			<tr>
				<th class="product-thumbnail">&nbsp;</th>
				<th class="product-name">Товар</th>
				<th class="product-price">Цена</th>
				<th class="product-quantity">Количество</th>
				<th class="product-subtotal">Итого</th>
				<th class="product-remove">&nbsp;</th>
			</tr>
		</thead> -->
		<tbody>
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			$cart_delete = $GS->inline('/assets/svg/cart-delete.svg',false);
			foreach(WC()->cart->get_cart() as $key => $item)
			{
				wc_get_template('cart/cart-table-item.php',['key'=>$key,'item'=>$item,'cart_delete'=>$cart_delete]);
			}
			?>

		</tbody>
	</table>
	<div class="checkout__block">
		<div class="checkout__title">
			<img src="<?php echo get_template_directory_uri();?>/assets/images/shopping-cart.png" alt="">
			Ваш заказ
		</div>
		<?php do_action( 'woocommerce_cart_contents' ); ?>
		<div class="count__items"><?=$count?><span><?php wc_cart_totals_subtotal_html(); ?></span></div>
		<div class="total">К оплате: <span><?php wc_cart_totals_subtotal_html(); ?></span></div>
		<div class="flexed">
			<button type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

			<?php do_action( 'woocommerce_cart_actions' ); ?>

			<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>

			<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
		</div>
		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</div>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>
<?php
#<div class="cart-collaterals">
	/**
	 * Cart collaterals hook.
	 *
	 * @hooked woocommerce_cross_sell_display
	 * @hooked woocommerce_cart_totals - 10
	 */
	#do_action( 'woocommerce_cart_collaterals' );
#</div>
?>
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
	jQuery('div.woocommerce').on('change', 'input.qty', function(){ 
		jQuery("[name='update_cart']").trigger("click"); 
	});
});
</script>
<?php do_action( 'woocommerce_after_cart' ); ?>