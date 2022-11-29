<?php 
/**
 * The template for displaying the pricelist page.
 *
 * @package dixon_theme
 */
get_header();
$repair_list = get_field('repair_list_items');
?>
<main class="main" style="padding-top: var(--header-height);">
	<section class="repair">
		<div class="repair__container container">
			<div class="repair__title-container">
				<h1 class="repair__title h2-title">Рассчитать точную стоимость ремонта</h1>
				<div class="repair__title-label">всего за 4 шага</div>
			</div>
			<form class="repair__form" id="repair_form">
				<div class="repair__form-counter">
					<span class="repair__form-counter-text">Шаг <span class="repair__form-counter-text--current">1</span> из 4</span>
					<div class="repair__form-counter-bar">
						<div class="repair__form-counter-bar--active"></div>
					</div>
				</div>
				<div class="repair__form-steps">
					<div class="repair__form-step repair__form-step--active">
						<div class="repair__input">
							<label class="repair__input-label">
								<span class="repair__input-text">Какая у Вас модель устройства?</span>
								<input type="text" class="repair__input-input" name="repair_model">
							</label>
						</div>
						<a class="repair__form-next-step btn btn--main btn-reset" href="#">Следующий вопрос</a>
					</div>

					<div class="repair__form-step">
						<div class="repair__problem-list work-list">
							<?php foreach($repair_list as $item): ?>
								<label class="repair__problem-checkbox custom-checkbox">
									<input type="checkbox" class="custom-checkbox__field" name="repair_problem[]" value="<?= $item['name'] ?>">
									<div class="work-list__item">
										<div class="work-list__icon">
											<?php echo file_get_contents( $item['image'] ); ?>
										</div>
										<h3 class="work-list__title"><?= $item['name'] ?></h3>
									</div>
								</label>
							<?php endforeach; ?>
						</div>
						<a class="repair__form-next-step btn btn--main btn-reset" href="#">Следующий вопрос</a>
					</div>

					<div class="repair__form-step">
						<div class="repair__input">
							<label class="repair__input-label">
								<span class="repair__input-text">Укажи SN или IMEI устройства</span>
								<input type="text" class="repair__input-input" name="repair_imei">
							</label>
						</div>
						<a class="repair__form-next-step btn btn--main btn-reset" href="#">Следующий вопрос</a>
					</div>

					<div class="repair__form-step">
						<div class="repair__sup-title">Оставьте свои данные и наш менеджер свяжется с вами в течении 15 минут.</div>
						<label class="repair__form-field repair__form-field--name" for="form_name">
							<svg class="repair__form-field-icon" width="26" height="26">
								<use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#name-input-icon"></use>
							</svg>
							<input class="repair__form-field-input repair__form-field-input--name" type="text" name="repair_name" placeholder="Введите ваше имя">
						</label>
						<label class="repair__form-field repair__form-field--name" for="form_phone">
							<svg class="repair__form-field-icon" width="26" height="26">
								<use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#phone-input-icon"></use>
							</svg>
							<input class="repair__form-field-input repair__form-field-input--phone" type="tel" name="repair_phone" placeholder="Введите ваш телефон">
						</label>
						<input type="checkbox" name="art_anticheck" id="art_anticheck" class="art_anticheck" style="display: none !important;" value="true" checked="checked"/>
						<input type="text" name="art_submitted" id="art_submitted" value="" style="display: none !important;"/>
						<button type="submit" class="btn btn-reset btn--main repair__form-submit">Оставить заявку</button>
						<label class="repair__form-policy custom-checkbox">
							<input type="checkbox" class="custom-checkbox__field">
							<span class="custom-checkbox__content">Согласен на обработку <a href="<?= get_privacy_policy_url() ?>">персональных данных</a></span>
						</label>
					</div>
				</div>
			</form>
		</div>
	</section>

	<?php ct()->template( '/parts/contacts-section.php' ) ?>

</main>
<?php get_footer(); ?>