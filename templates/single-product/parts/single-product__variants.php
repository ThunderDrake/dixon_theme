<?php
$product = wc_get_product( get_the_ID() );
if($product->is_type('variable')) {
	wp_enqueue_script( 'wc-add-to-cart-variation' );

	$attribute_keys  = array_keys( $product->get_variation_attributes() );
	$variations_json = wp_json_encode( $product->get_available_variations() );
	$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );
}
?>

<?php if($product->is_type('variable')): ?>
<div class="product__details">
	<form class="variations_form cart"
		action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post"
		enctype='multipart/form-data' 
		data-product_id="<?php echo absint( $product->get_id() ); ?>"
		data-product_variations="<?php echo $variations_attr; ?>">

		<?php do_action( 'woocommerce_before_variations_form' ); ?>

		<?php if ( empty( $product->get_available_variations() ) && false !== $product->get_available_variations() ) : ?>
		<p class="stock out-of-stock">
			<?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?>
		</p>
		<?php else : ?>
		<div class="variations">
			<?php foreach ( $product->get_variation_attributes() as $attribute_name => $options ) : ?>
			<div class="variation-radios product__details-item">
				<span class="product__details-item-name"><?= wc_attribute_label( $attribute_name )?>:</span>
				<?php
					wc_dropdown_variation_attribute_options(
						array(
							'options'   => $options,
							'attribute' => $attribute_name,
							'product'   => $product,
						)
					);
					echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) ) : '';
				?>
			</div>
			<?php endforeach; ?>
		</div>

		<div class="single_variation_wrap">
			<?php
				do_action( 'woocommerce_before_single_variation' );
				do_action( 'woocommerce_single_variation' );
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>
		<?php endif; ?>

		<?php do_action( 'woocommerce_after_variations_form' ); ?>
	</form>

	<?php
	do_action( 'woocommerce_after_add_to_cart_form' );?>
</div>
<?php endif; ?>