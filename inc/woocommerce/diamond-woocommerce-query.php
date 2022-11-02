<?php
if(!session_id())
{
	session_start();
}

#add_filter('woocommerce_get_catalog_ordering_args', 'diamond_memorize_products_sorting', 999);

function diamond_memorize_products_sorting($args=null)
{
	$ret = $args;

	global $diamond_memorize_products_sorting_applied;

	if(!$diamond_memorize_products_sorting_applied)
	{
		$diamond_memorize_products_sorting_applied = true;

		if(!isset($_GET['sorting']))
		{
			if(!isset($_SESSION['sorting']))
			{
				$_SESSION['sorting'] = $args;
			}
		}
		else
		{
			preg_match('/(?P<orderby>[^_]+)_*(?P<order>\w+)*/', $_GET['sorting'], $sorting);
			if( !isset($sorting['orderby']) )
			{
				return $ret;
			}
			if( !isset($sorting['order']) )
			{
				$sorting['order'] = 'ASC';
			}
			$_SESSION['sorting']['orderby'] = strtolower( wc_clean( (string) wp_unslash( $sorting['orderby'] ) ) );
			$_SESSION['sorting']['order'] = strtoupper( wc_clean( (string) wp_unslash( $sorting['order'] ) ) );
		}

		WC()->query->remove_ordering_args();
		$ret = WC()->query->get_catalog_ordering_args($_SESSION['sorting']['orderby'],$_SESSION['sorting']['order']);
	}


	return $ret;
}

function diamond_get_search_query()
{
	if(isset($_GET['query']))
	{
		return esc_html( $_GET['query'] );
	}
	else
	{
		return '';
	}
}

function diamond_search_query()
{
	global $wp_query;
	$q = $_GET['query'];
	$page_num = isset($_GET['product-page']) ? intval($_GET['product-page']) : 1;
	$params = array(
		'_meta_or_title'      => $q,
		'post_type'           => 'product',
		'fields'              => 'ids',
		'ignore_sticky_posts' => true,
		'no_found_rows'       => false,
		'posts_per_page'      => apply_filters( 'loop_shop_per_page', wc_get_default_products_per_row() * wc_get_default_product_rows_per_page() ),
		'paged'               => max(1,$page_num),
		'meta_query'          => array(
			array(
				'relation' => 'OR',
				array(
					'key'     => '_barcode',
					'value'   => $q,
					'compare' => 'LIKE',
				),
				array(
					'key'     => '_sku',
					'value'   => $q,
					'compare' => 'LIKE',
				),
			),
			// array(
			// 	'key'     => '_stock',
			// 	'value'   => '0',
			// 	'compare' => '>',
			// 	'type' => 'DECIMAL'
			// ),
		),
	);
	$product_visibility_terms  = wc_get_product_visibility_term_ids();
	if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) ) {
		$params['tax_query'] = array(
			array(
				'taxonomy' => 'product_visibility',
				'field'    => 'term_taxonomy_id',
				'terms'    => $product_visibility_terms['outofstock'],
				'operator' => 'NOT IN',
			)
		);
	}
	$wp_query = new WP_Query($params);
	$wp_query->is_search = true;
	$wp_query->set('s', $q);
	wc_setup_loop(
		array(
			'columns'      => wc_get_default_products_per_row(),
			'name'         => 'custom_search_query',
			'is_shortcode' => true,
			'is_search'    => true,
			'is_paginated' => true,
			'total'        => $wp_query->found_posts,
			'total_pages'  => $wp_query->max_num_pages,
			'per_page'     => apply_filters( 'loop_shop_per_page', wc_get_default_products_per_row() * wc_get_default_product_rows_per_page() ),
			'current_page' => get_query_var('paged'),
		)
	);
}

// add_action( 'pre_get_posts', function( $q )
// {
//     if($title = $q->get('_meta_or_title'))
//     {
//         add_filter( 'get_meta_sql', function($sql) use ($title)
//         {
//             global $wpdb;

//             // Only run once:
//             static $nr = 0; 
//             if( 0 != $nr++ ) return $sql;

//             // Modify WHERE part:
//             $sql['where'] = sprintf(
//                 " AND ( %s OR %s ) ",
//                 $wpdb->prepare( "{$wpdb->posts}.post_title LIKE '%s'", '%'.$title.'%' ),
//                 mb_substr( $sql['where'], 5, mb_strlen( $sql['where'] ) )
//             );
//             return $sql;
//         });
//     }
// }, 500);
?>