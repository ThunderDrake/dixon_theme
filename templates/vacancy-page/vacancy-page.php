<?php 
/**
 * The template for displaying the vacancy page.
 *
 * @package dixon_theme
 */
get_header();
$vacancy_array          = get_field('vacancy_list');
$vacancy_phones_call    = get_field('vacancy_phones_call');
$vacancy_phones_social  = get_field('vacancy_phones_social');
$vacancy_partners       = get_field('vacancy_partners');

$total_array = [];
foreach ($vacancy_array as $vacancy) {
	foreach ($vacancy['sub_vacancy'] as $subvacancy) {
		$total_array[] = $subvacancy;
	}
}

?>
<main class="main" style="padding-top: var(--header-height); flex: 1;">
	<section class="vacancy">
		<div class="vacancy__container container">
			<h1 class="vacancy__section-title h2-title">Вакансии</h1>
			<div class="vacancy__banner">
				<picture>
					<source srcset="<?= ct()->get_static_url() ?>/img/vacancy/vacancy__section-image.avif" type="image/avif">
					<source srcset="<?= ct()->get_static_url() ?>/img/vacancy/vacancy__section-image.webp" type="image/webp">
					<img loading="lazy" src="<?= ct()->get_static_url() ?>/img/vacancy/vacancy__section-image.jpg" class="vacancy__image" width="1162" height="316"
						alt="Рука девушки держит телефон">
				</picture>
				<div class="vacancy__banner-info">
					<div class="vacancy__banner-title">Мы <span>ждем тебя</span> в нашу дружную команду</div>
					<a class="btn btn--main btn-reset vacancy__banner-button" href="/questionary/">Заполни анкету</a>
				</div>
			</div>
			<p class="vacancy__section-text">Наша компания более 20 лет является стратегическим партнером операторов мобильной связи на территории
				Чувашской Республики — МегаФон, Билайн, МТС, Йота, Теле2 и Ростелеком.</p>
			<div class="vacancy__content">
				<div class="vacancy__list">
					<div class="vacancy__list-title">Открытые вакансии</div>
					<?php foreach ($vacancy_array as $vacancy): ?>
					<select class="vacancy__select" data-vacancy="<?= $vacancy['name'] ?>">
						<option placeholder><?= $vacancy['name'] ?></option>
						<?php foreach ($vacancy['sub_vacancy'] as $subvacancy): ?>
							<option value="<?= $subvacancy['list_name'] ?>"><?= $subvacancy['list_name'] ?></option>
						<?php endforeach; ?>
					</select>
					<?php endforeach; ?>
				</div>
				<?php foreach($total_array as $item): ?>
					<div class="vacancy__info" data-value="<?= $item['list_name'] ?>">
						<div class="vacancy__info-title"><?= $item['list_name'] ?></div>
						<div class="vacancy__info-block">
							<div class="vacancy__info-block-title">Обязанности:</div>
							<?= $item['duties'] ?>
						</div>
						<div class="vacancy__info-block">
							<div class="vacancy__info-block-title">Требования:</div>
							<?= $item['requirements'] ?>
						</div>
						<div class="vacancy__info-block">
							<div class="vacancy__info-block-title">Условия работы:</div>
							<?= $item['conditions'] ?>
						</div>
						<a class="btn btn--main btn-reset vacancy__info-button" href="/questionary/">Заполни анкету</a>
						<div class="vacancy__info-contacts">
							<div class="vacancy__info-contacts-title">Отдел кадров:</div>
							<div class="vacancy__info-contacts-item">
								<div class="vacancy__info-contacts-icons">
									<svg class="vacancy__info-icon vacancy__info-icon--phone" width="24" height="24">
										<use xlink:href="#phone"></use>
									</svg>
								</div>
								<a class="vacancy__info-contacts-link" href="tel:<?= str_replace([' ', '(', ')', '-'], '', $vacancy_phones_call) ?>"><?= $vacancy_phones_call ?></a>
							</div>
							<div class="vacancy__info-contacts-item">
								<div class="vacancy__info-contacts-icons">
									<a class="vacancy__info-icon-link" href="#">
										<svg class="vacancy__info-icon vacancy__info-icon--tg" width="20" height="20">
											<use xlink:href="#tg-icon"></use>
										</svg>
									</a>
									<a class="vacancy__info-icon-link" href="#">
										<svg class="vacancy__info-icon vacancy__info-icon--viber" width="20" height="20">
											<use xlink:href="#viber-icon"></use>
										</svg>
									</a>
									<a class="vacancy__info-icon-link" href="#">
										<svg class="vacancy__info-icon vacancy__info-icon--whatsapp" width="20" height="20">
											<use xlink:href="#whatsapp-icon"></use>
										</svg>
									</a>
								</div>
								<a class="vacancy__info-contacts-link" href="tel:<?= str_replace([' ', '(', ')', '-'], '', $vacancy_phones_social) ?>"><?= $vacancy_phones_social ?></a>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<?php if($vacancy_partners): ?>
				<div class="vacancy__partners">
					<div class="vacancy__partners-title">Нашими партнерами являются все федеральные операторы связи</div>
					<?php foreach($vacancy_partners as $partner): ?>
					<img loading="lazy" src="<?= wp_get_attachment_url($partner['image_id']) ?>" class="vacancy__partners-image" width="200" height="36" alt="">
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>