<?php
/**
 * @param WP_Query $query
 */
function modify_query_product_archive_by_filter_params( $query ) {
	if ( ! is_admin() && $query->is_main_query() ) {
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