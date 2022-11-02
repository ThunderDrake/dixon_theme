<?php
class DiamondSliderProductsBlock
{
	public function __construct()
	{
		$tpath = get_template_directory();
		$this->cpath = __DIR__;
		$this->path = explode($tpath,$this->cpath)[1];
		add_action('acf/init', array($this, '_register'));
	}

	public function _register()
	{
		acf_register_block_type(
			array(
				'name'              => 'products-slider-block',
				'title'             => 'Слайдер товаров',
				'description'       => 'Слайдер товаров по метке',
				'post_types'        => array('post', 'page'),
				'render_callback'   => array($this, '_render'),
				'category'          => 'diamond-template-blocks',
				'icon'              => '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 240 240" xml:space="preserve"><path d="M0,209C0,149.7,0,90.4,0,31c80,0,159.9,0,240,0c0,59.3,0,118.7,0,178C160,209,80,209,0,209z M19.7,189.7c67,0,133.8,0,200.6,0c0-46.6,0-93,0-139.4c-66.9,0-133.7,0-200.6,0C19.7,96.8,19.7,143.2,19.7,189.7z"/><path d="M169.4,120c-5.2-6.5-10.3-12.8-15.7-19.4c5-4.1,10.1-8.2,15.3-12.3c8.5,10.5,17,21.1,25.6,31.7c-8.5,10.5-17,21.1-25.5,31.6c-5-4-10-8.1-15.3-12.3C159,132.9,164.1,126.5,169.4,120z"/><path d="M45.5,120c8.6-10.6,17-21.1,25.6-31.7c5,4,10.1,8.1,15.3,12.3c-5.3,6.5-10.4,12.9-15.7,19.4c5.2,6.5,10.4,12.9,15.6,19.4c-5.2,4.1-10.2,8.2-15.3,12.3C62.5,141.2,54.1,130.7,45.5,120z"/></svg>',
				'mode'              => 'edit',
				'align'             => false,
				'supports'          => array(
					'align' => false,
					'mode'  => false,
				),
				'enqueue_assets'    => array($this, '_enqueue_assets'),
			)
		);
	}

	public function _enqueue_assets()
	{
		global $GS;
		wp_enqueue_script('swiper', $GS->theme_uri.'/assets/js/swiper.js', array('jquery'));
		wp_enqueue_style('swiper', $GS->theme_uri.'/assets/css/addons/swiper.css', array());
		
		$version = $GS->asset_version($this->cpath.'/block.css');
		wp_enqueue_style('products-slider-block',$GS->theme_uri.$this->path.'/block.css',array(),$version);
	}

	public function _set_product_as_visible()
	{
		return true;
	}

	public function _slider_start()
	{
		return;
	}

	public function _slider_end()
	{
		return;
	}

	public function _render($block, $content = '', $is_preview = false)
	{
		$title = get_field('title');

		$payload = array(
			// 'block'      => $block,
			// 'content'    => $content,
			'title'      => $title,
			'products'   => $this->_queue($is_preview),
			'slider_id'  => $block['id']
		);
		extract($payload);
		include 'render.php';
	}

	private function _queue($is_preview)
	{
		$count = get_field('count');
		if(!$count) { $count = 24; }
		if($is_preview) { $count = 24; }
		$mode = get_field('mode');

		$query_args = array(
			'post_type'           => 'product',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'no_found_rows'       => false,
			'posts_per_page'      => $count,
			'orderby'             => 'title',   // menu_order, title, date, rand, price, popularity, rating, or id.
			'order'               => 'ASC',
			'fields'              => 'ids',
			'tax_query'           => array(
				'relation'            => 'AND',
			)
		);

		$product_visibility_terms  = wc_get_product_visibility_term_ids();
		$product_visibility_not_in = array( $product_visibility_terms['exclude-from-catalog'] );

		if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) ) {
			$product_visibility_not_in[] = $product_visibility_terms['outofstock'];
		}

		$query_args['tax_query'][] = array(
			'taxonomy' => 'product_visibility',
			'field'    => 'term_id',
			'terms'    => $product_visibility_not_in,
			'operator' => 'NOT IN',
		);

		if($mode == 'new')
		{
			$query_args['orderby'] = 'date';
			$query_args['order']   = 'DESC';
		}

		if($mode == 'featured')
		{
			$query_args['tax_query'][] = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'term_id',
				'terms'    => $product_visibility_terms['featured'],
				'operator' => 'IN',
			);
		}

		if($mode == 'tag')
		{
			$query_args['tax_query'][] = array(
				'taxonomy' => 'product_tag',
				'field'    => 'term_id',
				'terms'    => get_field('tag'),
				'operator' => 'IN',
			);
		}

		if($mode == 'category')
		{
			$query_args['tax_query'][] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'term_id',
				'terms'    => get_field('category'),
				'operator' => 'IN',
			);
		}

		$query = new WP_Query($query_args);

		$products = (object) array(
			'ids'          => wp_parse_id_list( $query->posts ),
			'total'        => count( $query->posts ),
			'total_pages'  => 1,
			'per_page'     => (int) $query->get( 'posts_per_page' ),
			'current_page' => 1,
		);

		return $products;
	}
}

new DiamondSliderProductsBlock();
?>