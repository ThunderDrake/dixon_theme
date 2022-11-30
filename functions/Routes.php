<?php

namespace Dixon;

/**
 * РАСПРЕДЕЛЕНИЕ ШАБЛОНОВ отображения контента в зависимости от раздела сайта.
 * Данный файл создан, чтобы хранить шаблоны в стуктурированных папках и произвольными именами, а не в корне движка.
 */
class Routes {

	public function __construct() {
		add_filter( 'template_include', [ $this, 'replace_path' ], 99 );
	}

	/**
	 * Возвращает измененный путь к тому или иному шаблону.
	 *
	 * @param string $template путь к шаблону по умолчанию
	 *
	 * @return string
	 */
	public function replace_path( string $template ): string {
		if ( is_page_template() ) {
			$page_template = get_page_template_slug( get_queried_object_id() );
			$page_template = locate_template( $page_template );

			if ( $page_template && file_exists( $page_template ) ) {
				return $template;
			}
		}

		/***************
		 *** Частные ***
		 ***************/
		if ( is_cart() ) {
			return $this->locate_template( '/cart/cart-page.php' );
		}

		if ( is_shop() || is_product_category() || is_product_tag() ) {
			return $this->locate_template( '/product-archive/catalog-page.php' );
		}

		if ( is_product() ) {
			return $this->locate_template( '/single-product/single-product-page.php' );
		}

		if ( is_front_page() ) {
			return $this->locate_template( '/home-page/home-page.php' );
		}


		/***************
		 *** Общие ***
		 ***************/


		return $template;
	}

	/**
	 * Проверяет наличие указанного шаблона и заменяет им дефолтный шаблон.
	 *
	 * @param string  $path     Пользовательский путь к шаблону
	 *
	 * @return string
	 * @global string $template Дефолтный путь к шаблону
	 */
	public function locate_template( string $path ): string {
		global $template;

		$path = "templates/{$path}";

		// Проверяем наличие файла шаблона по указанному пути
		if ( $new_template = locate_template( [ $path ] ) ) {
			$template = $new_template;
		}

		return $template;
	}

}
