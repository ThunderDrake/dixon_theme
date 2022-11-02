<?php $recently_list = truemisha_recently_viewed_products(); ?>
<?php $recently_posts = get_posts( array(
		'post_type' => 'product',
		'include' => implode(", ", array_slice($recently_list, 0, 4)),
	));
?>

<?php if(!$recently_list) {
	return;
} ?>
<section class="recently">
  <div class="recently__container container">
    <h2 class="recently__title h2-title">Недавно просмотренные</h2>
    <div class="recently__products products">
      <div class="recently__list product-list">
		<?php 
		foreach($recently_posts as $post):
			setup_postdata($post);
			$product_obj = wc_get_product( get_the_ID() );
			$average = $product_obj->get_average_rating();
		?>
		<article class="product-card">
			<!-- <div class="product-card__label">Хит продаж</div> -->
			<div class="product-card__add">
				<button class="product-card__wishlist btn-reset">
					<svg class="product-card__wishlist-icon" width="22" height="20">
					<use xlink:href="#favorite"></use>
					</svg>
				</button>
			</div> <!-- favorite-button -->

			<div class="product-card__image-wrapper">
			<?php if(get_the_post_thumbnail_url( get_the_ID(), 'full')): ?>
				<img loading="lazy" src="<?= get_the_post_thumbnail_url( get_the_ID(), 'full') ?>" class="product-card__image" width="152" height="186" alt="<?php the_title(); ?>">
			<?php else: ?>
				<img loading="lazy" src="<?= ct()->get_static_url() ?>/img/product-card-image.png" class="product-card__image" width="152" height="186" alt="Изображение товара">
			<?php endif; ?>
			</div>

			<a class="product-card__title" href="<?php the_permalink() ?>"><?php the_title(); ?></a>

			<div class="product-card__info">
				<div class="product-card__rating" style="<?php echo '--rating-width: '. ( $average / 5 ) * 100 . '%' ?>">
				</div>
				<a class="product-card__reviews" href="#"><?= $product_obj->get_review_count(); ?> отзывов</a>
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

			<a class="product-card__button btn btn-reset btn--main" href="#">В корзину
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