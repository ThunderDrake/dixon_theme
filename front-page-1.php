<?php 
/**
 * The template for displaying the homepage.
 *
 * @package dixon_theme
 */
get_header(); 
?>

<main class="main">
      <section class="hero">
  <div class="hero__container">
    <div class="swiper hero__slider hero-slider">
      <div class="swiper-wrapper hero-slider__wrapper">

        <div class="swiper-slide hero-slider__item">
          <div class="hero-slider__text">
            <h2 class="hero-slider__title"><span class="--color-nav-blue --font-bold">Телефоны и аксессуары</span> на любой вкус </h2>
            <div class="hero-slider__subtitle">При покупке телефона, <span class="--font-bold">скидка на аксессуары 10%</span></div>
            <a class="btn btn-reset btn--main hero-slider__button" href="#">Твой новый телефон тут</a>
            <div class="hero-slider__additional">Большой выбор брендов</div>
          </div>
          <img loading="lazy" src="<?= ct()->get_static_url() ?>/img/hero/hero-slider__image-1.png" class="hero-slider__image" width="1230" height="515" alt="">

        </div>

        <div class="swiper-slide hero-slider__item">
          <div class="hero-slider__text">
            <h2 class="hero-slider__title"><span class="--color-nav-blue --font-bold">Телефоны и аксессуары</span> на любой вкус </h2>
            <div class="hero-slider__subtitle">При покупке телефона, <span class="--font-bold">скидка на аксессуары 10%</span></div>
            <a class="btn btn-reset btn--main hero-slider__button" href="#">Твой новый телефон тут</a>
            <div class="hero-slider__additional">Большой выбор брендов</div>
          </div>

          <img loading="lazy" src="<?= ct()->get_static_url() ?>/img/hero/hero-slider__image-1.png" class="hero-slider__image" width="1230" height="515" alt="">

        </div>

      </div>
    </div>
    <div class="swiper-pagination hero-slider__pagination"></div>
  </div>
</section>

      <section class="advantages">

  <div class="advantages__container container">

    <div class="advantage">
      <div class="advantage__icon-wrapper">
        <div class="advantage__bg">
          <img loading="lazy" src="<?= ct()->get_static_url() ?>/img/advantages/advantage-icon-1.png" class="advantage__icon-image" width="192" height="184" alt="Продажа телефонови аксессуаров">
        </div>
      </div>
      <div class="advantage__info">
        <h3 class="advantage__title">Продажа телефонови аксессуаров</h3>
        <p class="advantage__text">Широкий ассортиментпопулярных брендов</p>
      </div>
    </div>
    <!-- /advantage -->

    <div class="advantage">
      <div class="advantage__icon-wrapper">
        <div class="advantage__bg">
          <img loading="lazy" src="<?= ct()->get_static_url() ?>/img/advantages/advantage-icon-2.png" class="advantage__icon-image" width="140" height="194" alt="Гарантия качества">
        </div>
      </div>
      <div class="advantage__info">
        <h3 class="advantage__title">Гарантия качества</h3>
        <p class="advantage__text">Ремонт выполняется строго в соответствии с действующими требованиями производителей</p>
      </div>
    </div>
    <!-- /advantage -->

    <div class="advantage">
      <div class="advantage__icon-wrapper">
        <div class="advantage__bg">
          <img loading="lazy" src="<?= ct()->get_static_url() ?>/img/advantages/advantage-icon-3.png" class="advantage__icon-image" width="215" height="195" alt="Ремонт техники">
        </div>
      </div>
      <div class="advantage__info">
        <h3 class="advantage__title">Ремонт техники</h3>
        <p class="advantage__text">Выполняется на профессиональном оборудовании с использованием оригинальных запасных частей. Нам доверяют бренды с мировым именем.</p>
      </div>
    </div>
    <!-- /advantage -->

    <div class="advantage">
      <div class="advantage__icon-wrapper">
        <div class="advantage__bg">
          <img loading="lazy" src="<?= ct()->get_static_url() ?>/img/advantages/advantage-icon-4.png" class="advantage__icon-image" width="202" height="190" alt="Сертифицированные специалисты">
        </div>
      </div>
      <div class="advantage__info">
        <h3 class="advantage__title">Сертифицированные специалисты</h3>
        <p class="advantage__text">Регулярно проходят обучение по повышению уровня квалификации</p>
      </div>
    </div>
    <!-- /advantage -->

  </div>

</section>

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
          <div class="products__tabs-panel tabs__panel">
            <div class="products__tabs-list product-list">

              <article class="product-card">
                <div class="product-card__label">Хит продаж1</div>
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
          <div class="products__tabs-panel tabs__panel">
            <div class="products__tabs-list product-list">

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
          <div class="products__tabs-panel tabs__panel">
            <div class="products__tabs-list product-list">

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
          <div class="products__tabs-panel tabs__panel">
            <div class="products__tabs-list product-list">

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
      </div>
    </div>
    <div class="bestsellers__link-wrap">
      <a class="btn btn--main btn-reset bestsellers__link" href="<?= wc_get_page_permalink( 'shop' ) ?>">Перейти в магазин</a>
    </div>
  </div>
</section>

      <section class="recently">
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

      <section class="callback">
  <div class="callback__container container">
    <form class="callback__form form" action="POST">
      <h2 class="form__title">Оставить заявку на ремонт</h2>
      <span class="form__subtitle">Оставьте свои данные и наш менеджер свяжется с вами в течении 15 минут.</span>
      <label class="form__field form__field--name" for="form_name">
        <svg class="form__field-icon" width="26" height="26">
          <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#name-input-icon"></use>
        </svg>
        <input class="form__input" type="text" name="form_name" placeholder="Введите ваше имя">
      </label>
      <label class="form__field form__field--tel" for="form_phone">
        <svg class="form__field-icon" width="26" height="26">
          <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#phone-input-icon"></use>
        </svg>
        <input class="form__input" type="tel" name="form_phone" placeholder="Введите ваш телефон">
      </label>
      <button class="btn btn--main form__button btn-reset">Оставить заявку</button>
      <label class="custom-checkbox form__policy">
        <input type="checkbox" name="form_policy" class="custom-checkbox__field">
        <span class="custom-checkbox__content">Согласен на обработку <a href="#">персональных данных</a></span>
      </label>
    </form>
    <img loading="lazy" src="<?= ct()->get_static_url() ?>/img/callback-section-human.png" class="callback__human-image" width="1040" height="950" alt="Веселый мужчина показывает палец вверх" aria-hidden="true">
  </div>
</section>

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

  </div>
</section>

    </main>
<?php get_footer(); ?>