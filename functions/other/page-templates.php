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
	$templates['templates/page-applicant/page-applicant.php'] = 'Поступающим';
	$templates['templates/page-donate/page-donate.php']       = 'Донат';
	$templates['templates/page-thanks/page-thanks.php']       = 'Спасибо';
	$templates['templates/page-values/page-values.php']       = 'Декларация ценностей';
	$templates['templates/page-press/page-press.php']         = 'Пресса о нас';
	$templates['templates/page-charter/page-charter.php']     = 'Устав университета';
	$templates['templates/page-board/page-board.php']         = 'Наблюдательный совет';
	$templates['templates/page-about/page-about.php']         = 'Об университете';
	$templates['templates/page-constructor/page-constructor.php']         = 'Конструктор';

	return $templates;
}

add_filter( 'theme_page_templates', 'add_templates_to_dropdown' );