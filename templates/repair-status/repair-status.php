<?php 
/**
 * The template for displaying the repair status page.
 *
 * @package dixon_theme
 */
get_header();
?>
<main class="main" style="padding-top: var(--header-height);">
	<section class="status-page">
		<div class="status-page__container container">
			<h1 class="status-page__title h2-title">Узнать статус ремонта</h1>
			<div class="status-page__text">
				Вы можете самостоятельно отслеживать статус ремонта своего оборудования.<br>
				Для получения информации о текущем состоянии ремонта, Вам необходимо <span>ввести номер телефона</span>, который Вы оставили
				в сервисном центре для связи и <span>номер заказ-наряда</span>
			</div>
			<form class="status-page__form" action="/">
				<input class="status-page__input status-page__input--order" type="text" placeholder="Заказ-наряд">
				<input class="status-page__input status-page__input--phone" type="tel" placeholder="Номер телефона">
				<button class="status-page__form-button btn-reset btn btn--main">Найти</button>
			</form>
		</div>
	</section>

	<?php ct()->template( '/parts/contacts-section.php' ) ?>

</main>
<?php get_footer(); ?>