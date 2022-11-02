<?php

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 */
do_action( 'woocommerce_before_single_product' );

if(post_password_required())
{
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div class="white-holder">
	<?php the_title( '<h1 class="page-title col-xs-12">', '</h1>' ); ?>
	<div class="product-info">
		<div class="product-info-gallery col-xs-12 col-md-6">
			<?php
				/**
				 * Hook: woocommerce_before_single_product_summary.
				 *
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
			?>
		</div>
		<div class="product-info-cart-controls col-xs-12 col-md-6">
			<?php
			/*
			<div class="price"><?=$product->get_price_html()?></div>
			<div class="add-more-product-to-car">
				<button data-cart="minus_item" class="prev-amound-product-to-car">-</button>
				<input type="number" name="" step="1" min="1" value="1" inputmode="numeric">
				<button data-cart="add_item" class="next-amound-product-to-car">+</button>
			</div>
			<div class="cart-controls" data-product_id="<?=$product->get_id()?>" data-product_sku="<?=$product->get_sku()?>">
				<button data-cart="add" class="add-to-cart">Купить</button>
			</div>
			*/

			/**
			 * Hook: woocommerce_single_product_summary.
			 *
			 * @hooked woocommerce_template_single_price - 10
			 * remove @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * remove @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 * @hooked WC_Structured_Data::generate_product_data() - 60
			 */
			do_action( 'woocommerce_single_product_summary' );
			?>
		</div>
	</div>
	<?php
	/**
	 * Hook: diamond_single_product_information.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 */
	do_action( 'diamond_single_product_information' );
	?>
</div>
<?php
/**
 * Hook: woocommerce_after_single_product_summary.
 *
 * @hooked woocommerce_output_related_products - 20
 */
do_action( 'woocommerce_after_single_product_summary' );
?>
<?php do_action( 'woocommerce_after_single_product' ); ?>
