<?php
trait universal_filter_price
{
	function init_price()
	{
		$tpath = get_template_directory();
		$cpath = __DIR__;
		$path = get_template_directory_uri().explode($tpath,$cpath)[1];

		wp_register_script( 'filter-price-slider', $path.'/assets/price-slider.js', array('filter-nouislider','filter-wnumb'), $this->version, true );

		$currency = get_woocommerce_currency_symbol();
		$currency_pos = get_option( 'woocommerce_currency_pos' );

		switch ( $currency_pos ) {
			case 'left':
				$format = array('suffix'=>'','prefix'=>$currency);
				break;
			case 'right':
				$format = array('suffix'=>$currency,'prefix'=>'');
				break;
			case 'left_space':
				$format = array('suffix'=>'','prefix'=>$currency.'&nbsp;');
				break;
			case 'right_space':
				$format = array('suffix'=>'&nbsp;'.$currency,'prefix'=>'');
				break;
		}

		wp_localize_script(
			'filter-price-slider',
			'filter_price_slider_params',
			array(
				'currency_format_num_decimals' => esc_attr( wc_get_price_decimals() ),
				'currency_format_decimal_sep'  => esc_attr( wc_get_price_decimal_separator() ),
				'currency_format_thousand_sep' => esc_attr( wc_get_price_thousand_separator() ),
				'currency_format'              => $format,
			)
		);


		if ( is_customize_preview() ) {
			wp_enqueue_script( 'filter-price-slider' );
		}
	}

	/**
	 * Output widget.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args     Arguments.
	 * @param array $instance Widget instance.
	 */
	public function render_price( $args, $instance ) {
		global $wp;

		// Requires lookup table added in 3.6.
		if ( version_compare( get_option( 'woocommerce_db_version', null ), '3.6', '<' ) ) {
			return;
		}

		if ( ! is_shop() && ! is_product_taxonomy() ) {
			return;
		}

		// If there are not posts and we're not filtering, hide the widget.
		if ( ! WC()->query->get_main_query()->post_count && ! isset( $_GET['min_price'] ) && ! isset( $_GET['max_price'] ) ) { // WPCS: input var ok, CSRF ok.
			return;
		}

		// Round values to nearest 10 by default.
		$step = max( apply_filters( 'woocommerce_price_filter_widget_step', 10 ), 1 );

		// Find min and max price in current result set.
		$prices    = $this->get_filtered_price();
		$min_price = $prices->min_price;
		$max_price = $prices->max_price;

		// Check to see if we should add taxes to the prices if store are excl tax but display incl.
		$tax_display_mode = get_option( 'woocommerce_tax_display_shop' );

		if ( wc_tax_enabled() && ! wc_prices_include_tax() && 'incl' === $tax_display_mode ) {
			$tax_class = apply_filters( 'woocommerce_price_filter_widget_tax_class', '' ); // Uses standard tax class.
			$tax_rates = WC_Tax::get_rates( $tax_class );

			if ( $tax_rates ) {
				$min_price += WC_Tax::get_tax_total( WC_Tax::calc_exclusive_tax( $min_price, $tax_rates ) );
				$max_price += WC_Tax::get_tax_total( WC_Tax::calc_exclusive_tax( $max_price, $tax_rates ) );
			}
		}

		$min_price = floor( $min_price / $step ) * $step;
		$max_price = ceil( $max_price / $step ) * $step;

		// if($min_price < 1)
		// {
		// 	$min_price = 1;
		// }

		if ( $min_price === $max_price ) {
			return;
		}

		$current_min_price = isset( $_GET['min_price'] ) ? floor( floatval( wp_unslash( $_GET['min_price'] ) ) / $step ) * $step : $min_price; // WPCS: input var ok, CSRF ok.
		$current_max_price = isset( $_GET['max_price'] ) ? ceil( floatval( wp_unslash( $_GET['max_price'] ) ) / $step ) * $step : $max_price; // WPCS: input var ok, CSRF ok.

		// $name = apply_filters( 'widget_title', $this->get_instance_title( $instance ), $instance, $this->id_base );
		$name = 'Цена';
		$args['name'] = '';
		$args['before_widget'] = '';
		$args['after_widget'] = '';
		$args['before_title'] = '';
		$args['after_title'] = '';
		$instance['title'] = '';

		wp_enqueue_script( 'filter-price-slider' );
		// wp_enqueue_style( 'cosmo-price-slider' );

		$this->widget_start( $args, $instance );

		// array(
		// 	'step'              => $step,
		// 	'min_price'         => $min_price,
		// 	'max_price'         => $max_price,
		// 	'current_min_price' => $current_min_price,
		// 	'current_max_price' => $current_max_price,
		// )
		include 'render.php';

		$this->widget_end( $args );
	}

	/**
	 * Get filtered min price for current products.
	 *
	 * @return int
	 */
	// protected function get_filtered_price() {
	// 	global $wpdb;

	// 	$tax_query = WC()->query->get_main_tax_query();

	// 	foreach($tax_query as $key => $value)
	// 	{
	// 		if(isset($tax_query[$key]['taxonomy']))
	// 		{
	// 			if( 0 === strpos( $tax_query[$key]['taxonomy'], 'pa_' ) )
	// 			{
	// 				unset($tax_query[$key]);
	// 			}
	// 		}
	// 	}

	// 	$tax_query  = new WP_Tax_Query( $tax_query );
	// 	$search     = WC_Query::get_main_search_query_sql();

	// 	$tax_query_sql    = $tax_query->get_sql( $wpdb->posts, 'ID' );
	// 	$search_query_sql = $search ? ' AND ' . $search : '';

	// 	$sql = "
	// 		SELECT min( min_price ) as min_price, MAX( max_price ) as max_price
	// 		FROM {$wpdb->wc_product_meta_lookup}
	// 		WHERE product_id IN (
	// 			SELECT ID FROM {$wpdb->posts}
	// 			" . $tax_query_sql['join']  . "
	// 			WHERE {$wpdb->posts}.post_type IN ('" . implode( "','", array_map( 'esc_sql', apply_filters( 'woocommerce_price_filter_post_type', array( 'product' ) ) ) ) . "')
	// 			AND {$wpdb->posts}.post_status = 'publish'
	// 			" . $tax_query_sql['where'] . $search_query_sql . '
	// 		)';

	// 	// $sql = apply_filters( 'woocommerce_price_filter_sql', $sql, $meta_query_sql, $tax_query_sql );

	// 	return $wpdb->get_row( $sql ); // WPCS: unprepared SQL ok.
	// }
	protected function get_filtered_price() {
		global $wpdb;

		$args       = WC()->query->get_main_query()->query_vars;
		$tax_query  = isset( $args['tax_query'] ) ? $args['tax_query'] : array();
		$meta_query = isset( $args['meta_query'] ) ? $args['meta_query'] : array();

		if ( ! is_post_type_archive( 'product' ) && ! empty( $args['taxonomy'] ) && ! empty( $args['term'] ) ) {
			$tax_query[] = WC()->query->get_main_tax_query();
		}

		foreach ( $meta_query + $tax_query as $key => $query ) {
			if ( ! empty( $query['price_filter'] ) || ! empty( $query['rating_filter'] ) ) {
				unset( $meta_query[ $key ] );
			}
		}

		$meta_query = new WP_Meta_Query( $meta_query );
		$tax_query  = new WP_Tax_Query( $tax_query );
		$search     = WC_Query::get_main_search_query_sql();

		$meta_query_sql   = $meta_query->get_sql( 'post', $wpdb->posts, 'ID' );
		$tax_query_sql    = $tax_query->get_sql( $wpdb->posts, 'ID' );
		$search_query_sql = $search ? ' AND ' . $search : '';

		$sql = "
			SELECT min( min_price ) as min_price, MAX( max_price ) as max_price
			FROM {$wpdb->wc_product_meta_lookup}
			WHERE product_id IN (
				SELECT ID FROM {$wpdb->posts}
				" . $tax_query_sql['join'] . $meta_query_sql['join'] . "
				WHERE {$wpdb->posts}.post_type IN ('" . implode( "','", array_map( 'esc_sql', apply_filters( 'woocommerce_price_filter_post_type', array( 'product' ) ) ) ) . "')
				AND {$wpdb->posts}.post_status = 'publish'
				" . $tax_query_sql['where'] . $meta_query_sql['where'] . $search_query_sql . '
			)';

		$sql = apply_filters( 'woocommerce_price_filter_sql', $sql, $meta_query_sql, $tax_query_sql );

		return $wpdb->get_row( $sql ); // WPCS: unprepared SQL ok.
	}
}
?>