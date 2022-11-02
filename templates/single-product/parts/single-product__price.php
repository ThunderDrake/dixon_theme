<?php

$product = wc_get_product( get_the_ID() );
?>

<?php if($product->is_type('variable')): ?>
	<div class="product__prices">
		<div class="product-card__prices-current"></div>
		<!-- <div class="product-card__prices-old">23 000 Р.</div> -->
	</div>
<?php else: ?>
	<div class="product__prices">
		<div class="product-card__prices-current"><?= $product->get_regular_price() ?> Р.</div>
		<!-- <div class="product-card__prices-old">23 000 Р.</div> -->
	</div>
<?php endif; ?>