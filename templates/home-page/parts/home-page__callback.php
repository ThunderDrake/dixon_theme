<section class="callback">
  <div class="callback__container container">
    <form class="callback__form form" action="POST">
      <h2 class="form__title">Оставить заявку на ремонт</h2>
      <span class="form__subtitle">Оставьте свои данные и наш менеджер свяжется с вами в течении 15 минут.</span>
      <label class="form__field form__field--name" for="form_name">
        <svg class="form__field-icon" width="26" height="26">
          <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#name-input-icon"></use>
        </svg>
        <input class="form__input" type="text" name="form_name" placeholder="Введите ваше имя">
      </label>
      <label class="form__field form__field--tel" for="form_phone">
        <svg class="form__field-icon" width="26" height="26">
          <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#phone-input-icon"></use>
        </svg>
        <input class="form__input" type="tel" name="form_phone" placeholder="Введите ваш телефон">
      </label>
      <button class="btn btn--main form__button btn-reset">Оставить заявку</button>
      <label class="custom-checkbox form__policy">
        <input type="checkbox" name="form_policy" class="custom-checkbox__field">
        <span class="custom-checkbox__content">Согласен на обработку <a href="#">персональных данных</a></span>
      </label>
    </form>
    <img loading="lazy" src="<?= ct()->get_static_url() ?>/img/callback-section-human.png" class="callback__human-image" width="1040" height="950" alt="Веселый мужчина показывает палец вверх" aria-hidden="true">
  </div>
</section>