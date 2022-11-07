<?php

namespace Dixon;

class ACF {
	private $json_dir_path;

	public function __construct() {
		$this->json_dir_path = get_parent_theme_file_path( '/functions/acf/groups-and-fields' );

		$this->hooks();
		$this->create_contact_setting_page();
	}

	public function hooks() {
		add_filter( 'acf/settings/load_json', [ $this, 'set_dir_json_for_load' ] );
		add_filter( 'acf/settings/save_json', [ $this, 'set_dir_json_for_save' ] );
	}

	/**
	 * Изменяет путь к папке с json-конфигурациями групп полей при чтении.
	 *
	 * @return array
	 */
	public function set_dir_json_for_load() {
		return (array) $this->json_dir_path;
	}

	/**
	 * Изменяет путь к папке с json-конфигурациями групп полей при загрузке.
	 *
	 * @return string
	 */
	public function set_dir_json_for_save() {
		wp_mkdir_p( $this->json_dir_path );

		return $this->json_dir_path;
	}

	/**
	 * Создаёт страницу контактов в меню сайта
	 *
	 * @return string
	 */
	public function create_contact_setting_page() {
		acf_add_options_page(array(
			'page_title'    => 'Контакты организации',
			'menu_title'    => 'Контакты',
			'menu_slug'     => 'theme-contact-settings',
			'capability'    => 'edit_posts',
			'redirect'      => false,
			'icon_url'      => 'dashicons-share',
		));
	}

}
