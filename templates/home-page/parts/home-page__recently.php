<?php $recently_list = truemisha_recently_viewed_products(); ?>
<?php if(!$recently_list) {
	return;
} ?>
<?php $recently_posts = get_posts( array(
		'post_type' => 'product',
		'include' => implode(", ", array_slice($recently_list, 0, 4)),
	));
?>

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
				<?php echo do_shortcode('[ti_wishlists_addtowishlist]');?>
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
				<span class="product-card__reviews"><?= $product_obj->get_review_count(); ?> отзывов</span>
			</div>

			<?php if($product_obj->get_regular_price()): ?>
			<div class="product-card__prices">
				<?php if($product_obj->get_sale_price()): ?>
					<div class="product-card__prices-current"><?= price_format(" ", $product_obj->get_sale_price()); ?> Р.</div>
					<div class="product-card__prices-old"><?= price_format(" ", $product_obj->get_regular_price()); ?> Р.</div>
				<?php else: ?>
					<div class="product-card__prices-current"><?= price_format(" ", $product_obj->get_regular_price()); ?> Р.</div>
				<?php endif; ?>
			</div>
			<?php else: ?>
			<div class="product-card__prices">
				<div class="product-card__prices-current">Нет в наличии</div>
			</div>
			<?php endif; ?>

			<?php if(!$product_obj->is_type('variable')): ?>
			<a class="product-card__button btn btn-reset btn--main" href="<?= get_site_url(); ?>/cart/?add-to-cart=<?= $product_obj->get_id(); ?>&quantity=1">В корзину
				<svg class="product-card__button-icon">
					<use xlink:href="#cart-icon"></use>
				</svg>
			</a>
			<?php else: ?>
				<a class="product-card__button btn btn-reset btn--main" href="<?= $product_obj->get_permalink(); ?>">Подробнее
					<svg class="product-card__button-icon">
						<use xlink:href="#cart-icon"></use>
					</svg>
				</a>
			<?php endif; ?>
		</article>
		<?php endforeach; ?>
		<?php wp_reset_postdata(); ?>
      </div>
    </div>
  </div>
</section>