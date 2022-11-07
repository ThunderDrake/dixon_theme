<?php

add_action( 'wp_enqueue_scripts', 'callback_scripts' );
/**
 * Подключение файлов скрипта формы обратной связи
 *
 * @see https://wpruse.ru/?p=3224
 */
function callback_scripts() {

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
		'callback-form',
		get_stylesheet_directory_uri() . '/static/js/callback-form.js',
		array( 'jquery' ),
		1.0,
		true
	);
	
	// Задаем данные обьекта ajax
	wp_localize_script(
		'callback-form',
		'callback_form_object',
		array(
			'url'   => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce( 'callback_form_nonce' ),
		)
	);

}

add_action( 'wp_ajax_callback_form_action', 'ajax_callback' );
add_action( 'wp_ajax_nopriv_callback_form_action', 'ajax_callback' );
/**
 * Обработка скрипта
 *
 * @see https://wpruse.ru/?p=3224
 */
function ajax_callback() {

	// Массив ошибок
	$err_message = array();

	// Проверяем nonce. Если проверкане прошла, то блокируем отправку
	if ( ! wp_verify_nonce( $_POST['nonce'], 'callback_form_nonce' ) ) {
		wp_die( 'Данные отправлены с левого адреса' );
	}

	// Проверяем на спам. Если скрытое поле заполнено или снят чек, то блокируем отправку
	if ( false === $_POST['art_anticheck'] || ! empty( $_POST['art_submitted'] ) ) {
		wp_die( 'Пошел нахрен, мальчик!(c)' );
	}
	if ( empty( $_POST['form_name'] ) || ! isset( $_POST['form_name'] ) ) {
		$err_message['form_name'] = 'Пожалуйста, введите ваше имя.';
	} else {
		$form_name = sanitize_text_field( $_POST['form_name'] );
	}

	if ( empty( $_POST['form_phone'] ) || ! isset( $_POST['form_phone'] ) ) {
		$err_message['form_phone'] = 'Пожалуйста, введите ваше имя.';
	} else {
		$form_phone = sanitize_text_field( $_POST['form_phone'] );
	}

	if ( empty( $_POST['form_model'] ) || ! isset( $_POST['form_model'] ) ) {
		$err_message['form_model'] = 'Пожалуйста, введите ваше имя.';
	} else {
		$form_model = sanitize_text_field( $_POST['form_model'] );
	}

	if ( empty( $_POST['form_message'] ) || ! isset( $_POST['form_message'] ) ) {
		$err_message['last_position'] = 'Пожалуйста, введите ваше имя.';
	} else {
		$form_message = sanitize_text_field( $_POST['form_message'] );
	}

	$email_to = '';
	$art_subject = 'Заявка с сайта';
	$rn = "\r\n";
	// Если адресат не указан, то берем данные из настроек сайта
	if ( ! $email_to ) {
		$email_to = get_option( 'admin_email' );
	}

	$body    = "Имя: ".$form_name.$rn.
	"Телефон для связи: ".$form_phone.$rn.
	"Модель IMEI: ".$form_model.$rn.
	"Проблема клиента: ".$form_message.$rn;
	
	$headers = 'From: ' . $form_name . ' <' . $email_to . '>' . "\r\n" . 'Reply-To: ' . $email_to;

	// Отправляем письмо
	wp_mail( $email_to, $art_subject, $body, $headers );

	// Отправляем сообщение об успешной отправке
	$message_success = 'Собщение отправлено. В ближайшее время я свяжусь с вами.';
	wp_send_json_success( $message_success );

	// На всякий случай убиваем еще раз процесс ajax
	wp_die();

}
