<?php
$product = wc_get_product( get_the_ID() );

?>

<?php if($product->is_type('variable')): ?>
<div class="product__cart-button-wrapper">
	<button class="product__cart-button product-card__button btn btn-reset btn--main" href="#">В корзину
		<svg class="product-card__button-icon">
			<use xlink:href="#cart-icon"></use>
		</svg>
	</button>
	<a class="product__cart-link" href="/cart/">Перейти в корзину</a>
</div>
<?php else: 
	if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post"
		enctype='multipart/form-data'>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>"
			class="product__cart-button product-card__button btn btn-reset btn--main single_add_to_cart_button button alt">В корзину
			<svg class="product-card__button-icon">
				<use xlink:href="#cart-icon"></use>
			</svg>
		</button>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

	<?php endif; ?>

<?php endif; ?>