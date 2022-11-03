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
            <a class="footer__col-link" href="#">Телефоны</a>
          </li>
          <li class="footer__col-item">
            <a class="footer__col-link" href="#">Хиты продаж</a>
          </li>
          <li class="footer__col-item">
            <a class="footer__col-link" href="#">Акции</a>
          </li>
          <li class="footer__col-item">
            <a class="footer__col-link" href="#">Новинки</a>
          </li>
          <li class="footer__col-item">
            <a class="footer__col-link" href="#">Распродажа</a>
          </li>
        </ul>
      </div>
      <div class="footer__col footer__col--second">
        <div class="footer__col-title">Услуги</div>
        <ul class="footer__col-list list-reset">
          <li class="footer__col-item">
            <a class="footer__col-link" href="#">Сдать в ремонт</a>
          </li>
          <li class="footer__col-item">
            <a class="footer__col-link" href="#">Статус ремонта</a>
          </li>
          <li class="footer__col-item">
            <a class="footer__col-link" href="#">Стоимость ремонта</a>
          </li>
        </ul>
      </div>
      <div class="footer__col footer__col--third">
        <div class="footer__col-title">Для клиента</div>
        <ul class="footer__col-list list-reset">
          <li class="footer__col-item">
            <a class="footer__col-link" href="#">Доставка и оплата</a>
          </li>
          <li class="footer__col-item">
            <a class="footer__col-link" href="#">О компании</a>
          </li>
          <li class="footer__col-item">
            <a class="footer__col-link" href="#">Контакты</a>
          </li>
          <li class="footer__col-item">
            <a class="footer__col-link" href="#">Оформление в кредит</a>
          </li>
          <li class="footer__col-item">
            <a class="footer__col-link" href="#">Вакансии</a>
          </li>
          <li class="footer__col-item footer__col-item--add">
            <a class="footer__col-link" href="#">Политика конфиденциальности</a>
          </li>
          <li class="footer__col-item footer__col-item--add">
            <a class="footer__col-link" href="#">Договор оферты</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="footer__contacts">
      <div class="footer__contacts-phone phone-number">
        <a class="phone-number__link" href="tel:+78352600010">
          <svg class="phone-number__icon" width="18" height="18">
            <use xlink:href="#phone"></use>
          </svg>
          +7 (83-52) 60-00-10
        </a>
        <span class="phone-number__text">Менеджер по продажам</span>
      </div>
      <div class="footer__contacts-phone phone-number">
        <a class="phone-number__link" href="tel:+78352600010">
          <svg class="phone-number__icon" width="18" height="18">
            <use xlink:href="#phone"></use>
          </svg>
          +7 (83-52) 60-00-10
        </a>
        <span class="phone-number__text">Менеджер по продажам</span>
      </div>

      <div class="contacts__socials contacts__socials--footer">
        <a class="contacts__socials-link" href="#">
          <svg class="contacts__socials-icon" width="30" height="30">
            <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#vk-icon"></use>
          </svg>
        </a>
        <a class="contacts__socials-link" href="#">
          <svg class="contacts__socials-icon" width="30" height="30">
            <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#tg-icon"></use>
          </svg>
        </a>
        <a class="contacts__socials-link" href="#">
          <svg class="contacts__socials-icon" width="30" height="30">
            <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#viber-icon"></use>
          </svg>
        </a>
        <a class="contacts__socials-link" href="#">
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