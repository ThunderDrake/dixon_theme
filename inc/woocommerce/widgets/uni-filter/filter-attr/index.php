<?php
trait universal_filter_attr
{

	function init_attr()
	{
		add_action('woocommerce_product_query_tax_query', [$this,'apply_filter']);

		$tpath = get_template_directory();
		$cpath = __DIR__;
		$path = get_template_directory_uri().explode($tpath,$cpath)[1];

		wp_register_script( 'filter-attr-slider', $path.'/assets/attr-slider.js', array('filter-nouislider'), $this->version, true );
		if ( is_customize_preview() ) {
			wp_enqueue_script( 'filter-attr-slider' );
		}
	}

	public function apply_filter($tax_query) {
		$_chosen_attributes = $this->get_filter_chosen_attributes();
		if($_chosen_attributes)
		{
			foreach($_chosen_attributes as $key => $values)
			{
				$tax_query[] = array(
					'taxonomy' => $key,
					'field'    => 'slug',
					'terms'    => $values,
					'operator' => 'IN',
					'include_children' => false,
				);
			}
		}
		return $tax_query;
	}

	/**
	 * Get this widgets taxonomy.
	 *
	 * @param array $instance Array of instance options.
	 * @return string
	 */
	protected function get_instance_taxonomies( $instance ) {
		if ( isset( $instance['attributes'] ) ) {
			$all = [];
			foreach ($instance['attributes'] as $term) {
				$all[] = wc_attribute_taxonomy_name( $term );
			}
			return $all;
		}

		$attribute_taxonomies = wc_get_attribute_taxonomies();

		if ( ! empty( $attribute_taxonomies ) ) {
			foreach ( $attribute_taxonomies as $tax ) {
				if ( taxonomy_exists( wc_attribute_taxonomy_name( $tax->attribute_name ) ) ) {
					return wc_attribute_taxonomy_name( $tax->attribute_name );
				}
			}
		}

		return '';
	}

	/**
	 * Get this widgets display type.
	 *
	 * @param array $instance Array of instance options.
	 * @return string
	 */
	protected function get_instance_display_type( $instance ) {
		return isset( $instance['display_type'] ) ? $instance['display_type'] : 'border';
	}

	/**
	 * Get an array of attributes and terms selected with the layered nav widget.
	 *
	 * @return array
	 */
	public function get_filter_chosen_attributes() {
		$_chosen_attributes = array();

		if ( ! empty( $_GET ) ) { // WPCS: input var ok, CSRF ok.
			foreach ( $_GET as $key => $value ) { // WPCS: input var ok, CSRF ok.
				if ( 0 === strpos( $key, 'cf_' ) ) {
					$attribute    = wc_sanitize_taxonomy_name( str_replace( 'cf_', '', $key ) );
					$taxonomy     = wc_attribute_taxonomy_name( $attribute );
					$filter_terms = ! empty( $value ) ? $value : array();
					if(!is_array($filter_terms))
					{
						$filter_terms = array($filter_terms);
					}

					if ( empty( $filter_terms ) || ! taxonomy_exists( $taxonomy ) || ! wc_attribute_taxonomy_id_by_name( $attribute ) ) {
						continue;
					}

					$_chosen_attributes[ $taxonomy ] = array_map( 'sanitize_title', $filter_terms ); // Ensures correct encoding.
				}
			}
		}
		return $_chosen_attributes;
	}

	public function render_attr($args, $instance) // front-end
	{
		$_chosen_attributes = $this->get_filter_chosen_attributes();
		$taxonomies         = $this->get_instance_taxonomies( $instance );
		// $display_type       = $this->get_instance_display_type( $instance );
		$display_type       = 'border';

		if(!$taxonomies)
		{
			return;
		}

		$rtaxes = wc_get_attribute_taxonomies();
		$taxes = [];
		foreach ($rtaxes as $tax) {
			$taxes[$tax->attribute_name] = array(
				'name'    => $tax->attribute_label,
				'display' => $tax->attribute_type
			);
		}

		// wp_enqueue_script( 'filter-attr-slider' );

		foreach ($taxonomies as $taxonomy)
		{
			if ( ! taxonomy_exists( $taxonomy ) ) {
				return;
			}

			$ss = str_replace('pa_', '', $taxonomy);

			$terms = get_terms( $taxonomy, array( 'hide_empty' => '1' ) );

			if ( 0 === count( $terms ) ) {
				return;
			}

			$this->used_filters[] = $ss;

			// $name = apply_filters( 'widget_title', $this->get_instance_title( $instance ), $instance, $this->id_base );
			$name = @$taxes[$ss]['name'];
			$display_type = @$taxes[$ss]['display'];
			$args['name'] = '';
			$args['before_widget'] = '';
			$args['after_widget'] = '';
			$args['before_title'] = '';
			$args['after_title'] = '';
			$instance['title'] = '';

			ob_start();

			$this->widget_start( $args, $instance );

			$found = include 'render.php';

			$this->widget_end( $args );

			// Force found when option is selected - do not force found on taxonomy attributes.
			if ( ! is_tax() && is_array( $_chosen_attributes ) && array_key_exists( $taxonomy, $_chosen_attributes ) ) {
				$found = true;
			}

			if ( ! $found ) {
				ob_end_clean();
			} else {
				echo ob_get_clean(); // @codingStandardsIgnoreLine
			}
		}
	}

	/**
	 * Return the currently viewed taxonomy name.
	 *
	 * @return string
	 */
	protected function get_current_taxonomy() {
		return is_tax() ? get_queried_object()->taxonomy : '';
	}

	/**
	 * Return the currently viewed term ID.
	 *
	 * @return int
	 */
	protected function get_current_term_id() {
		return absint( is_tax() ? get_queried_object()->term_id : 0 );
	}

	/**
	 * Return the currently viewed term slug.
	 *
	 * @return int
	 */
	protected function get_current_term_slug() {
		return absint( is_tax() ? get_queried_object()->slug : 0 );
	}

	/**
	 * Count products within certain terms, taking the main WP query into consideration.
	 *
	 * This query allows counts to be generated based on the viewed products, not all products.
	 *
	 * @param  array  $term_ids Term IDs.
	 * @param  string $taxonomy Taxonomy.
	 * @return array
	 */
	protected function get_filtered_term_product_counts( $term_ids, $taxonomy ) {
		global $wpdb;

		$tax_query  = WC_Query::get_main_tax_query();
		$meta_query = WC_Query::get_main_meta_query();

		foreach ( $tax_query as $key => $query ) {
			if ( is_array( $query ) && $taxonomy === $query['taxonomy'] ) {
				unset( $tax_query[ $key ] );
			}
		}

		$meta_query     = new WP_Meta_Query( $meta_query );
		$tax_query      = new WP_Tax_Query( $tax_query );
		$meta_query_sql = $meta_query->get_sql( 'post', $wpdb->posts, 'ID' );
		$tax_query_sql  = $tax_query->get_sql( $wpdb->posts, 'ID' );

		// Generate query.
		$query           = array();
		$query['select'] = "SELECT COUNT( DISTINCT {$wpdb->posts}.ID ) as term_count, terms.term_id as term_count_id";
		$query['from']   = "FROM {$wpdb->posts}";
		$query['join']   = "
			INNER JOIN {$wpdb->term_relationships} AS term_relationships ON {$wpdb->posts}.ID = term_relationships.object_id
			INNER JOIN {$wpdb->term_taxonomy} AS term_taxonomy USING( term_taxonomy_id )
			INNER JOIN {$wpdb->terms} AS terms USING( term_id )
			" . $tax_query_sql['join'] . $meta_query_sql['join'];

		$query['where'] = "
			WHERE {$wpdb->posts}.post_type IN ( 'product' )
			AND {$wpdb->posts}.post_status = 'publish'"
			. $tax_query_sql['where'] . $meta_query_sql['where'] .
			'AND terms.term_id IN (' . implode( ',', array_map( 'absint', $term_ids ) ) . ')';

		$search = WC_Query::get_main_search_query_sql();
		if ( $search ) {
			$query['where'] .= ' AND ' . $search;
		}

		$query['group_by'] = 'GROUP BY terms.term_id';
		$query             = apply_filters( 'woocommerce_get_filtered_term_product_counts_query', $query );
		$query             = implode( ' ', $query );

		// We have a query - let's see if cached results of this query already exist.
		$query_hash = md5( $query );

		// Maybe store a transient of the count values.
		$cache = apply_filters( 'woocommerce_layered_nav_count_maybe_cache', true );
		if ( true === $cache ) {
			$cached_counts = (array) get_transient( 'wc_layered_nav_counts_' . sanitize_title( $taxonomy ) );
		} else {
			$cached_counts = array();
		}

		if ( ! isset( $cached_counts[ $query_hash ] ) ) {
			$results                      = $wpdb->get_results( $query, ARRAY_A ); // @codingStandardsIgnoreLine
			$counts                       = array_map( 'absint', wp_list_pluck( $results, 'term_count', 'term_count_id' ) );
			$cached_counts[ $query_hash ] = $counts;
			if ( true === $cache ) {
				set_transient( 'wc_layered_nav_counts_' . sanitize_title( $taxonomy ), $cached_counts, DAY_IN_SECONDS );
			}
		}

		return array_map( 'absint', (array) $cached_counts[ $query_hash ] );
	}
}
?>