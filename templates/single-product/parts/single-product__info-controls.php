<?php
$product = wc_get_product( get_the_ID() );
if($product->is_type('variable')) {
	wp_enqueue_script( 'wc-add-to-cart-variation' );

	$attribute_keys  = array_keys( $product->get_variation_attributes() );
	$variations_json = wp_json_encode( $product->get_available_variations() );
	$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );
}
?>

<?php ct()->template( '/single-product/parts/single-product__variants.php' ) ?>
<div class="product__description">
	<?php the_excerpt(); ?>
</div>
<?php ct()->template( '/single-product/parts/single-product__price.php' ) ?>
<?php ct()->template( '/single-product/parts/single-product__button.php' ) ?>