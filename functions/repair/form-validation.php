<?php

add_action( 'wp_enqueue_scripts', 'repair_scripts' );
/**
 * Подключение файлов скрипта формы обратной связи
 *
 * @see https://wpruse.ru/?p=3224
 */
function repair_scripts() {

	// Обрабтка полей формы
	wp_enqueue_script( 'jquery-form' );

	// Подключаем файл скрипта
	wp_enqueue_script(
		'just-validate',
		'https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js',
		array( 'jquery' ),
		1.0,
		true
	);
	wp_enqueue_script(
		'inputmask',
		'https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/inputmask.min.js',
		array( 'jquery' ),
		1.0,
		true
	);
	wp_enqueue_script(
		'repair-form',
		get_stylesheet_directory_uri() . '/static/js/repair-form.js',
		array( 'jquery' ),
		1.0,
		true
	);
	
	// Задаем данные обьекта ajax
	wp_localize_script(
		'repair-form',
		'repair_form_object',
		array(
			'url'   => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce( 'repair_form_nonce' ),
		)
	);

}

add_action( 'wp_ajax_repair_form_action', 'ajax_repair_callback' );
add_action( 'wp_ajax_nopriv_repair_form_action', 'ajax_repair_callback' );
/**
 * Обработка скрипта
 *
 * @see https://wpruse.ru/?p=3224
 */
function ajax_repair_callback() {

	// Массив ошибок
	$err_message = array();

	// Проверяем nonce. Если проверкане прошла, то блокируем отправку
	if ( ! wp_verify_nonce( $_POST['nonce'], 'repair_form_nonce' ) ) {
		wp_die( 'Данные отправлены с левого адреса' );
	}

	// Проверяем на спам. Если скрытое поле заполнено или снят чек, то блокируем отправку
	if ( false === $_POST['art_anticheck'] || ! empty( $_POST['art_submitted'] ) ) {
		wp_die( 'Пошел нахрен, мальчик!(c)' );
	}

	if ( empty( $_POST['repair_name'] ) || ! isset( $_POST['repair_name'] ) ) {
		$err_message['repair_name'] = 'Пожалуйста, введите ваше имя.';
	} else {
		$repair_name = sanitize_text_field( $_POST['repair_name'] );
	}

	if ( empty( $_POST['repair_phone'] ) || ! isset( $_POST['repair_phone'] ) ) {
		$err_message['repair_phone'] = 'Пожалуйста, введите ваше имя.';
	} else {
		$repair_phone = sanitize_text_field( $_POST['repair_phone'] );
	}

	if ( empty( $_POST['repair_model'] ) || ! isset( $_POST['repair_model'] ) ) {
		$err_message['repair_model'] = 'Пожалуйста, введите ваше имя.';
	} else {
		$repair_model = sanitize_text_field( $_POST['repair_model'] );
	}

	if ( empty( $_POST['repair_imei'] ) || ! isset( $_POST['repair_imei'] ) ) {
		$err_message['repair_imei'] = 'Пожалуйста, введите ваше имя.';
	} else {
		$repair_imei = sanitize_text_field( $_POST['repair_imei'] );
	}

	if ( empty( $_POST['repair_problem'] ) || ! isset( $_POST['repair_problem'] ) ) {
		$err_message['repair_problem'] = 'Пожалуйста, введите ваше имя.';
	} else {
		$repair_problem = '';
		foreach($_POST['repair_problem'] as $problem) {
			$repair_problem .= $problem.', ';
		};
	}

	$email_to = '';
	$art_subject = 'Заявка на ремонт';
	$rn = "\r\n";
	// Если адресат не указан, то берем данные из настроек сайта
	if ( ! $email_to ) {
		$email_to = get_option( 'admin_email' );
	}

	$body    = "Имя: ".$repair_name.$rn.
	"Телефон для связи: ".$repair_phone.$rn.
	"Модель телефона: ".$repair_model.$rn.
	"Номер SN или IMEI: ".$repair_imei.$rn.
	"Проблемы с устройством: ".$repair_problem.$rn.
	$headers = 'From: ' . $form_name . ' <' . $email_to . '>' . "\r\n" . 'Reply-To: ' . $email_to;

	// Отправляем письмо
	wp_mail( $email_to, $art_subject, $body, $headers );

	// Отправляем сообщение об успешной отправке
	$message_success = 'Собщение отправлено. В ближайшее время я свяжусь с вами.';
	wp_send_json_success( $message_success );

	// На всякий случай убиваем еще раз процесс ajax
	wp_die();

}
