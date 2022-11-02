<?php
/**
 * Diamond WooCommerce Class
 *
 * @package  diamond
 * @since    2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Diamond_WooCommerce' ) ) :

	/**
	 * The Diamond WooCommerce Integration class
	 */
	class Diamond_WooCommerce {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_action( 'after_setup_theme', array( $this, 'setup' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'reset_wc_scripts' ), 999 );
			add_action( 'wp_enqueue_scripts', array( $this, 'add_diamond_scripts' ) );
			add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
			add_filter( 'product_type_selector', array( $this, 'wc_allow_only_simple_products' ) );
			// add_filter( 'woocommerce_billing_fields', array( $this, 'diamond_billing_fields' ) );
			// add_filter( 'woocommerce_shipping_fields', array( $this, 'diamond_shipping_fields' ) );
			add_filter( 'woocommerce_get_script_data', array( $this, 'diamond_added_to_cart_label' ) );
			// add_filter( 'woocommerce_get_country_locale_base', array( $this, 'diamond_get_country_locale_base' ) );
			// add_action( 'woocommerce_cart_calculate_fees', array( $this, 'add_online_discount') , 10 );
			add_action( 'woocommerce_cart_shipping_total', array( $this, 'diamond_cart_shipping_total') , 10, 2 );
			add_action( 'wp_ajax_woocommerce_quick_buy', array( __CLASS__, 'quick_buy' ) );
			add_action( 'wp_ajax_nopriv_woocommerce_quick_buy', array( __CLASS__, 'quick_buy' ) );
			add_action( 'wc_ajax_quick_buy', array( __CLASS__, 'quick_buy' ) );

			add_action( 'wp_ajax_woocommerce_quick_view', array( __CLASS__, 'quick_view' ) );
			add_action( 'wp_ajax_nopriv_woocommerce_quick_view', array( __CLASS__, 'quick_view' ) );
			add_action( 'wc_ajax_quick_view', array( __CLASS__, 'quick_view' ) );

			// add_filter( 'product_attributes_type_selector', array( $this,'product_attributes_types' ) );
			// add_action( 'woocommerce_product_option_terms', array( $this,'product_option_terms' ), 10, 3 );

			// add_filter( 'woocommerce_cart_needs_payment', '__return_false' );
			// add_filter( 'woocommerce_cart_needs_shipping_address', '__return_false' );

			// add_filter('woocommerce_settings_pages',[$this,'catalog_page_select'],15,1);
			// add_filter('woocommerce_settings_pages',[$this,'online_discount_input'],16,1);

			if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.3', '<' ) ) {
				add_filter( 'loop_shop_per_page', array( $this, 'products_per_page' ) );
			}

			// Integrations.
			add_action( 'diamond_woocommerce_setup', array( $this, 'setup_integrations' ) );

			add_filter( 'woocommerce_template_loader_files', array( $this, 'override_shop_page_template' ), 30, 2 );
		}

		public function product_attributes_types($types)
		{
			$types['range'] = 'Диапазон';
			// $types['select'] = 'Выбор';
			return $types;
		}

		public function product_option_terms($attribute_taxonomy, $i, $attribute)
		{
			if('range' === $attribute_taxonomy->attribute_type)
			{
?>
<select multiple="multiple" data-placeholder="<?php esc_attr_e( 'Select terms', 'woocommerce' ); ?>" class="multiselect attribute_values wc-enhanced-select" name="attribute_values[<?php echo esc_attr( $i ); ?>][]">
	<?php
	$args      = array(
		'orderby'    => ! empty( $attribute_taxonomy->attribute_orderby ) ? $attribute_taxonomy->attribute_orderby : 'name',
		'hide_empty' => 0,
	);
	$all_terms = get_terms( $attribute->get_taxonomy(), apply_filters( 'woocommerce_product_attribute_terms', $args ) );
	if ( $all_terms ) {
		foreach ( $all_terms as $term ) {
			$options = $attribute->get_options();
			$options = ! empty( $options ) ? $options : array();
			echo '<option value="' . esc_attr( $term->term_id ) . '"' . wc_selected( $term->term_id, $options ) . '>' . esc_attr( apply_filters( 'woocommerce_product_attribute_term_name', $term->name, $term ) ) . '</option>';
		}
	}
	?>
</select>
<button class="button plus select_all_attributes"><?php esc_html_e( 'Select all', 'woocommerce' ); ?></button>
<button class="button minus select_no_attributes"><?php esc_html_e( 'Select none', 'woocommerce' ); ?></button>
<button class="button fr plus add_new_attribute"><?php esc_html_e( 'Add new', 'woocommerce' ); ?></button>
<?php
			}
		}

		/**
		 * Sets up theme defaults and registers support for various WooCommerce features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 *
		 * @since 2.4.0
		 * @return void
		 */
		public function setup() {
			add_theme_support(
				'woocommerce', apply_filters(
					'diamond_woocommerce_args', array(
						'single_image_width'    => 480,
						'thumbnail_image_width' => 300,
						'product_grid'          => array(
							'default_columns'   => 3,
							'default_rows'      => 4,
							'min_columns'       => 3,
							'max_columns'       => 3,
							'min_rows'          => 0,
							'max_rows'          => 0,
						),
						// 'featured_block'        => array(
						// 	'default_height'  => 100,
						// ),
					)
				)
			);

			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );

			/**
			 * Add 'diamond_woocommerce_setup' action.
			 *
			 * @since  2.4.0
			 */
			do_action( 'diamond_woocommerce_setup' );

			add_action( 'woocommerce_product_options_sku', array($this,'wc_add_barcode'));
			add_action( 'woocommerce_process_product_meta', array($this,'wc_save_barcode'), 10, 1 );

			add_action( 'woocommerce_product_options_advanced', array($this,'wc_add_video'));
			add_action( 'woocommerce_process_product_meta', array($this,'wc_save_video'), 10, 1 );
		}

		public function override_shop_page_template($a,$b)
		{
			// $shid = wc_get_page_id('shop');
			// if(is_page($shid))
			// {
			// 	$a[] = 'front-page.php';
			// }
			// return $a;
		}


		/**
		 * Query WooCommerce Extension Activation.
		 *
		 * @param string $extension Extension class name.
		 * @return boolean
		 */
		public function is_woocommerce_extension_activated( $extension = 'WC_Bookings' ) {
			return class_exists( $extension ) ? true : false;
		}
 
		public function wc_allow_only_simple_products( $types )
		{
			foreach($types as $type => $name)
			{
				if($type != 'simple')
				{
					unset($types[$type]);
				}
			}
			return $types;
		}

		public function wc_add_barcode()
		{
			global $thepostid, $product_object;
			woocommerce_wp_text_input(
				array(
					'id'          => '_barcode',
					'value'       => get_post_meta($thepostid, '_barcode',true),
					'label'       => 'Штрихкод',
				)
			);
		}

		public function wc_save_barcode($post_id)
		{
			if(isset($_POST['_barcode']))
			{
				update_post_meta($post_id, '_barcode', esc_attr($_POST['_barcode']));
			}
			else
			{
				update_post_meta($post_id, '_barcode', '');
			}
		}

		public function wc_add_video()
		{
			global $thepostid, $product_object;
			woocommerce_wp_text_input(
				array(
					'id'          => '_video',
					'value'       => get_post_meta($thepostid, '_video',true),
					'label'       => 'Ссылка на видео',
				)
			);
		}

		public function wc_save_video($post_id)
		{
			if(isset($_POST['_video']))
			{
				update_post_meta($post_id, '_video', esc_attr($_POST['_video']));
			}
			else
			{
				update_post_meta($post_id, '_video', '');
			}
		}

		/**
		 * Assign styles to individual theme mod.
		 *
		 * @deprecated 2.3.1
		 * @since 2.1.0
		 * @return void
		 */
		public function set_diamond_style_theme_mods() {
			if ( function_exists( 'wc_deprecated_function' ) ) {
				wc_deprecated_function( __FUNCTION__, '2.3.1' );
			} else {
				_deprecated_function( __FUNCTION__, '2.3.1' );
			}
		}

		/**
		 * Products per page
		 *
		 * @return integer number of products
		 * @since  1.0.0
		 */
		public function products_per_page() {
			return intval( apply_filters( 'diamond_products_per_page', 12 ) );
		}

		/**
		 * Remove standart WC js.
		 *
		 * @return void
		 */
		public function reset_wc_scripts()
		{
			remove_action('wp_head', array($GLOBALS['woocommerce'], 'generator'));
			// wp_dequeue_script('selectWoo');
			// wp_dequeue_script('wc-cart-fragments');
			// wp_dequeue_script('wc-add-to-cart');
			// wp_dequeue_script('wc-add-to-cart-variation');
			// wp_dequeue_style('select2');
			wp_dequeue_script('zoom');
			wp_dequeue_script('flexslider');
			wp_dequeue_script('photoswipe-ui-default');
			wp_dequeue_style('photoswipe-default-skin');
			remove_action('wp_footer', 'woocommerce_photoswipe');
			wp_dequeue_script('wc-single-product');
			// wp_dequeue_style('woocommerce-inline');
		}

		public function add_diamond_scripts()
		{
			global $post;
			global $GS;
			$URL_path = $GS->theme_uri;
			$FS_path = $GS->theme;

			if(!did_action( 'before_woocommerce_init'))
			{
				return;
			}

			$_scripts = array();
			$_styles = array();
			// $theme_uri = get_template_directory_uri().'/';

			if(is_product() || ( !empty($post->post_content) && strstr($post->post_content,'[product_page') ))
			{
				$_scripts['swiper'] = array(
					'src'     => $URL_path.'/assets/js/swiper.js',
					'deps'    => array('jquery'),
					'version' => $GS->asset_version($FS_path.'/assets/js/swiper.js', 'js'),
				);
				$_scripts['product'] = array(
					'src'     => $URL_path.'/assets/js/product.js',
					'deps'    => array('jquery','swiper'),
					'version' => $GS->asset_version($FS_path.'/assets/js/product.js', 'js'),
				);

				$_styles['swiper'] = array(
					'src'     => $URL_path.'/assets/css/addons/swiper.css',
					'deps'    => array(''),
					'version' => $GS->asset_version($FS_path.'/assets/css/addons/swiper.css', 'js'),
				);
			}

			foreach($_scripts as $name => $props)
			{
				wp_register_script( $name, $props['src'], $props['deps'], $props['version'], true );
				wp_enqueue_script( $name );
			}
			foreach($_styles as $name => $props)
			{
				wp_register_style( $name, $props['src'], $props['deps'], $props['version'], 'all' );
				wp_enqueue_style( $name );
			}
		}

		public function diamond_get_country_locale_base($array)
		{
			$array['state']['label'] = 'Город';
			return $array;
		}

		public function diamond_added_to_cart_label($array)
		{
			if(is_array($array))
			{
				$array['i18n_view_cart'] = 'В корзине';
				if(is_product())
				{
					$array['cart_url'] = wc_get_cart_url();
				}
			}
			return $array;
		}

		public function online_discount_input($options)
		{
			$compare = array(
				array(
					'title'    => 'Скидка при оплате онлайн, %',
					'id'       => 'woocommerce_online_discount',
					'type'     => 'text',
					'default'  => '5',
					'desc_tip' => true,
				)
			);
			array_splice($options, 7, 0, $compare);
			return $options;
		}
		public function catalog_page_select($options)
		{
			$compare = array(
				array(
					'title'    => 'Страница каталога',
					'id'       => 'woocommerce_catalog_page_id',
					'default'  => '',
					'class'    => 'wc-enhanced-select-nostd',
					'css'      => 'min-width:300px;',
					'type'     => 'single_select_page',
					'desc_tip' => false,
				)
			);
			array_splice($options, 6, 0, $compare);
			return $options;
		}

		public function add_online_discount($cart)
		{
			if ( is_admin() && ! defined( 'DOING_AJAX' ) || is_cart() ) {
				return;
			}

			$no_discount = array('cod','colp');

			$online_discount = intval(get_option('woocommerce_online_discount',5));

			if($online_discount > 0)
			{
				$online_discount = $online_discount / 100;

				if (!in_array(WC()->session->chosen_payment_method,$no_discount))
				{
					$cart->add_fee('Скидка при оплате онлайн', - $cart->cart_contents_total * $online_discount );
				}
			}
		}

		public function diamond_cart_shipping_total($total, $cart)
		{
			if($cart->get_shipping_total() == 0)
			{
				return 0;
			}
			return $total;
		}

		public function diamond_billing_fields($fields)
		{
			// var_dump($fields);
			unset($fields['billing_last_name']);
			unset($fields['billing_company']);
			unset($fields['billing_country']);
			unset($fields['billing_address_1']);
			unset($fields['billing_address_2']);
			unset($fields['billing_city']);
			unset($fields['billing_postcode']);
			unset($fields['billing_state']);

			return $fields;
		}

		public function diamond_shipping_fields($fields)
		{
			unset($fields['shipping_first_name']);
			unset($fields['shipping_last_name']);
			unset($fields['shipping_company']);
			unset($fields['shipping_city']);
			unset($fields['shipping_address_1']);
			unset($fields['shipping_address_2']);
			unset($fields['shipping_postcode']);
			$fields['shipping_country']['type'] = 'hidden';
			$fields['shipping_state']['label'] = 'Город';

			$chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
			$chosen_shipping = $chosen_methods[0];
			$chosen_shipping = preg_split('/\:/', $chosen_shipping);
			$chosen_shipping = array_shift($chosen_shipping);

			if($chosen_shipping == 'rfmail')
			{
				$fields['shipping_first_name'] = array(
					'label'       => 'ФИО',
					'placeholder' => '',
					'required'    => true,
					'class'       => array(''),
					'clear'       => false
				);
				$fields['shipping_postcode'] = array(
					'label'       => 'Почтовый индекс',
					'placeholder' => '',
					'required'    => true,
					'class'       => array(''),
					'clear'       => false
				);
				$fields['shipping_address_1'] = array(
					'label'       => 'Адрес',
					'type'        => 'textarea',
					'placeholder' => '',
					'required'    => true,
					'class'       => array('address-field'),
					'clear'       => false
				);
			}

			if($chosen_shipping == 'courier')
			{
				$fields['shipping_address_1'] = array(
					'label'       => 'Адрес',
					'type'        => 'textarea',
					'placeholder' => '',
					'required'    => true,
					'class'       => array('address-field'),
					'clear'       => false
				);
			}


			if($chosen_shipping == 'pickpoint')
			{
				$fields['shipping_address_1_selected'] = array(
					'label'       => false,
					'type'        => 'checkbox',
					'placeholder' => '',
					'required'    => true,
					'class'       => array('address-field'),
					'clear'       => false
				);
				$fields['shipping_address_1'] = array(
					'label'       => 'Постамат',
					'type'        => 'hidden',
					'placeholder' => '',
					'required'    => false,
					'class'       => array('address-field'),
					'clear'       => false
				);
			}


			if($chosen_shipping == 'local_pickup_extended')
			{
				$shipping_method = $chosen_methods[0];
				$shipping_method = 'woocommerce_'.preg_replace('/\:/', '_', $shipping_method).'_settings';
				$shipping_method_data = get_option( $shipping_method );
				if($shipping_method_data)
				{
					$locations = $shipping_method_data["locations"];
					$locations = preg_split('/\r\n|\r|\n/', $locations);
					if(!empty($locations))
					{
						$options = array(''=>'Выберите адрес');
						foreach ($locations as $location)
						{
							$options[$location] = $location;
						}
						$fields['shipping_address_1'] = array(
							'label'       => 'Адрес самовывоза',
							'type'        => 'select',
							'placeholder' => '',
							'options'     => $options,
							'required'    => true,
							'class'       => array(''),
							'clear'       => false
						);
					}
				}
			}

			return $fields;
		}

		/*
		|--------------------------------------------------------------------------
		| Integrations.
		|--------------------------------------------------------------------------
		*/

		/**
		 * Sets up integrations.
		 *
		 * @since  2.3.4
		 *
		 * @return void
		 */
		public function setup_integrations() {

			if ( $this->is_woocommerce_extension_activated( 'WC_Bundles' ) ) {
				add_filter( 'woocommerce_bundled_table_item_js_enqueued', '__return_true' );
				add_filter( 'woocommerce_bundles_group_mode_options_data', array( $this, 'bundles_group_mode_options_data' ) );
			}

			if ( $this->is_woocommerce_extension_activated( 'WC_Composite_Products' ) ) {
				add_filter( 'woocommerce_composited_table_item_js_enqueued', '__return_true' );
				add_filter( 'woocommerce_display_composite_container_cart_item_data', '__return_true' );
			}
		}

		/**
		 * Add "Includes" meta to parent cart items.
		 * Displayed only on handheld/mobile screens.
		 *
		 * @since  2.3.4
		 *
		 * @param  array $group_mode_data Group mode data.
		 * @return array
		 */
		public function bundles_group_mode_options_data( $group_mode_data ) {
			$group_mode_data['parent']['features'][] = 'parent_cart_item_meta';

			return $group_mode_data;
		}

		public static function quick_buy() {
			ob_start();

			$product_id        = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
			$product           = wc_get_product( $product_id );
			$quantity          = empty( $_POST['quantity'] ) ? 1 : wc_stock_amount( $_POST['quantity'] );
			$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );
			$product_status    = get_post_status( $product_id );
			$variation_id      = 0;
			$variation         = array();

			if ( $product && 'variation' === $product->get_type() ) {
				$variation_id = $product_id;
				$product_id   = $product->get_parent_id();
				$variation    = $product->get_variation_attributes();
			}

			if ( $passed_validation && false !== WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variation ) && 'publish' === $product_status ) {

				$data = array(
					'error'       => false,
					'target_url'  => wc_get_checkout_url(),
				);

			} else {

				$data = array(
					'error'       => true,
					'target_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id ),
				);

			}
			wp_send_json( $data );
		}

		public static function quick_view() {

			global $product;

			$product_id        = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
			$product           = wc_get_product( $product_id );

			if ( $product && 'variation' === $product->get_type() ) {
				$variation_id = $product_id;
				$product_id   = $product->get_parent_id();
				$variation    = $product->get_variation_attributes();
			}

			$data = array(
				'title' => get_the_title($product_id),
			);

			ob_start();

			wc_get_template( 'content-product_quick_view.php', array(
				'product' => $product,
			) );

			$data['html'] = ob_get_clean();

			wp_send_json( $data );
		}
	}

endif;

return new Diamond_WooCommerce();
