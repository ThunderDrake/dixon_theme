<?php

add_action( 'init', 'register_common_taxonomies', 9 );

function register_common_taxonomies() {

  register_taxonomy( 'section', [ 'news' ], [
		'hierarchical'      => false,
		'labels'            => [
			'name'               => 'Секция',
			'singular_name'      => 'Секция',
			'add_new'            => 'Добавить новую',
			'add_new_item'       => 'Добавить новую секцию',
			'edit_item'          => 'Редактировать секцию',
			'new_item'           => 'Новая секция',
			'view_item'          => 'Посмотреть секцию',
			'search_items'       => 'Найти секцию',
			'not_found'          => 'Секция не найдены',
			'not_found_in_trash' => 'В корзине секций не найдено',
			'menu_name'          => 'Секции',
		],
		'show_admin_column' => true,
		'show_in_rest'      => false,
	] );

  register_taxonomy( 'event_type', [ 'events' ], [
		'hierarchical'      => false,
		'labels'            => [
			'name'               => 'Тип события',
			'singular_name'      => 'Тип события',
			'add_new'            => 'Добавить Тип события',
			'add_new_item'       => 'Добавить новый Тип события',
			'edit_item'          => 'Редактировать Тип события',
			'new_item'           => 'Новый Тип события',
			'view_item'          => 'Посмотреть Тип события',
			'search_items'       => 'Найти Тип события',
			'not_found'          => 'Тип события не найден',
			'not_found_in_trash' => 'В корзине Тип события не найден',
			'menu_name'          => 'Тип события',
		],
		'show_admin_column' => true,
		'show_in_rest'      => false,
	] );

}
