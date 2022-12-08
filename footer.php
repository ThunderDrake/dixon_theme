<?php
$address = get_field('contact_address', 'option');
$work_time = get_field('contact_work_time', 'option');
$phone = get_field('contact_phone', 'option');
$phone_service = get_field('contact_phone_service', 'option');
$email = get_field('contact_email', 'option');
$vk = get_field('contact_vk_link', 'option');
$tg = get_field('contact_tg_link', 'option');
$viber = get_field('contact_viber_link', 'option');
$whatsapp = get_field('contact_whatsapp_link', 'option');
?>
<div class="graph-modal">
  <div class="graph-modal__container" role="dialog" aria-modal="true" data-graph-target="cart">
    <button class="btn-reset js-modal-close graph-modal__close" aria-label="Закрыть модальное окно"></button>
    <div class="graph-modal__content modal__cart">
	  <div class="modal__cart-title h2-title">Корзина покупок</div>
      <div class="cart__list cart__list--modal">
        <div class="cart__list-content">
		<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ): ?>
			<?php 
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ):
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
			?>
          <article class="cart-grid__item cart-item cart-grid">

            <div class="cart-grid__col">
              <div class="cart-item__image-wrapper">
                <img loading="lazy" src="<?= wp_get_attachment_image_url( $_product->get_image_id(), 'full' ) ?>" class="cart-item__image" width="120" height="150" alt="">
              </div>
            </div>

            <div class="cart-grid__col">
              <div class="cart-item__title"><?= $_product->get_title() ?></div>
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
					<a class="cart-item__delete-button" href="<?= esc_url( wc_get_cart_remove_url( $cart_item_key ) ) ?>" data-product_id="<?= esc_attr( $product_id ) ?>" data-product_sku="<?= esc_attr( $_product->get_sku() ) ?>">
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
		<?php 
		
		if(WC()->cart->get_cart()):
		?>
			<div class="cart__footer">
				<div class="cart__button">
					<a class="cart__button-to-cart" href="/cart/">Просмотр корзины</a>
				</div>
				<div class="cart__info">
					<div class="cart__info-text">
						<div class="cart__total">
							Итого <?= WC()->cart->get_cart_contents_count() ?> товара
						</div>
						<div class="cart__total-amount"><?= WC()->cart->get_cart_subtotal() ?> Р.</div>
					</div>
					<a class="cart__checkout-btn btn-reset btn btn--main" href="/checkout/">Оформить покупку</a>
				</div>
			</div>
		<?php else: ?>
			<p class="modal__cart-empty" style="margin: 0; font-size: 18px;">Ваша корзина пуста</p>
		<?php endif; ?>
      </div>
    </div>
  </div>
</div>
<footer class="footer">
  <div class="footer__container container">
    <div class="footer__logo logo">
      <img loading="lazy" src="<?= ct()->get_static_url() ?>/img/logo.png" class="footer__logo-image" width="230" height="63" alt="Dixon">
    </div>
    <div class="footer__nav">
      <div class="footer__col footer__col--first">
        <div class="footer__col-title">Магазин</div>
        <ul class="footer__col-list list-reset">
          <li class="footer__col-item">
            <a class="footer__col-link" href="/catalog/telefony/">Телефоны</a>
          </li>
          <li class="footer__col-item">
            <a class="footer__col-link" href="/catalog/accessories/">Аксессуары</a>
          </li>
		 	 <?php 
			$terms = get_terms( [
				'taxonomy' => 'product_tag',
				'hide_empty' => true,
			] );
			?>
			<?php foreach($terms as $term): ?>
			<li class="footer__col-item">
				<a class="footer__col-link" href="/tag/<?= $term->slug ?>/"><?= $term->name ?></a>
			</li>
			<?php endforeach; ?>
        </ul>
      </div>
      <div class="footer__col footer__col--second">
        <div class="footer__col-title">Услуги</div>
        <ul class="footer__col-list list-reset">
          <li class="footer__col-item">
            <a class="footer__col-link" href="/repair/">Сдать в ремонт</a>
          </li>
          <li class="footer__col-item">
            <a class="footer__col-link" href="/work-status/">Статус ремонта</a>
          </li>
          <li class="footer__col-item">
            <a class="footer__col-link" href="/pricelist/">Стоимость ремонта</a>
          </li>
        </ul>
      </div>
      <div class="footer__col footer__col--third">
        <div class="footer__col-title">Для клиента</div>
        <ul class="footer__col-list list-reset">
          <li class="footer__col-item">
            <a class="footer__col-link" href="/sbosoby-oplaty/">Доставка и оплата</a>
          </li>
          <li class="footer__col-item">
            <a class="footer__col-link" href="/o-kompanii/">О компании</a>
          </li>
          <li class="footer__col-item">
            <a class="footer__col-link" href="/kontakty/">Контакты</a>
          </li>
          <li class="footer__col-item">
            <a class="footer__col-link" href="/oformit-v-kredit/">Оформление в кредит</a>
          </li>
          <li class="footer__col-item">
            <a class="footer__col-link" href="/vacancy/">Вакансии</a>
          </li>
          <li class="footer__col-item">
            <a class="footer__col-link" href="<?= get_privacy_policy_url() ?>">Политика конфиденциальности</a>
          </li>
          <li class="footer__col-item">
            <a class="footer__col-link" href="/offer/">Договор оферты</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="footer__contacts">
      <div class="footer__contacts-phone phone-number">
        <a class="phone-number__link" href="tel:<?= str_replace([' ', '(', ')', '-'], '', $phone) ?>">
          <svg class="phone-number__icon" width="18" height="18">
            <use xlink:href="#phone"></use>
          </svg>
          <?= $phone ?>
        </a>
        <span class="phone-number__text">Менеджер по продажам</span>
      </div>
      <div class="footer__contacts-phone phone-number">
        <a class="phone-number__link" href="tel:<?= str_replace([' ', '(', ')', '-'], '', $phone_service) ?>">
          <svg class="phone-number__icon" width="18" height="18">
            <use xlink:href="#phone"></use>
          </svg>
          <?= $phone_service ?>
        </a>
        <span class="phone-number__text">Ремонт и сервис</span>
      </div>

      <div class="contacts__socials contacts__socials--footer">
        <a class="contacts__socials-link" href="<?= $vk ?>">
          <svg class="contacts__socials-icon" width="30" height="30">
            <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#vk-icon"></use>
          </svg>
        </a>
        <a class="contacts__socials-link" href="<?= $tg ?>">
          <svg class="contacts__socials-icon" width="30" height="30">
            <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#tg-icon"></use>
          </svg>
        </a>
        <a class="contacts__socials-link" href="<?= $viber ?>">
          <svg class="contacts__socials-icon" width="30" height="30">
            <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#viber-icon"></use>
          </svg>
        </a>
        <a class="contacts__socials-link" href="<?= $whatsapp ?>">
          <svg class="contacts__socials-icon" width="30" height="30">
            <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#whatsapp-icon"></use>
          </svg>
        </a>
      </div>
    </div>
  </div>
</footer>
	<?php wp_footer(); ?>
	<script>
	jQuery(document).ready(function(){
		jQuery('.cart').find('button[name="update_cart"]').prop('disabled', false);

		jQuery('body').on('updated_cart_totals', function() {
			jQuery('.woocommerce-cart').find('button[name="update_cart"]').prop('disabled', false);

		})
	});
	</script>
  </div>
</body>

</html>