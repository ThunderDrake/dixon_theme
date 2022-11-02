<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ($product->get_price()) {
	?>
		<div class="price__title">Стоимость:</div>
		<div class="product-price"><?php echo $product->get_price_html(); ?></div>
	<?php
}

?>
