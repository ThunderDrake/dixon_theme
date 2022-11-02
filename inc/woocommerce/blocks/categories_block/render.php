<?php
if($categories && $categories->ids)
{
	wc_setup_loop(
		array(
			'columns'      => 4,
			'name'         => $block_id,
			'is_shortcode' => true,
			'is_search'    => false,
			'is_paginated' => false,
			'total'        => $categories->total,
			'total_pages'  => $categories->total_pages,
			'per_page'     => $categories->per_page,
			'current_page' => $categories->current_page,
		)
	);

	if(wc_get_loop_prop('total'))
	{
?>
<div class="categories-block">
	<div class="wrapper">
		<div class="row">
			<?php if($with_sidebar) { ?>
			<?php get_sidebar(); ?>
			<div class="col-xs-18 col-md-19 col-lg-15">
			<?php } else { ?>
			<div class="col-xs-20">
			<?php } ?>
				<?php
					woocommerce_product_loop_start();
					foreach ( $categories->ids as $category_id )
					{
						$category = get_term( $category_id );
						if(array_key_exists($category_id, $categories->names))
						{
							$category->name = $categories->names[$category_id];
						}

						do_action( 'woocommerce_shop_loop' );

						// Render product template.
						wc_get_template( 'content-product_cat.php', array(
							'category' => $category,
						) );
					}
					woocommerce_product_loop_end();
				?>
			</div>
		</div>
	</div>
</div>
<?php
	}

	wc_reset_loop();
}
?>