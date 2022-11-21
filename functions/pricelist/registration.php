<?php

// Регистрируем
add_action( 'init', function () {

	register_post_type( 'models', [
		'labels'           => [
			'name'               => 'Модели для ремонта',
			'singular_name'      => 'Модели',
			'name_admin_bar'     => 'Модели для ремонта',
			'menu_name'          => 'Модели для ремонта',
			'add_new'            => 'Добавить новую модель',
			'add_new_item'       => 'Добавить новую модель',
			'edit_item'          => 'Редактировать модель',
			'new_item'           => 'Новая модель',
			'view_item'          => 'Посмотреть модель',
			'search_items'       => 'Найти модель',
			'not_found'          => 'Модель не найдена',
			'not_found_in_trash' => 'В корзине моделей не найдено',
		],
		'public'           => true,
		'rewrite'          => [ 'slug' => 'models' ],
		'capability_type'  => 'post',
		'has_archive'      => 'pricelist',
		'hierarchical'     => false,
		'menu_position'    => 7,
		'menu_icon'        => 'dashicons-megaphone',
		'supports'         => [ 'title', 'thumbnail', 'editor' ],
		'template_archive' => '/templates/pricelist-page/pricelist-page.php',
		'posts_per_page'   => -1,
		'show_in_rest'     => true,
		'show_ui'          => true,
		'show_in_menu'     => true,
	] );

}, 9 );