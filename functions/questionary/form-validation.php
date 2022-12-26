<?php

add_action( 'wp_enqueue_scripts', 'questionary_scripts' );
/**
 * Подключение файлов скрипта формы обратной связи
 *
 * @see https://wpruse.ru/?p=3224
 */
function questionary_scripts() {

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
		'questionary-form',
		get_stylesheet_directory_uri() . '/static/js/questionary-form.js',
		array( 'jquery' ),
		1.0,
		true
	);
	
	// Задаем данные обьекта ajax
	wp_localize_script(
		'questionary-form',
		'questionary_form_object',
		array(
			'url'   => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce( 'questionary_form_nonce' ),
		)
	);

}

add_action( 'wp_ajax_questionary_form_action', 'ajax_questionary_callback' );
add_action( 'wp_ajax_nopriv_questionary_form_action', 'ajax_questionary_callback' );
/**
 * Обработка скрипта
 *
 * @see https://wpruse.ru/?p=3224
 */
function ajax_questionary_callback() {

	// Массив ошибок
	$err_message = array();

	// Проверяем nonce. Если проверкане прошла, то блокируем отправку
	if ( ! wp_verify_nonce( $_POST['nonce'], 'questionary_form_nonce' ) ) {
		wp_die( 'Данные отправлены с левого адреса' );
	}

	// Проверяем на спам. Если скрытое поле заполнено или снят чек, то блокируем отправку
	if ( false === $_POST['art_anticheck'] || ! empty( $_POST['art_submitted'] ) ) {
		wp_die( 'Пошел нахрен, мальчик!(c)' );
	}

	if ( empty( $_POST['position'] ) || ! isset( $_POST['position'] ) ) {
		$err_message['position'] = 'Пожалуйста, введите ваше имя.';
	} else {
		$form_position = sanitize_text_field( $_POST['position'] );
	}

	if ( empty( $_POST['name'] ) || ! isset( $_POST['name'] ) ) {
		$err_message['name'] = 'Пожалуйста, введите ваше имя.';
	} else {
		$form_name = sanitize_text_field( $_POST['name'] );
	}

	if ( empty( $_POST['phone'] ) || ! isset( $_POST['phone'] ) ) {
		$err_message['phone'] = 'Пожалуйста, введите ваше имя.';
	} else {
		$form_phone = sanitize_text_field( $_POST['phone'] );
	}

	if ( empty( $_POST['birthday'] ) || ! isset( $_POST['birthday'] ) ) {
		$err_message['birthday'] = 'Пожалуйста, введите ваше имя.';
	} else {
		$form_birthday = sanitize_text_field( $_POST['birthday'] );
	}

	if ( empty( $_POST['citizenship'] ) || ! isset( $_POST['citizenship'] ) ) {
		$err_message['citizenship'] = 'Пожалуйста, введите ваше имя.';
	} else {
		$form_citizenship = sanitize_text_field( $_POST['citizenship'] );
	}

	if ( empty( $_POST['marital_status'] ) || ! isset( $_POST['marital_status'] ) ) {
		$err_message['marital_status'] = 'Пожалуйста, введите ваше имя.';
	} else {
		$form_marital_status = sanitize_text_field( $_POST['marital_status'] );
	}

	if ( empty( $_POST['babes'] ) || ! isset( $_POST['babes'] ) ) {
		$err_message['babes'] = 'Пожалуйста, введите ваше имя.';
	} else {
		$form_babes = sanitize_text_field( $_POST['babes'] );
	}

	if ( empty( $_POST['education'] ) || ! isset( $_POST['education'] ) ) {
		$err_message['education'] = 'Пожалуйста, введите ваше имя.';
	} else {
		$form_education = sanitize_text_field( $_POST['education'] );
	}

	if ( empty( $_POST['education_end'] ) || ! isset( $_POST['education_end'] ) ) {
		$err_message['education_end'] = 'Пожалуйста, введите ваше имя.';
	} else {
		$form_education_end = sanitize_text_field( $_POST['education_end'] );
	}

	if ( empty( $_POST['education_position'] ) || ! isset( $_POST['education_position'] ) ) {
		$err_message['education_position'] = 'Пожалуйста, введите ваше имя.';
	} else {
		$form_education_position = sanitize_text_field( $_POST['education_position'] );
	}

	if ( empty( $_POST['last_work'] ) || ! isset( $_POST['last_work'] ) ) {
		$err_message['last_work'] = 'Пожалуйста, введите ваше имя.';
	} else {
		$form_last_work = sanitize_text_field( $_POST['last_work'] );
	}

	if ( empty( $_POST['last_position'] ) || ! isset( $_POST['last_position'] ) ) {
		$err_message['last_position'] = 'Пожалуйста, введите ваше имя.';
	} else {
		$form_last_position = sanitize_text_field( $_POST['last_position'] );
	}

	if ( empty( $_POST['last_work_time'] ) || ! isset( $_POST['last_work_time'] ) ) {
		$err_message['last_work_time'] = 'Пожалуйста, введите ваше имя.';
	} else {
		$form_last_work_time = sanitize_text_field( $_POST['last_work_time'] );
	}

	if ( empty( $_POST['money'] ) || ! isset( $_POST['money'] ) ) {
		$err_message['money'] = 'Пожалуйста, введите ваше имя.';
	} else {
		$form_money = sanitize_text_field( $_POST['money'] );
	}

	if ( empty( $_POST['work_start'] ) || ! isset( $_POST['work_start'] ) ) {
		$err_message['work_start'] = 'Пожалуйста, введите ваше имя.';
	} else {
		$form_work_start = sanitize_text_field( $_POST['work_start'] );
	}

	if ( empty( $_POST['work_already'] ) || ! isset( $_POST['work_already'] ) ) {
		$err_message['work_already'] = 'Пожалуйста, введите ваше имя.';
	} else {
		$work_already = sanitize_text_field( $_POST['work_already'] );
	}

	$email_to = '';
	$art_subject = 'Вакансия на работу';
	$rn = "\r\n";
	// Если адресат не указан, то берем данные из настроек сайта
	if ( ! $email_to ) {
		$email_to = get_option( 'admin_email' );
	}

	$body    = "Позиция: ".$form_position.$rn.
	"Имя: ".$form_name.$rn.
	"Телефон для связи: ".$form_phone.$rn.
	"Дата рождения: ".$form_birthday.$rn.
	"Гражданство: ".$form_citizenship.$rn.
	"Семейное положение: ".$form_marital_status.$rn.
	"Дети: ".$form_babes.$rn.
	"Образование: ".$form_education.$rn.
	"Год окончания обучения: ".$form_education_end.$rn.
	"Форма обучения: ".$form_education_position.$rn.
	"Последнее место работы: ".$form_last_work.$rn.
	"Последнее место работы - Должность: ".$form_last_position.$rn.
	"Последнее место работы - Период работы: ".$form_last_work_time.$rn.
	"Ожидаемый уровень дохода: ".$form_money.$rn.
	"Работаете ли сейчас: ".$work_already.$rn.
	"Когда готовы приступить к работе: ".$form_work_start.$rn;
	$headers = 'From: ' . $form_name . ' <' . $email_to . '>' . "\r\n" . 'Reply-To: ' . $email_to;

	// Отправляем письмо
	wp_mail( $email_to, $art_subject, $body, $headers );

	// Отправляем сообщение об успешной отправке
	$message_success = 'Собщение отправлено. В ближайшее время я свяжусь с вами.';
	wp_send_json_success( $message_success );

	// На всякий случай убиваем еще раз процесс ajax
	wp_die();

}
