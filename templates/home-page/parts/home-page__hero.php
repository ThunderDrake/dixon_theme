<?php 
$hero_slides = get_field('home_slider');
?>
<section class="hero">
  <div class="hero__container">
    <div class="swiper hero__slider hero-slider">
      <div class="swiper-wrapper hero-slider__wrapper">
		<?php if($hero_slides): ?>
			<?php foreach($hero_slides as $slide): ?>
				<div class="swiper-slide">
					<div class="hero-slider__item <?php if($slide['type'] === 'type-2') {
						echo 'hero-slider__item--alternate';
					} else {
						echo '';
					} ?>">
						<div class="hero-slider__text">
							<h2 class="hero-slider__title"><?= $slide['title'] ?></h2>
							<div class="hero-slider__subtitle"><?= $slide['subtitle'] ?></div>
							<a class="btn btn-reset btn--main hero-slider__button" href="<?= $slide['button_link'] ?>"><?= $slide['button_text'] ?></a>
							<div class="hero-slider__additional"><?= $slide['decor'] ?></div>
						</div>
						<img loading="lazy" src="<?= wp_get_attachment_image_url($slide['image'], 'full') ?>" class="hero-slider__image" width="1230"
							height="515" alt="">
					</div>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<div class="swiper-slide">
				<div class="hero-slider__item">
					<div class="hero-slider__text">
						<h2 class="hero-slider__title"><span class="--color-nav-blue --font-bold">Телефоны и аксессуары</span> на любой вкус </h2>
						<div class="hero-slider__subtitle">При покупке телефона, <span class="--font-bold">скидка на аксессуары 10%</span></div>
						<a class="btn btn-reset btn--main hero-slider__button" href="#">Твой новый телефон тут</a>
						<div class="hero-slider__additional">Большой выбор брендов</div>
					</div>
					<img loading="lazy" src="<?= ct()->get_static_url() ?>/img/hero/hero-slider__image-1.png" class="hero-slider__image" width="1230"
						height="515" alt="">
				</div>

			</div>
		<?php endif; ?>
      </div>
    </div>
    <div class="swiper-pagination hero-slider__pagination"></div>
  </div>
</section>