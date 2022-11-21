<?php

add_action( 'init', 'register_common_taxonomies', 9 );

function register_common_taxonomies() {

  register_taxonomy( 'model_type', [ 'models' ], [
		'hierarchical'      => false,
		'labels'            => [
			'name'               => 'Модель',
			'singular_name'      => 'Модель',
			'add_new'            => 'Добавить новую модель',
			'add_new_item'       => 'Добавить новую модель',
			'edit_item'          => 'Редактировать модель',
			'new_item'           => 'Новая модель',
			'view_item'          => 'Посмотреть модель',
			'search_items'       => 'Найти модель',
			'not_found'          => 'Модель не найдены',
			'not_found_in_trash' => 'В корзине модель не найдена',
			'menu_name'          => 'Модели',
		],
		'show_admin_column' => true,
		'show_in_rest'      => true,
	] );

}
