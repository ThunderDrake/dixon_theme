<?php 
/**
 * The template for displaying the homepage.
 *
 * @package dixon_theme
 */
get_header();
global $product;
global $woocommerce;

$attribute_taxonomies = wc_get_attribute_taxonomies();
$taxonomy_terms = array();


?>
<main class="main" style="padding-top: var(--header-height);">
      <section class="catalog">
  <div class="catalog__container container">
    <div class="catalog__header product-header">
  <div class="product-header__info">
    <a class="product-header__link" href="#">Кредит</a>
    <a class="product-header__link" href="#">Оплата и доставка</a>
  </div>
  <h1 class="catalog__title h2-title">Телефоны</h1>
  <div class="product-header__nav">
    <div class="breadcrumbs">
      <a class="breadcrumbs__item" href="/">Главная</a>
      <a class="breadcrumbs__item" href="/catalog/">Каталог товаров</a>
      <span class="breadcrumbs__item breadcrumbs__item--active">Телефоны</span>
    </div>

    <div class="product-header__sort" data-accordion="parent">
      <div class="product-header__sort-elem" data-accordion="element">
        <div class="custom-select product-header__sort" data-select data-validate-type="select" data-name="sort">
          <button class="custom-select__button product-header__sort-button" type="button" aria-label="Выберите одну из опций"
            data-accordion="button">
            <span class="custom-select__label">Сортировка</span>
            <span class="custom-select__text visually-hidden"></span>
            <svg class="catalog__sort-icon" width="20" height="17" aria-hidden="true">
              <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#sort"></use>
            </svg>
          </button>
          <div data-accordion="content">
            <div class="custom-select__list product-header__sort-list" data-accordion="content">
              <div class="custom-select-item option-item" tabindex="0" aria-checked="false" role="checkbox"
                data-select-value="old-first">
                <div class="option-item__check">
                  <svg width="10" height="9" aria-hidden="true">
                    <use xlink:href="#icon-check"></use>
                  </svg>
                </div><span>Сначала старые</span>
              </div>
              <div class="custom-select-item option-item" tabindex="0" aria-checked="false" role="checkbox"
                data-select-value="new-first">
                <div class="option-item__check">
                  <svg width="10" height="9" aria-hidden="true">
                    <use xlink:href="#icon-check"></use>
                  </svg>
                </div><span>Сначала новые</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <button class="btn btn-reset catalog__filter-button" data-popup-target="filter">Фильтр</button>
  </div>
</div>

    <div class="catalog__content-wrapper">
      <asise class="catalog__aside" data-popup="filter">
        <div class="filter" data-filter>
  <div class="filter__container container" data-validate>
    <div class="filter__header">
      <div class="filter__header-title">Фильтр</div>
      <button class="popup-close-btn btn-reset" type="button" aria-label="Закрыть попап" data-popup-close="">
        <svg width="10" height="10" aria-hidden="true">
            <use xlink:href="#popup-close"></use>
        </svg>
      </button>
    </div>
    <form class="filter__form stop-clear" action="<?= home_url(add_query_arg(array(), $wp->request)) ?>" method="get">
      <div class="filter__block" data-accordion="parent">
	  <?php 
		if($attribute_taxonomies):
			foreach($attribute_taxonomies as $tax):?>
			<div class="filter-button" data-accordion="element">
				<div class="custom-select" data-select data-multiple="true" data-validate-type="select" data-name="<?= $tax->attribute_name ?>">
					<button class="custom-select__button" type="button" aria-label="Выберите одну из опций" data-accordion="button">
						<span class="custom-select__icon">
							<svg width="12" height="6" viewBox="0 0 12 6" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path
									d="M11.9241 5.14856C11.9245 5.34715 11.8554 5.53961 11.7286 5.69252C11.6573 5.77859 11.5697 5.84973 11.4708 5.90188C11.3719 5.95402 11.2637 5.98615 11.1524 5.99641C11.041 6.00667 10.9288 5.99488 10.822 5.96169C10.7153 5.9285 10.6161 5.87458 10.5302 5.80302L5.97449 1.99524L1.41027 5.66702C1.32333 5.73763 1.22329 5.79035 1.11591 5.82216C1.00853 5.85398 0.895917 5.86426 0.78455 5.85241C0.673182 5.84056 0.565254 5.80682 0.466969 5.75313C0.368684 5.69943 0.281979 5.62684 0.211839 5.53953C0.134463 5.45159 0.0760988 5.34861 0.0404102 5.23704C0.00472169 5.12547 -0.00752072 5.00773 0.00445072 4.89121C0.0164222 4.77469 0.0523493 4.6619 0.109977 4.55992C0.167605 4.45794 0.24569 4.36898 0.339331 4.29861L5.43903 0.193353C5.59111 0.0683408 5.78187 0 5.97874 0C6.17561 0 6.36638 0.0683408 6.51846 0.193353L11.6182 4.4431C11.721 4.52836 11.8023 4.63667 11.8555 4.75925C11.9086 4.88182 11.9322 5.01519 11.9241 5.14856Z"
									fill="#A4A4A4" />
							</svg>
						</span>
						<span class="custom-select__label"><?= $tax->attribute_label ?></span>
						<span class="custom-select__text visually-hidden"></span>
					</button>
					<div data-accordion="content">
						<div class="custom-select__list" data-accordion="content">
							<?php 
							if (taxonomy_exists(wc_attribute_taxonomy_name($tax->attribute_name))) :
							$terms = get_terms(wc_attribute_taxonomy_name($tax->attribute_name), 'orderby=name&hide_empty=0');
							foreach($terms as $term):
							?>
								<div class="custom-select-item option-item" tabindex="0" aria-checked="false" role="checkbox" data-select-value="<?= $term->term_id ?>">
									<div class="option-item__check">
										<svg width="10" height="9" aria-hidden="true">
											<use xlink:href="#icon-check"></use>
										</svg>
									</div>
									<span><?= $term->name ?></span>
								</div>
							<?php
							endforeach;
							endif;
							?>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach;
	endif;
	?>
      </div>
      <div class="filter-popup-buttons filter-popup-buttons--main">
        <button class="filter-popup-buttons__btn filter-popup-buttons__btn--apply btn" type="button" aria-label="применить" data-popup-close=""><span>применить</span></button>
        <button class="filter-popup-buttons__btn filter-popup-buttons__btn--close btn btn--border-blue" type="button" aria-label="очистить" data-filter-clear=""><span>очистить</span></button>
    </div>
    </form>
  </div>
</div>

      </asise>
      <div class="catalog__content">
  <div class="catalog__list" data-name="catalog-content">

  	<?php while ( have_posts() ): ?>
		<?php the_post() ?>
		<?php 
			$product_obj = wc_get_product( get_the_ID() );
			$average = $product_obj->get_average_rating();
		?>
		<article class="product-card" data-name="catalog-content-item">
			<div class="product-card__add">
				<?php echo do_shortcode('[ti_wishlists_addtowishlist]');?>
			</div>

			<div class="product-card__image-wrapper">
				<?php if(get_the_post_thumbnail_url( get_the_ID(), 'full')): ?>
				<img loading="lazy" src="<?= get_the_post_thumbnail_url( $product_obj->get_id(), 'full') ?>" class="product-card__image" width="152"
					height="186" alt="<?= $product_obj->get_title(); ?>">
				<?php else: ?>
				<img loading="lazy" src="<?= ct()->get_static_url() ?>/img/product-card-image.png" class="product-card__image" width="152" height="186"
					alt="Изображение товара">
				<?php endif; ?>
			</div>

			<a class="product-card__title" href="<?= $product_obj->get_permalink(); ?>"><?= $product_obj->get_title(); ?></a>

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

			<a class="product-card__button btn btn-reset btn--main" href="<?= $product_obj->get_permalink(); ?>">В корзину
				<svg class="product-card__button-icon">
					<use xlink:href="#cart-icon"></use>
				</svg>
			</a>
		</article>
	<?php endwhile; ?>
  </div>
  <div class="catalog__show-more" data-name="courses-more">
  	<?php if ( $pagination = get_archive_pagination_data( __('товар,товаров,товаров', 'university') ) ): ?>
		<button class="catalog__show-more-button btn-reset" type="button" data-name="courses-more" aria-label="" data-url="<?= $pagination['next_url'] ?>">Показать еще</button>
	<?php endif; ?>
    
  </div>
  <div class="catalog__pagination">
    <a class="catalog__pagination-item" href="#">≪</a>
    <a class="catalog__pagination-item" href="#"><</a>
    <a class="catalog__pagination-item catalog__pagination-item--active" href="#">1</a>
    <a class="catalog__pagination-item" href="#">2</a>
    <a class="catalog__pagination-item" href="#">3</a>
    <a class="catalog__pagination-item" href="#">></a>
    <a class="catalog__pagination-item" href="#">≫</a>
  </div>
  <section class="catalog__recently recently">
  <div class="recently__container container">
    <h2 class="recently__title h2-title">Недавно просмотренные</h2>
    <div class="recently__products products">
      <div class="recently__list product-list">
        <article class="product-card">
          <div class="product-card__label">Хит продаж</div>
          <div class="product-card__add">
            <button class="product-card__wishlist btn-reset">
              <svg class="product-card__wishlist-icon" width="22" height="20">
                <use xlink:href="#favorite"></use>
              </svg>
            </button>
          </div> <!-- favorite-button -->

          <div class="product-card__image-wrapper">
            <img loading="lazy" src="<?= ct()->get_static_url() ?>/img/product-card-image.png" class="product-card__image" width="152" height="186" alt="Изображение товара">
          </div>

          <a class="product-card__title" href="#">Смартфон Samsung Galaxy A23 4/64GB KZ персиковый</a>

          <div class="product-card__info">
            <div class="product-card__rating">
              <div class="product-card__rating-item product-card__rating-item--fill"></div>
              <div class="product-card__rating-item product-card__rating-item--fill"></div>
              <div class="product-card__rating-item product-card__rating-item--fill"></div>
              <div class="product-card__rating-item product-card__rating-item--fill"></div>
              <div class="product-card__rating-item"></div>
            </div>
            <a class="product-card__reviews" href="#">15 отзывов</a>
          </div>

          <div class="product-card__prices">
            <div class="product-card__prices-current">15 000 Р.</div>
            <div class="product-card__prices-old">23 000 Р.</div>
          </div>

          <a class="product-card__button btn btn-reset btn--main" href="#">В корзину
            <svg class="product-card__button-icon">
              <use xlink:href="#cart-icon"></use>
            </svg>
          </a>
        </article>
        <article class="product-card">
          <div class="product-card__add">
            <button class="product-card__wishlist btn-reset">
              <svg class="product-card__wishlist-icon" width="22" height="20">
                <use xlink:href="#favorite"></use>
              </svg>
            </button>
          </div> <!-- favorite-button -->

          <div class="product-card__image-wrapper">
            <img loading="lazy" src="<?= ct()->get_static_url() ?>/img/product-card-image.png" class="product-card__image" width="152" height="186" alt="Изображение товара">
          </div>

          <a class="product-card__title" href="#">Смартфон Samsung Galaxy A23 4/64GB KZ персиковый</a>

          <div class="product-card__info">
            <div class="product-card__rating">
              <div class="product-card__rating-item product-card__rating-item--fill"></div>
              <div class="product-card__rating-item product-card__rating-item--fill"></div>
              <div class="product-card__rating-item product-card__rating-item--fill"></div>
              <div class="product-card__rating-item product-card__rating-item--fill"></div>
              <div class="product-card__rating-item"></div>
            </div>
            <a class="product-card__reviews" href="#">15 отзывов</a>
          </div>

          <div class="product-card__prices">
            <div class="product-card__prices-current">15 000 Р.</div>
            <div class="product-card__prices-old">23 000 Р.</div>
          </div>

          <a class="product-card__button btn btn-reset btn--main" href="#">В корзину
            <svg class="product-card__button-icon">
              <use xlink:href="#cart-icon"></use>
            </svg>
          </a>
        </article>
        <article class="product-card">
          <div class="product-card__add">
            <button class="product-card__wishlist btn-reset">
              <svg class="product-card__wishlist-icon" width="22" height="20">
                <use xlink:href="#favorite"></use>
              </svg>
            </button>
          </div> <!-- favorite-button -->

          <div class="product-card__image-wrapper">
            <img loading="lazy" src="<?= ct()->get_static_url() ?>/img/product-card-image.png" class="product-card__image" width="152" height="186" alt="Изображение товара">
          </div>

          <a class="product-card__title" href="#">Смартфон Samsung Galaxy A23 4/64GB KZ персиковый</a>

          <div class="product-card__info">
            <div class="product-card__rating">
              <div class="product-card__rating-item product-card__rating-item--fill"></div>
              <div class="product-card__rating-item product-card__rating-item--fill"></div>
              <div class="product-card__rating-item product-card__rating-item--fill"></div>
              <div class="product-card__rating-item product-card__rating-item--fill"></div>
              <div class="product-card__rating-item"></div>
            </div>
            <a class="product-card__reviews" href="#">15 отзывов</a>
          </div>

          <div class="product-card__prices">
            <div class="product-card__prices-current">15 000 Р.</div>
            <div class="product-card__prices-old">23 000 Р.</div>
          </div>

          <a class="product-card__button btn btn-reset btn--main" href="#">В корзину
            <svg class="product-card__button-icon">
              <use xlink:href="#cart-icon"></use>
            </svg>
          </a>
        </article>
        <article class="product-card">
          <div class="product-card__add">
            <button class="product-card__wishlist btn-reset">
              <svg class="product-card__wishlist-icon" width="22" height="20">
                <use xlink:href="#favorite"></use>
              </svg>
            </button>
          </div> <!-- favorite-button -->

          <div class="product-card__image-wrapper">
            <img loading="lazy" src="<?= ct()->get_static_url() ?>/img/product-card-image.png" class="product-card__image" width="152" height="186" alt="Изображение товара">
          </div>

          <a class="product-card__title" href="#">Смартфон Samsung Galaxy A23 4/64GB KZ персиковый</a>

          <div class="product-card__info">
            <div class="product-card__rating">
              <div class="product-card__rating-item product-card__rating-item--fill"></div>
              <div class="product-card__rating-item product-card__rating-item--fill"></div>
              <div class="product-card__rating-item product-card__rating-item--fill"></div>
              <div class="product-card__rating-item product-card__rating-item--fill"></div>
              <div class="product-card__rating-item"></div>
            </div>
            <a class="product-card__reviews" href="#">15 отзывов</a>
          </div>

          <div class="product-card__prices">
            <div class="product-card__prices-current">15 000 Р.</div>
            <div class="product-card__prices-old">23 000 Р.</div>
          </div>

          <a class="product-card__button btn btn-reset btn--main" href="#">В корзину
            <svg class="product-card__button-icon">
              <use xlink:href="#cart-icon"></use>
            </svg>
          </a>
        </article>
      </div>
    </div>
  </div>
</section>

</div>

    </div>
    <section class="contacts">
  <div class="contacts__container container">
    <h2 class="contacts__title h2-title">Контакты</h2>
    <div class="contacts__content">
      <div class="contacts__info">
        <address class="contacts__text">Адрес: Чебоксары, ул. Калинина, 91 к1</address>
        <p class="contacts__text">График работы:</p>
        <p class="contacts__text">Телефон: <a class="contacts__phone" href="tel:+7352364202">+7 (352) 36-42-02</a></p>
        <p class="contacts__text">Эл. почта: <a class="contacts__mail" href="mailto:noname@mail.ru">noname@mail.ru</a></p>
        <div class="contacts__socials">
          <a class="contacts__socials-link" href="#">
            <svg class="contacts__socials-icon" width="30" height="30">
              <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#vk-icon"></use>
            </svg>
          </a>
          <a class="contacts__socials-link" href="#">
            <svg class="contacts__socials-icon" width="30" height="30">
              <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#tg-icon"></use>
            </svg>
          </a>
          <a class="contacts__socials-link" href="#">
            <svg class="contacts__socials-icon" width="30" height="30">
              <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#viber-icon"></use>
            </svg>
          </a>
          <a class="contacts__socials-link" href="#">
            <svg class="contacts__socials-icon" width="30" height="30">
              <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#whatsapp-icon"></use>
            </svg>
          </a>
        </div>
      </div>
      <div class="contacts__map">
        <img loading="lazy" src="<?= ct()->get_static_url() ?>/img/contacts__map.jpg" class="contacts__map-image" width="860" height="535" alt="Карта проезда до нашего офиса">
      </div>
    </div>

    <div class="contacts__add-info">
      <ul class="contacts__add-list list-reset">
        <li class="contacts__add-item">ИП Васильев Андрей Иванович</li>
        <li class="contacts__add-item">Юридический адрес 426060, Удмуртская Республика,</li>
        <li class="contacts__add-item">г. Ижевск, ул. 9-я Января, д. 171, кв. 102.</li>
        <li class="contacts__add-item">Почтовый адрес 428018, Чувашская Республика,</li>
        <li class="contacts__add-item">г.Чебоксары, ул. Академика А. Н. Крылова, д. 11, кв. 15</li>
        <li class="contacts__add-item">ИНН 212900377340</li>
        <li class="contacts__add-item">ОГРНИП 305212900900105</li>
        <li class="contacts__add-item">Банк ЧУВАШСКОЕ ОТДЕЛЕНИЕ N8613 ПАО СБЕРБАНК</li>
        <li class="contacts__add-item">Р/счет 40802810975000002757</li>
        <li class="contacts__add-item">Кор/счет 30101810300000000609</li>
        <li class="contacts__add-item">БИК 049706609</li>
      </ul>
    </div>

  </div>
</section>

  </div>
</section>

    </main>
<?php
get_footer();
?>