<?php

// if ( ! defined( 'MAIN_DOMAIN' ) ) {
// 	wp_die( 'wrong domain' );
// }

function get_main_domain() {
	return str_replace( [ 'https://', 'http://' ], '', MAIN_DOMAIN );
}

function get_alias_domain() {
	return str_replace( [ 'https://', 'http://' ], '', $_SERVER['HTTP_HOST'] ?? '' );
}

// Для админки не надо работать
if ( is_admin() ) {
	return;
}

// В wp-config.php не определена константа MAIN_DOMAIN
if ( ! defined( 'MAIN_DOMAIN' ) ) {
	return;
}

$main_domain  = get_main_domain();
$alias_domain = get_alias_domain();

// Это базовый сайт
if ( ! $alias_domain || $main_domain === $alias_domain ) {
	return;
}

// Выше была проверка на базовость сайта.
// Ниже сработает код только для алиасов.

// На странице авторизации выдаём ошибку
add_action( 'login_init', function () {
	wp_die( 'wrong url', 'wrong url', 403 );
} );

// "Собираем" весь вывод странице и подменяем базовый домен доменом алиаса
ob_start();
add_action( 'shutdown', function () use ( $main_domain, $alias_domain ) {
	echo str_replace( $main_domain, $alias_domain, ob_get_clean() );
}, 0 );
