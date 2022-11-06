<?php

namespace Dixon;

class Assets {

	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'attach_assets' ] );
	}

	public function attach_assets() {
		// HTML Love
		$this->attach_style( '/static/css/vendor.css' );
		if(is_front_page()){
			$this->attach_style( '/static/css/main.css' );
		}
		if(is_page('about')) {
			$this->attach_style( '/static/css/about.css' );
		}
		if(is_product()) {
			$this->attach_style( '/static/css/product-single.css' );
		}

		if(is_shop() || is_product_category() || is_product_tag()) {
			$this->attach_style( '/static/css/product.css' );
		}

		if(is_page('questionary')) {
			$this->attach_style( '/static/css/questionary.css' );
		}

		if(is_page('vacancy')) {
			$this->attach_style( '/static/css/vacancy.css' );
		}

		if(is_cart()) {
			$this->attach_style( '/static/css/cart.css' );
		}

		if(is_checkout()) {
			$this->attach_style( '/static/css/checkout.css' );
		}
		$this->attach_script( '/static/js/main.js' );
		// $this->attach_script( '/static/js/add-to-cart-variation.min.js' );
		$this->attach_script( '/static/js/radio-variation.js' );

		// // Custom
		$this->attach_style( '/custom/custom.css' );
		// $this->attach_script( '/custom/custom.js' );
	}

	private function attach_style( $path, $deps = [] ) {
		wp_enqueue_style( $this->get_handle( $path ), $this->get_url( $path ), $deps, $this->get_ver( $path ) );
	}

	private function attach_script( $path, $deps = [] ) {
		wp_enqueue_script( $this->get_handle( $path ), $this->get_url( $path ), $deps, $this->get_ver( $path ), true );
	}

	private function get_handle( $path ) {
		return sanitize_title( $path );
	}

	private function get_url( $path ) {
		return wp_normalize_path( get_theme_file_uri( $path ) );
	}

	private function get_ver( $path ) {
		return filemtime( get_theme_file_path( $path ) );
	}

}
