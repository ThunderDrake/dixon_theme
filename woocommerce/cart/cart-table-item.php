<?php

$product   = apply_filters( 'woocommerce_cart_item_product', $item['data'], $item, $key );
$product_id = apply_filters( 'woocommerce_cart_item_product_id', $item['product_id'], $item, $key );

if($product && $product->exists() && $item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $item, $key))
{
	$permalink = apply_filters( 'woocommerce_cart_item_permalink', $product->is_visible() ? $product->get_permalink( $item ) : '', $item, $key );
?>
<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $item, $key ) ); ?>">
	<td class="product-thumbnail">
	<?php
	$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image(), $item, $key );

	if ( ! $permalink ) {
		echo $thumbnail; // PHPCS: XSS ok.
	} else {
		printf( '<a href="%s">%s</a>', esc_url( $permalink ), $thumbnail ); // PHPCS: XSS ok.
	}
	?>
	</td>

	<td class="product-name" data-title="Наименование">
	<?php
	if ( ! $permalink ) {
		echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $product->get_name(), $item, $key ) . '&nbsp;' );
	} else {
		echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $permalink ), $product->get_name() ), $item, $key ) );
	}

	do_action( 'woocommerce_after_cart_item_name', $item, $key );

	// Meta data.
	echo wc_get_formatted_cart_item_data( $item ); // PHPCS: XSS ok.

	// Backorder notification.
	if ( $product->backorders_require_notification() && $product->is_on_backorder( $item['quantity'] ) ) {
		echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
	}
	?>
	</td>

	
<?php /*
	<td class="product-price" data-title="Цена">
		<?php
			echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $product ), $item, $key ); // PHPCS: XSS ok.
		?>
	</td>
*/ ?>


	<td class="product-quantity" data-title="Количество">
	<?php
	if ( $product->is_sold_individually() ) {
		$quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $key );
	} else {
		$quantity = woocommerce_quantity_input( array(
			'input_name'   => "cart[{$key}][qty]",
			'input_value'  => $item['quantity'],
			'max_value'    => $product->get_max_purchase_quantity(),
			'min_value'    => '0',
			'product_name' => '',
		), $product, false );
	}

	echo apply_filters( 'woocommerce_cart_item_quantity', $quantity, $key, $item ); // PHPCS: XSS ok.
	?>
	</td>

	<td class="product-subtotal" data-title="Итого">
	<?php
		echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $product, $item['quantity'] ), $item, $key ); // PHPCS: XSS ok.
	?>
	</td>

	<td class="product-remove">
	<?php
		echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			'woocommerce_cart_item_remove_link',
			sprintf(
				'<a href="%s" class="remove" data-product_id="%s" data-product_sku="%s">&times;</a>',
				esc_url( wc_get_cart_remove_url( $key ) ),
				esc_attr( $product_id ),
				esc_attr( $product->get_sku() )
			),
			$key
		);
	?>
	</td>
</tr>
<?php
}
?>