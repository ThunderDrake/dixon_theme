<?php 
/**
 * The template for displaying the callback page.
 *
 * @package dixon_theme
 */
get_header();
?>
<main class="main">
	<section class="callback callback-page">
		<div class="callback__container container">
			<form class="callback__form form" id="callback_form">
				<h2 class="form__title">Оставить заявку на ремонт</h2>
				<span class="form__subtitle">Оставьте свои данные и наш менеджер свяжется с вами в течении 15 минут.</span>
				<label class="form__field form__field--name" for="form_name">
					<svg class="form__field-icon" width="26" height="26">
						<use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#name-input-icon"></use>
					</svg>
					<input class="form__input form__input--name" type="text" name="form_name" placeholder="Введите ваше имя">
				</label>
				<label class="form__field form__field--tel" for="form_phone">
					<svg class="form__field-icon" width="26" height="26">
						<use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#phone-input-icon"></use>
					</svg>
					<input class="form__input form__input--phone" type="tel" name="form_phone" placeholder="Введите ваш телефон">
				</label>
				<label class="form__field form__field--model" for="form_model">
					<input class="form__input form__input--no-padding form__input--model" type="text" name="form_model" placeholder="Модель IMEI телефона">
				</label>
				<input type="checkbox" name="art_anticheck" id="art_anticheck" class="art_anticheck" style="display: none !important;" value="true" checked="checked"/>
				<input type="text" name="art_submitted" id="art_submitted" value="" style="display: none !important;"/>
				<label class="form__field form__field--message" for="form_message">
					<input class="form__input form__input--no-padding form__input--message" type="text" name="form_message" placeholder="Какая у вас неисправность">
				</label>
				<button class="btn btn--main form__button btn-reset">Оставить заявку</button>
				<label class="custom-checkbox form__policy">
					<input type="checkbox" name="form_policy" class="custom-checkbox__field form__input--policy">
					<span class="custom-checkbox__content">Согласен на обработку <a href="<?= get_privacy_policy_url() ?>">персональных данных</a></span>
				</label>
			</form>
			<img loading="lazy" src="<?= ct()->get_static_url() ?>/img/callback-section-human.png" class="callback__human-image" width="1040" height="950"
				alt="Веселый мужчина показывает палец вверх" aria-hidden="true">
		</div>
	</section>
</main>
<?php get_footer(); ?>