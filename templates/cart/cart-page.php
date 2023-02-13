<?php 
/**
 * The template for displaying the cart page.
 *
 * @package dixon_theme
 */
get_header(); 
?>

<?php //ct()->template( '/home-page/parts/home-page__hero.php' ) ?>
<main class="main" style="padding-top: var(--header-height);">
	<section class="cart">
		<div class="cart__container container">

			<div class="cart__header">
				<div class="cart__header-info">
					<a class="cart__header-link" href="#">Кредит</a>
					<a class="cart__header-link" href="#">Оплата и доставка</a>
				</div>
				<h1 class="cart__title h2-title">Корзина</h1>
				<div class="cart__nav">
					<div class="breadcrumbs">
						<a class="breadcrumbs__item" href="/">Главная</a>
						<span class="breadcrumbs__item breadcrumbs__item--active">Корзина</span>
					</div>
				</div>
			</div>
			<!-- /cart__header -->
			<?php do_action( 'woocommerce_before_cart' ); ?>

			<div class="cart__ajax-content">
				<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
					<?php do_action( 'woocommerce_before_cart_table' ); ?>
					<div class="cart__list cart__list--page" style="margin-bottom: 15px;">
						<div class="cart__list-header cart-grid cart-grid--header">
							<div class="cart__col-title">Товар:</div>
							<div class="cart__col-title">Количество:</div>
							<div class="cart__col-title">Цена:</div>
							<div class="cart__col-title"></div>
						</div>
						<?php do_action( 'woocommerce_before_cart_contents' ); ?>
						<div class="cart__list-content">
							<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ): ?>
								<?php
								$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
								$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
								if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ):
									$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
								?>
								<article class="woocommerce-cart-form__cart-item cart-grid__item cart-item cart-grid <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
									<div class="cart-grid__col">
										<div class="cart-item__image-wrapper">
											<img loading="lazy" src="<?= wp_get_attachment_image_url( $_product->get_image_id(), 'full' ) ?>" class="cart-item__image" width="120" height="150" alt="">
										</div>
										<a class="cart-item__title" href="<?= $_product->get_permalink() ?>"><?= $_product->get_title() ?></a>
									</div>
									<div class="cart-grid__col">
										<?php
										if ( $_product->is_sold_individually() ) {
											$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
										} else {
											$product_quantity = woocommerce_quantity_input(
												array(
													'input_name'   => "cart[{$cart_item_key}][qty]",
													'input_value'  => $cart_item['quantity'],
													'max_value'    => $_product->get_max_purchase_quantity(),
													'min_value'    => '0',
													'product_name' => $_product->get_name(),
												),
												$_product,
												false
											);
										}
										echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
										?>
									</div>
									<div class="cart-grid__col">
										<div class="cart-item__price">
											<?= $cart_item['data']-> get_price(); ?> Р.
										</div>
									</div>
									<div class="cart-grid__col">
										<div class="cart-item__delete">
											<a class="cart-item__delete-button" href="<?= esc_url( wc_get_cart_remove_url( $cart_item_key ) ) ?>" data-product_id="<?= esc_attr( $product_id ) ?>" data-product_sku="<?= esc_attr( $_product->get_sku() ) ?>" data-cart_item_key="<?= esc_attr( $cart_item_key ) ?>">
												<svg class="cart-item__delete-icon" width="20" height="24">
													<use xlink:href="#delete-icon"></use>
												</svg>
											</a>
										</div>
									</div>
								</article>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
						<?php do_action( 'woocommerce_after_cart_contents' ); ?>
					</div>
					<?php do_action( 'woocommerce_after_cart_table' ); ?>
					<?php do_action( 'woocommerce_after_cart' ); ?>
					<div class="cart__refresh-button-wrapper" style="margin: 0 0 50px auto; display: flex; justify-content: flex-end;">
						<button type="submit" class="cart__refresh btn-reset cart__button-to-cart" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>" style="width: auto; padding: 10px 20px; height: 55px;"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
					</div>
				
					<?php do_action( 'woocommerce_cart_actions' ); ?>
					<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
				</form>
				<div class="cart__footer">
					<!-- <div class="cart__coupon">
						<form class="cart__coupon-form">
							<input class="cart__coupon-input" type="text" placeholder="Ваш промокод">
							<button class="cart__coupon-button btn-reset btn btn--main">применить промокод</button>
						</form>
					</div> -->
					<div class="cart__info">
						<div class="cart__info-text">
							<?php if(WC()->cart->get_cart_contents_count()!=0): ?>
								<div class="cart__total">
									Итого <?= WC()->cart->get_cart_contents_count() ?> товара
								</div>
							<?php endif; ?>
							<div class="cart__total-amount"><?php echo WC()->cart->get_cart_subtotal(); ?></div>
						</div>
						<a class="cart__checkout-btn btn-reset btn btn--main" href="/checkout/">Оформить покупку</a>
					</div>
				</div>
			</div>
		</div>
	</section>

</main>
<?php get_footer(); ?>