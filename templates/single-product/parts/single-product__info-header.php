<?php
$product = wc_get_product( get_the_ID() );
?>

<h1 class="product__title"><?php the_title(); ?></h1>
<div class="product__add-info">
	<div class="product-card__rating">
		<div class="product-card__rating-item product-card__rating-item--fill"></div>
		<div class="product-card__rating-item product-card__rating-item--fill"></div>
		<div class="product-card__rating-item product-card__rating-item--fill"></div>
		<div class="product-card__rating-item product-card__rating-item--fill"></div>
		<div class="product-card__rating-item"></div>
	</div>
	<span class="product-card__reviews"><?= $product->get_review_count() ?> отзывов</span>
	<span class="product__stock"><?= $product->is_in_stock() ? 'В наличии' : 'Нет в наличии'; ?></span>
	<?php echo do_shortcode('[ti_wishlists_addtowishlist]');?>
</div>