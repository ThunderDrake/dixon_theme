<?php

namespace Dixon\Dev;

use WP_CLI;
use WP_CLI\Utils;

class Courses_Generator extends Main {

	private $post_type = 'course';

	public function registration_commands() {
		WP_CLI::add_command( 'dev courses_generator start', [ $this, 'start' ] );
	}

	public function start() {
		wp_set_current_user( 1 );
		define( 'ALLOW_UNFILTERED_UPLOADS', true );

		$this->generate();
	}

	public function generate() {
		$post = $this->get_post_for_clone( [ 'post_type' => $this->post_type ] );

		if ( $post ) {
			$fake_titles = $this->get_fake_course_titles();
			$progress    = Utils\make_progress_bar( 'Генерация курсов', count( $fake_titles ), 1 );
			$metas       = $this->get_post_all_meta( $post->ID );

			foreach ( $fake_titles as $fake_title ) {
				$metas['course_teachers'] = $this->get_random_post_ids( random_int( 1, 5 ), [ 'post_type' => 'teacher', ] );
				$metas['course_schools']  = $this->get_random_post_ids( random_int( 1, 3 ), [ 'post_type' => 'school', ] );
				$metas['course_duration'] = $this->get_random_item( [ 'month', 'semester', 'year' ] );
				$metas['course_level']    = $this->get_random_item( [ 'base', 'advanced', 'master' ] );
				$metas['course_formats']  = $this->get_random_items( random_int( 1, 3 ), [ 'lectures', 'master-classes', 'seminars' ] );

				$this->insert_post( [
					'post_title'   => $fake_title,
					'post_content' => $post->post_content,
					'post_date'    => $this->get_random_date( '2000-01-01', '2021-12-28' ),
					'meta_input'   => $metas,
				] );

				$progress->tick();
			}

			$progress->finish();
		} else {
			$this->log( 'Ошибка: Нет записи для клонирования' );
		}
	}

	private function insert_post( $post_data ) {
		// Создаем массив данных по умолчанию
		$post_data_default = [
			'post_type'   => $this->post_type,
			'post_status' => 'publish',
			'post_author' => 1,
		];

		// Объединяем данные и вставляем их в БД
		$post_id = wp_insert_post( wp_slash( array_merge( $post_data_default, $post_data ) ) );

		if ( is_wp_error( $post_id ) ) {
			$this->log( 'Ошибка: ' . $post_id->get_error_message() );

			$post_id = null;
		}

		return $post_id;
	}

	/**
	 * Возвращает массив названий курсов.
	 *
	 * @return array
	 */
	private function get_fake_course_titles() {
		ob_start();
		$list = '
			Good Governance LEGO
			Love & Poetics in Shakespeare\'s Sonnets
			The Foundation of Modern Democracy in the "Federalist Papers"
			1914: Всечеловечество - Первая мировая и Европа
			Академические права: как сохранить науку и образование свободными
			Введение в раннее русское кино
			Вертикальная компаративистика
			Город как текст
			Интернет и конституционные права
			Информационное право
			Исследовательский семинар по антропологии активизма и политического участия
			История российской мемориальной культуры
			История советской поэзии
			Как и зачем проводить социологические исследования?
			Как написать хорошую курсовую, магистерскую и кандидатскую гуманитарную диссерт?
			Качественные методы исследования в социальных и гуманитарных науках
			Комбинаторика
			Линейная алгебра
			Людвиг Витгенштейн: логика, философия, этика, религия
			Метафизические основания науки нового времени
			Мифология Древнего Ближнего Востока
			Национальный театр в XX веке. Еврейский театр в России—Габима и ГОСЕТ
			«Неленинский большевизм» А.А.Богданова: идеи и практика
			Основы логики и аргументации
			Основы конституционного права
			Основы медиабезопасности
			Основные понятия стоической этики
			Основы права Европейского Союза
			От телевидения к YouTube, от программы к блогу
			«Партия трагической судьбы»: история, идеи, демократическая альтернатива и люди п
			Поведение животных с точки зрения эволюционной теории
			Политическая экспертиза
			Правовой анализ ситуаций нарушения прав человека на основе подходов ЕСПЧ
			Раннее христианство: идеи и реконструкции
			Российское пространство и российское государство
			Современные учения об идеологии
			Становление советского права (1917-1948)
			Структурная химия молекул
			Тамиздат: контрабандная русская литература
			Транскультурные исследования
			Урбанистика и социология города: история идей
			Философия искусства
			Философия журналистики
			Художественный текст как источник политическо-правового знания
			Язык и власть: основы политического дискурса
        ';

		return array_values( array_filter( array_map( 'trim', explode( '	', $list ) ) ) );
	}

}