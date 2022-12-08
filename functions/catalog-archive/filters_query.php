<?php
/**
 * @param WP_Query $query
 */
function modify_query_product_archive_by_filter_params( $query ) {
	if ( ! is_admin() && $query->is_main_query() && $query->is_tax() ) {

		$metas = [];
		$prod_attr = wc_get_attribute_taxonomies();
		foreach($prod_attr as $tax):
			$name = $tax->attribute_name;
			if ( get_param_ids_for_filter( $name ) ) {
				$metas = array_merge(
				$metas,
				array_merge(
					[ 'relation' => 'OR' ],
					array_map(
						static function ( $id ) use($name) {
						return [
							'taxonomy' => 'pa_' . $name,
							'terms'    => sprintf( '%s', $id )
						];
						},
						get_param_ids_for_filter( $name )
					)
					),
				);
			}
		endforeach;

		if ( $metas ) {
			$query->set( 'tax_query', [
				'relation' => 'AND',
				array(
					'taxonomy' => 'product_visibility',
					'field' => 'term_taxonomy_id',
					'terms' => array(),
					'operator' => 'NOT IN'
				),
				$metas,
			] );
		}

	}
	if ( ! is_admin() && $query->is_main_query() && !$query->is_tax()) {
		$metas = [];
		$prod_attr = wc_get_attribute_taxonomies();
		foreach($prod_attr as $tax):
			$name = $tax->attribute_name;
			if ( get_param_ids_for_filter( $name ) ) {
				$metas = array_merge(
				$metas,
				array_merge(
					[ 'relation' => 'OR' ],
					array_map(
						static function ( $id ) use($name) {
						return [
							'taxonomy' => 'pa_' . $name,
							'terms'    => sprintf( '%s', $id )
						];
						},
						get_param_ids_for_filter( $name )
					)
					),
				);
			}
		endforeach;
		
		if ( $metas ) {
			$query->set( 'tax_query', [
				'relation' => 'OR',
				$metas,
			] );
		}
	}
}

add_action( 'pre_get_posts', 'modify_query_product_archive_by_filter_params' );


add_action( 'pre_get_posts', 'custom_pre_get_posts_query' );

function custom_pre_get_posts_query( $q ) {

	if ( ! $q->is_main_query() ) return;
	if ( ! $q->is_post_type_archive() ) return;
	if ( ! is_admin() ) {

	$q->set( 'meta_query', array(array(
		'key'       => '_stock_status',
		'value'     => 'outofstock',
		'compare'   => 'NOT IN'
	)));
	}
	remove_action( 'pre_get_posts', 'custom_pre_get_posts_query' );

}