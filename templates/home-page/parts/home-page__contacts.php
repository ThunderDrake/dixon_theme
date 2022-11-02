<section class="contacts">
  <div class="contacts__container container">
    <h2 class="contacts__title h2-title">Контакты</h2>
    <div class="contacts__content">
      <div class="contacts__info">
        <address class="contacts__text">Адрес: Чебоксары, ул. Калинина, 91 к1</address>
        <p class="contacts__text">График работы:</p>
        <p class="contacts__text">Телефон: <a class="contacts__phone" href="tel:+7352364202">+7 (352) 36-42-02</a></p>
        <p class="contacts__text">Эл. почта: <a class="contacts__mail" href="mailto:noname@mail.ru">noname@mail.ru</a></p>
        <div class="contacts__socials">
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
      <div class="contacts__map">
        <img loading="lazy" src="<?= ct()->get_static_url() ?>/img/contacts__map.jpg" class="contacts__map-image" width="860" height="535" alt="Карта проезда до нашего офиса">
      </div>
    </div>

  </div>
</section>