<?php
global $woocommerce;

$products_list_hit = get_posts( array(
	'post_type' => 'product',
	'posts_per_page' => 8,
	'product_tag' => 'hit-prodazh'
) );
$products_list_sells = get_posts( array(
	'post_type' => 'product',
	'posts_per_page' => 8,
	'product_tag' => 'aktsii'
) );
$products_list_new = get_posts( array(
	'post_type' => 'product',
	'posts_per_page' => 8,
	'product_tag' => 'novinki'
) );
$products_list_choose = get_posts( array(
	'post_type' => 'product',
	'posts_per_page' => 8,
	'product_tag' => 'vybor-pokupatelej'
) );
$products_list_sell_out = get_posts( array(
	'post_type' => 'product',
	'posts_per_page' => 8,
	'product_tag' => 'rasprodazha'
) );

?>
<section class="bestsellers">
  <div class="bestsellers__container container">
    <h2 class="bestsellers__title h2-title">Хиты продаж</h2>
    <div class="bestsellers__products products">
      <div class="products__tabs tabs" data-tabs="products">
        <ul class="products__tabs-nav tabs__nav list-reset">
          <li class="products__tabs-nav-item tabs__nav-item"><button class="products__tabs-nav-btn tabs__nav-btn" type="button">Хиты продаж</button></li>
          <li class="products__tabs-nav-item tabs__nav-item"><button class="products__tabs-nav-btn tabs__nav-btn" type="button">Акции</button></li>
          <li class="products__tabs-nav-item tabs__nav-item"><button class="products__tabs-nav-btn tabs__nav-btn" type="button">Новинки</button></li>
          <li class="products__tabs-nav-item tabs__nav-item"><button class="products__tabs-nav-btn tabs__nav-btn" type="button">Выбор покупателей</button></li>
          <li class="products__tabs-nav-item tabs__nav-item"><button class="products__tabs-nav-btn products__tabs-nav-btn--red tabs__nav-btn" type="button">Распродажа</button></li>
        </ul>
        <div class="products__tabs-content tabs__content">
          <div class="products__tabs-panel tabs__panel">
            <div class="products__tabs-list product-list">
				<?php 
				if ( $products_list_hit ):
					foreach($products_list_hit as $post):
						setup_postdata($post);?>
						<?php 
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

					<?php endforeach;
				endif;
				wp_reset_postdata(); ?>
            </div>
          </div>
          <div class="products__tabs-panel tabs__panel">
            <div class="products__tabs-list product-list">
				<?php 
				if ( $products_list_sells ):
					foreach($products_list_sells as $post):
						setup_postdata($post);?>
						<?php 
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

					<?php endforeach;
				endif;
				wp_reset_postdata(); ?>
            </div>
          </div>
          <div class="products__tabs-panel tabs__panel">
            <div class="products__tabs-list product-list">
				<?php 
				if ( $products_list_new ):
					foreach($products_list_new as $post):
						setup_postdata($post);?>
						<?php 
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

					<?php endforeach;
				endif;
				wp_reset_postdata(); ?>
            </div>
          </div>
          <div class="products__tabs-panel tabs__panel">
            <div class="products__tabs-list product-list">
				<?php 
				if ( $products_list_choose ):
					foreach($products_list_choose as $post):
						setup_postdata($post);?>
						<?php 
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

					<?php endforeach;
				endif;
				wp_reset_postdata(); ?>
            </div>
          </div>
          <div class="products__tabs-panel tabs__panel">
		  <div class="products__tabs-list product-list">
				<?php 
				if ( $products_list_sell_out ):
					foreach($products_list_sell_out as $post):
						setup_postdata($post);?>
						<?php 
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

					<?php endforeach;
				endif;
				wp_reset_postdata(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="bestsellers__link-wrap">
      <a class="btn btn--main btn-reset bestsellers__link" href="<?= wc_get_page_permalink( 'shop' ) ?>">Перейти в магазин</a>
    </div>
  </div>
</section>