<?php

namespace Dixon\Dev;

use WP_CLI;

class News_Generator extends Main {

	public function registration_commands() {
		WP_CLI::add_command( 'dev news_generator start', [ $this, 'start' ] );
	}

	public function start() {
		wp_set_current_user( 1 );
		define( 'ALLOW_UNFILTERED_UPLOADS', true );

		$this->generate();
	}

	public function generate() {
		$this->action = 'WP | Генерация Новостей';

		$post = get_posts( [
			'numberposts' => 1,
			'post_type'   => 'news',
		] )[0];

		if ( $post ) {
			$metas = get_post_meta( $post->ID, '', true );
			$metas = array_map( function ( $item ) {
				return $item[0];
			}, $metas );

			foreach ( $this->get_fake_news_title() as $fake_title ) {
				$this->insert_post( [
					'post_title' => $fake_title,
					'post_date'  => date( "Y-m-d H:i:s", random_int( 788918400, 1609459200 ) ),
					'meta_input' => $metas,
				] );
			}
		} else {
			$this->log( 'Ошибка: Нет преподавателя для клонирования' );
		}
	}

	private function insert_post( $post_data ) {
		// Создаем массив данных по умолчанию
		$post_data_default = [
			'post_type'   => 'news',
			'post_status' => 'publish',
			'post_author' => 1,
		];

		// Объединяем данные и вставляем их в БД
		$post_id = wp_insert_post( wp_slash( array_merge( $post_data_default, $post_data ) ) );

		if ( is_wp_error( $post_id ) ) {
			$this->log( 'Ошибка: ' . $post_id->get_error_message() );
		}

		return $post_id;
	}

	/**
	 * Возвращает массив Имен-Фамилий.
	 *
	 * Создано через https://planetcalc.ru/8678/.
	 *
	 * @return array
	 */
	private function get_fake_news_title() {
		ob_start();
		$list = "
        Минфин отказался от вечеринки в Рязанской области
        Australian отвергла возможность iPhone8 на Android
        Иркутск оставили без воздуха
        Полиция Петербурга против мира Петербурга
        В Китае начались продажи должников
        Минэкономразвития сообщило о гей-партнерстве против санкций
        Греция выступила с мишкой
        Путин помирился с музеем и с Солженицыным
        Голый турист погиб в Буденновске
        Врачи отговорили Горбачева от поездки на прощание с проблемами в области работорговли
        В Британии задумались полуфинальные пары Кубка Конфедераций
        Депутат Лебедев признал неуместным предложение оштрафовать такси
        В Совфеде предложили выбирать почетных Леопольдов
        Вице-спикер Думы обосновал предложение о подготовке госпереворота
        Литовские онкологи в Москве приступили к лечению
        ЦБ выделит деньги на починку каменного пениса тролля
        Снимавшимся в кино сложнее прилично шутить о новой подмосковной ведущей
        Нетрезвый задержанный спровоцировал Госдуму
        Израиль ответил кислотой в лицо
        Глава ФРС США пообещала отсутствие кремов
        Проблему бараков в Ижевске решили через постель
        На Ямале кречеты впервые вывели потомство от самолета Евровидения
        Подмосковье за год потратит больше Бразилии
        У берегов Ливии такси из Иванушек
        Опубликовано число погибших при крушении туристического судна в Раде
        Ким Кардашьян обвинили в подготовке еще одной химической атаки
        Правительство пообещало отсутствие денег на внутренние дела России
        Тысячу вожатых подготовили для работы в России
        Брейвик пожаловался на обстрел своей территории авиаударом
        США потребовали дать в морду Жиркову
        Петербуржец-шизофреник предупредил о считанных днях до блокировки Telegram
        ";

		return array_values( array_filter( array_map( 'trim', explode( '  ', $list ) ) ) );
	}

}