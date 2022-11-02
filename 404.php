<?php
/**
 * The template for displaying the page.
 *
 * @package venus
 */
wp_head();
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  ?>
<main class="base-page forty-four">
	<div class="left__block">
		<a class="left__link" href="/">
			<div class="sphere"></div>
			Вернуться на Главную
		</a>
	</div>
	<div class="center__block">
		<div class="block__title">
			404
		</div>
		<div class="block__subtitle">
			OOPS! ЧТО-ТО ПОШЛО НЕ ТАК!
		</div>
		<div class="block__desc">Страница которую вы открыли в данный момент не доступна. Временами это случается со всеми. Мы уже работаем над ее исправлением!
		</div>
	</div>
	<div class="right__block">
		<a class="right__link" href="<?php echo $url; ?>">Повторить попытку 
			<div class="sphere"></div>
		</a>
	</div>
</main>
