<?php 
/**
 * The template for displaying the homepage.
 *
 * @package dixon_theme
 */
get_header();
$product = wc_get_product( get_the_ID() );
if($product->is_type('variable')) {
	wp_enqueue_script( 'wc-add-to-cart-variation' );

	$attribute_keys  = array_keys( $product->get_variation_attributes() );
	$variations_json = wp_json_encode( $product->get_available_variations() );
	$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );
}
$terms = get_the_terms( $product->get_id(), 'product_cat' );
$parent_term_id = $terms[0]->parent;



?>
<main class="main" style="padding-top: var(--header-height);">
	<section class="product">
		<div class="product__container container">
			<?php do_action( 'woocommerce_before_single_product' ); ?>
			<?php ct()->template( '/single-product/parts/single-product__header.php' ) ?>

			<div class="product__content">
				<?php ct()->template( '/single-product/parts/single-product__slider.php' ) ?>
				<div class="product__information">
					<?php ct()->template( '/single-product/parts/single-product__info-header.php' ) ?>
					<?php ct()->template( '/single-product/parts/single-product__info-controls.php' ) ?>
				</div>
			</div>

			<?php ct()->template( '/single-product/parts/single-product__tabs.php' ) ?>
			<?php ct()->template( '/single-product/parts/single-product__upsells.php' ) ?>

			

		</div>
	</section>
</main>
<?php
get_footer();