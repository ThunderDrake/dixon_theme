<?php
defined( 'ABSPATH' ) || exit;
global $GS;
global $WCCOMPARE;

// $FS_path = $GS->theme.'/assets/js/slick.js';
// $URL_path = $GS->theme_uri.'/assets/js/slick.js';
// $version = $GS->asset_version($FS_path, 'js');
// wp_enqueue_script('slick',$URL_path,array('jquery'),$version);

// $FS_path = $GS->theme.'/assets/js/item-page.js';
// $URL_path = $GS->theme_uri.'/assets/js/item-page.js';
// $version = $GS->asset_version($FS_path, 'js');
// wp_enqueue_script('item-page',$URL_path,array('jquery','slick'),$version);

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
// do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<main id="main" class="product-page quick-view">
	<div class="product-main-content">
		<?php
			/**
			 * Hook: woocommerce_before_single_product_summary.
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			do_action( 'woocommerce_before_single_product_summary' );
		?>
		<div class="product-main-content-data">
			<div class="short-specs">
				<div class="table">
					<?php
					$attributes = $product->get_attributes();
					foreach ($attributes as $key => $attribute)
					{
					?>
					<div class="table-row">
						<div class="column r-h"><?php echo wc_attribute_label( $attribute->get_name() ); ?>:</div>
						<div class="column r-v">
						<?php
							$values = array();

							if($attribute->is_taxonomy())
							{
								$attribute_taxonomy = $attribute->get_taxonomy_object();
								$attribute_values = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'all' ) );

								foreach($attribute_values as $attribute_value)
								{
									$value_name = esc_html($attribute_value->name);

									if($attribute_taxonomy->attribute_public)
									{
										$values[] = '<a href="' . esc_url( get_term_link( $attribute_value->term_id, $attribute->get_name() ) ) . '" rel="tag">' . $value_name . '</a>';
									}
									else
									{
										$values[] = $value_name;
									}
								}
							}
							else
							{
								$values = $attribute->get_options();

								foreach($values as &$value)
								{
									$value = make_clickable( esc_html( $value ) );
								}
							}

							echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );
						?>
						</div>
					</div>
					<?php
					}
					?>
				</div>
			</div>
			<div class="price-and-compare">
				<div class="price"><?=$product->get_price_html()?></div>
				<div class="compare">
					<input type="checkbox" data-cart="atc" id="atc-<?=$product->get_id()?>" <?php if($WCCOMPARE->check_item($product->get_id())) { echo 'checked="checked"'; } ?>>
					<label for="atc-<?=$product->get_id()?>">
						<span class="check"></span>
						<span class="text" data-on="В сравнении" data-off="Сравнить"></span>
					</label>
				</div>
			</div>
			<div class="cart-controls" data-product_id="<?=$product->get_id()?>" data-product_sku="<?=$product->get_sku()?>">
				<button data-cart="add" class="add-to-cart">Купить</button>
				<button data-cart="ocp" class="one-click">Купить в один клик</button>
				<?php
					/**
					 * Hook: woocommerce_single_product_summary.
					 *
					 * @hooked WC_Structured_Data::generate_product_data() - 60
					 */
					do_action( 'woocommerce_single_product_summary' );
				?>
			</div>
		</div>
	</div>
</main>
<?php
$FS_path = $GS->theme.'/assets/js/slick.js';
$URL_path = $GS->theme_uri.'/assets/js/slick.js';
$version = $GS->asset_version($FS_path, 'js');
?>
<script src="<?=$URL_path.'?v='.$version?>"></script>
<?php
$FS_path = $GS->theme.'/assets/js/item-page.js';
$URL_path = $GS->theme_uri.'/assets/js/item-page.js';
$version = $GS->asset_version($FS_path, 'js');
?>
<script src="<?=$URL_path.'?v='.$version?>"></script>