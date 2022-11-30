<?php
$product = wc_get_product( get_the_ID() );

$upsells = array_filter( array_map( 'wc_get_product', $product->get_upsell_ids() ), 'wc_products_array_filter_visible' );

if(!$upsells) {
	return;
}
?>

<section class="product__recently recently">
	<div class="recently__container container">
		<h2 class="recently__title h2-title">Похожие товары</h2>
		<div class="recently__products products">
			<div class="recently__list product-list">
				<?php 	
				foreach($upsells as $upsell):
				$product_obj = wc_get_product( $upsell );
				$average = $product_obj->get_average_rating();
				?>
				<article class="product-card">
					<div class="product-card__add">
						<?php echo do_shortcode('[ti_wishlists_addtowishlist]');?>
					</div>

					<div class="product-card__image-wrapper">
						<?php if(get_the_post_thumbnail_url( get_the_ID(), 'full')): ?>
							<img 
							loading="lazy" 
							src="<?= get_the_post_thumbnail_url( $product_obj->get_id(), 'full') ?>" class="product-card__image"
							width="152" 
							height="186" 
							alt="<?= $product_obj->get_title(); ?>">
						<?php else: ?>
							<img 
							loading="lazy" 
							src="<?= ct()->get_static_url() ?>/img/product-card-image.png" 
							class="product-card__image" 
							width="152"
							height="186" 
							alt="Изображение товара">
						<?php endif; ?>
					</div>

					<a class="product-card__title" 
					href="<?= $product_obj->get_permalink(); ?>"><?= $product_obj->get_title(); ?></a>

					<div class="product-card__info">
						<div class="product-card__rating" style="<?php echo '--rating-width: '. ( $average / 5 ) * 100 . '%' ?>">
						</div>
						<span class="product-card__reviews"><?= $product_obj->get_review_count(); ?> отзывов</span>
					</div>

					<?php if($product_obj->get_regular_price()): ?>
						<div class="product-card__prices">
						<?php if($product_obj->get_sale_price()): ?>
							<div class="product-card__prices-current"><?= $product_obj->get_sale_price()(); ?> Р.</div>
							<div class="product-card__prices-old"><?= $product_obj->get_regular_price(); ?> Р.</div>
						<?php else: ?>
							<div class="product-card__prices-current"><?= $product_obj->get_regular_price(); ?> Р.</div>
						<?php endif; ?>
						</div>
					<?php else: ?>
						<div class="product-card__prices">
							<div class="product-card__prices-current">Нет в наличии</div>
						</div>
					<?php endif; ?>

					<a class="product-card__button btn btn-reset btn--main" href="<?= $product_obj->get_permalink(); ?>">В корзину
						<svg class="product-card__button-icon">
							<use xlink:href="#cart-icon"></use>
						</svg>
					</a>
				</article>
				<?php endforeach; ?>
				<?php wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
</section>