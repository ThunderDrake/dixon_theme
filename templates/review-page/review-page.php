<?php 
/**
 * The template for displaying the pricelist page.
 *
 * @package dixon_theme
 */
get_header();
$reviews_list = get_field('reviews_list');
?>
<main class="main" style="padding-top: var(--header-height);">
	<section class="reviews">
		<div class="reviews__container container">
			<h1 class="reviews__title h2-title">Отзывы наших клиентов</h1>
			<?php if($reviews_list): ?>
			<div class="swiper reviews__slider">
				<div class="swiper-wrapper">
					<?php foreach($reviews_list as $item): ?>
						<div class="swiper-slide reviews__item">
							<div class="reviews__item-wrapper">
								<div class="reviews__item-title"><?= $item['name'] ?></div>
								<div class="reviews__item-rating" style="--rating-width: <?= $item['rating'] * 20 ?>%"></div>
								<p class="reviews__item-text"><?= $item['descr'] ?></p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="reviews__controls">
				<div class="swiper-pagination reviews__pagination"></div>
			</div>
			<?php endif; ?>
		</div>
	</section>
	<?php ct()->template( '/parts/contacts-section.php' ) ?>

</main>
<?php get_footer(); ?>