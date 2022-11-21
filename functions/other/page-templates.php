<?php
/**
 * Добавляем шаблоны, которые лежат глубже, чем может прочесть движок.
 */


/**
 * @param string[] $templates
 *
 * @return string[]
 */
function add_templates_to_dropdown( $templates ) {

	// выбор шаблона в атрибутах
	$templates['templates/cart/cart-page.php']                      = 'Корзина';
	$templates['templates/checkout/checkout-page.php']              = 'Оформление заказа';
	$templates['templates/credit-page/credit-page.php']             = 'Оформление в кредит';
	$templates['templates/delivery-page/delivery-page.php']         = 'Доставка и оплата';
	$templates['templates/about-page/about-page.php']               = 'О компании';
	$templates['templates/vacancy-page/vacancy-page.php']           = 'Вакансии';
	$templates['templates/questionary-page/questionary-page.php']   = 'Анкета соискателя';
	$templates['templates/contact-page/contact-page.php']           = 'Контакты';
	$templates['templates/callback-page/callback-page.php']         = 'Связаться с нами';
	$templates['templates/pricelist-page/pricelist-page.php']       = 'Прайс-лист';
	$templates['templates/review-page/review-page.php']             = 'Отзывы о нас';
	$templates['templates/repair-page/repair-page.php']             = 'Заявка на ремонт телефона';

	return $templates;
}

add_filter( 'theme_page_templates', 'add_templates_to_dropdown' );