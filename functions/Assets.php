<?php

namespace Dixon;

class Assets {

	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'attach_assets' ] );
	}

	public function attach_assets() {
		// HTML Love
		$this->attach_style( '/static/css/vendor.css' );
		if(is_front_page() || is_page_template( ['templates/credit-page/credit-page.php', 'templates/delivery-page/delivery-page.php', 'templates/contact-page/contact-page.php', 'templates/callback-page/callback-page.php', 'templates/wishlist-page/wishlist-page.php'] ) || is_page(['privacy-policy', 'offer', 'register']) || is_account_page() || $_GET['wc-api']==='wc_rsbpayment'){
			$this->attach_style( '/static/css/main.css' );
		}
		if(is_page_template('templates/about-page/about-page.php')) {
			$this->attach_style( '/static/css/about.css' );
		}
		if(is_page_template('templates/questionary-page/questionary-page.php')) {
			$this->attach_style( '/static/css/questionary.css' );
		}
		if(is_product()) {
			$this->attach_style( '/static/css/product-single.css' );
		}

		if(is_shop() || is_product_category() || is_product_tag() || is_page_template('templates/wishlist-page/wishlist-page.php')) {
			$this->attach_style( '/static/css/product.css' );
		}

		if(is_page('questionary')) {
			$this->attach_style( '/static/css/questionary.css' );
		}

		if(is_page_template('templates/vacancy-page/vacancy-page.php')) {
			$this->attach_style( '/static/css/vacancy.css' );
		}

		if(is_page_template('templates/review-page/review-page.php')) {
			$this->attach_style( '/static/css/reviews.css' );
		}

		if(is_page_template('templates/repair-page/repair-page.php')) {
			$this->attach_style( '/static/css/repair-page.css' );
		}

		if(is_page_template('templates/repair-status/repair-status.php')) {
			$this->attach_style( '/static/css/status-page.css' );
		}

		if(is_post_type_archive('models')) {
			$this->attach_style( '/static/css/pricelist.css' );
			$this->attach_script( '/static/js/pricelist-change.js' );
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
		$this->attach_script( '/static/js/cart-item-remove-ajax.js' );
		$this->attach_script( '/static/js/product-sort.js' );

		// // Custom
		$this->attach_style( '/custom/custom.css' );
		$this->attach_style( '/custom/custom-select.css' );
		$this->attach_script( '/custom/jquery.custom-select.min.js' );
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
