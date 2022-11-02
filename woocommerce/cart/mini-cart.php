<?php
/**
 * Header Cart
 *
 * Contains the markup for the header-cart, used by the cart widget.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$count = WC()->cart->get_cart_contents_count();
$id = get_the_ID();
?>
<div class="cart-content <?php if($id == 31){ ?> active-card <?php }?>" id="cart-content-fragment">
	<?php /*
	<div class="line">
		<div class="value"><?=$count?></div>
		<div class="label"><?=plural_form($count,['товар','товара','товаров'])?></div>
	</div>
	*/ ?>
	<div class="line">
		<div class="cart-icon">
			<img src="<?=asset('/images/cart.png')?>" alt="">
		</div>
		<?php /* <div class="label">сумма</div> */ ?>
		<div class="value"><?=WC()->cart->get_cart_subtotal()?></div>
	</div>
</div>