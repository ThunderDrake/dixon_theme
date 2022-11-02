<?php


namespace Dixon;


class Site {

	private static $instance;

	private $static_url;

	private function __construct() {
		$this->static_url = esc_url( get_template_directory_uri() . '/static/' );
	}

	public static function getInstance(): Site {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function get_static_url(): string {
		return $this->static_url;
	}

	public function hooks(): void {
		// Задаёт основные настройки темы.
		add_action( 'after_setup_theme', function () {
			add_theme_support( 'title-tag' );
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'menus' );
			add_theme_support( 'woocommerce' );
		} );
	}

	/**
	 * @param array $args
	 */
	public function header( $args = [] ) {
		$args = array_merge(
			[ 'class' => null, 'tpl' => null ],
			$args
		);

		$name = $args['tpl'] ?: '/parts/header.php';
		do_action( 'get_header', $name, $args );

		add_filter( 'ct_body_class', function ( $classes = [] ) use ( $args ) {
			$classes[] = $args['class'];

			return $classes;
		} );

		$this->template( $name );
	}

	public function footer( $args = [] ) {
		$name = '/parts/footer.php';

		do_action( 'get_footer', $name, $args );

		$this->template( $name );
	}

	public function template( $slug, $args = [] ): void {
		get_template_part( str_replace( '.php', '', "/templates/$slug" ), null, $args );
	}

}
