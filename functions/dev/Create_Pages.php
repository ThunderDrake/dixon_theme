<?php
/**
 * Создание страниц с помощью CLI команды.
 * Команда: wp dev new_pages start - создать все страницы
 */

namespace Dixon\Dev;

use WP_CLI;

class Create_Pages extends Main {

	public function registration_commands() {
		WP_CLI::add_command( 'dev new_pages start', [ $this, 'start' ] );
	}

	public function start() {
		wp_set_current_user( 1 );
		define( 'ALLOW_UNFILTERED_UPLOADS', true );

		$this->create_page_about();
		$this->create_page_applicants();
		$this->create_page_constructor();
		$this->create_page_thanks();
		$this->create_page_values();
		$this->create_page_press();
		$this->create_page_charter();
		$this->create_page_board();
		$this->create_page_donate();
	}

	public function create_page_about() {
		$this->action = 'WP | Страница "Об университете"';

		$this->insert_post( [
			'post_title' => 'Об университете',
			'post_name'  => 'about',
			'meta_input' => [
				'_wp_page_template' => 'templates/page-about/page-about.php',
			],
		] );
	}

	public function create_page_applicants() {
		$this->action = 'WP | Страница "Поступающим"';

		$this->insert_post( [
			'post_title' => 'Поступающим',
			'post_name'  => 'applicant',
			'meta_input' => [
				'_wp_page_template' => 'templates/page-applicant/page-applicant.php',
			],
		] );
	}

	public function create_page_constructor() {
		$this->action = 'WP | Страница "Конструктор заявок"';

		$this->insert_post( [
			'post_title' => 'Конструктор заявок',
			'post_name'  => 'constructor',
			'meta_input' => [
				'_wp_page_template' => 'templates/page-constructor/page-constructor.php',
			],
		] );
	}

  public function create_page_thanks() {
		$this->action = 'WP | Страница "Спасибо"';

		$this->insert_post( [
			'post_title' => 'Спасибо',
			'post_name'  => 'thanks',
			'meta_input' => [
				'_wp_page_template' => 'templates/page-thanks/page-thanks.php',
			],
		] );
	}

  public function create_page_values() {
		$this->action = 'WP | Страница "Декларация ценностей"';

		$this->insert_post( [
			'post_title' => 'Декларация ценностей',
			'post_name'  => 'values',
			'meta_input' => [
				'_wp_page_template' => 'templates/page-values/page-values.php',
			],
		] );
	}

  public function create_page_press() {
		$this->action = 'WP | Страница "Пресса о нас"';

		$this->insert_post( [
			'post_title' => 'Пресса о нас',
			'post_name'  => 'press',
			'meta_input' => [
				'_wp_page_template' => 'templates/page-press/page-press.php',
			],
		] );
	}

  public function create_page_charter() {
		$this->action = 'WP | Страница "Устав университета"';

		$this->insert_post( [
			'post_title' => 'Устав университета',
			'post_name'  => 'charter',
			'meta_input' => [
				'_wp_page_template' => 'templates/page-charter/page-charter.php',
			],
		] );
	}

  public function create_page_board() {
		$this->action = 'WP | Страница "Наблюдательный совет"';

		$this->insert_post( [
			'post_title' => 'Наблюдательный совет',
			'post_name'  => 'board',
			'meta_input' => [
				'_wp_page_template' => 'templates/page-board/page-board.php',
			],
		] );
	}

  public function create_page_donate() {
		$this->action = 'WP | Страница "Поддержать нас"';

		$this->insert_post( [
			'post_title' => 'Поддержать нас',
			'post_name'  => 'donate',
			'meta_input' => [
				'_wp_page_template' => 'templates/page-donate/page-donate.php',
			],
		] );
	}

	/**
	 * @param $post_data
	 *
	 * @return int|\WP_Error
	 */
	private function insert_post( $post_data ) {
		$post_id = isset( $post_data['post_name'] ) ? get_page_by_path( $post_data['post_name'] ) : null;
		$post_id = $post_id ? $post_id->ID : null;

		// Создаем массив данных по умолчанию
		$post_data_default = [
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_author'  => 1,
			'post_content' => '',
		];

		// Объединяем данные и вставляем их в БД
		if ( $post_id ) {
			$post_data['ID'] = $post_id;
			$post_id         = wp_update_post( wp_slash( array_merge( $post_data_default, $post_data ) ), true );
			$text            = 'Опубликовано';
		} else {
			$post_id = wp_insert_post( wp_slash( array_merge( $post_data_default, $post_data ) ) );
			$text    = 'Обновлено';
		}

		if ( is_wp_error( $post_id ) ) {
			$this->log( 'Ошибка: ' . $post_id->get_error_message() );
		} else {
			$this->log( $text );
		}

		return $post_id;
	}

}