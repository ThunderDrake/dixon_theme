<?php

$product = wc_get_product( get_the_ID() );
$attachment_gallery_ids = $product->get_gallery_image_ids() ? $product->get_gallery_image_ids() : explode(" ", get_post_thumbnail_id( $product->get_id() ));
?>

<?php if($attachment_gallery_ids): ?>
	<div class="product__slider">
		<div class="swiper product__slider-big">
		<div class="swiper-wrapper">
			<?php foreach($attachment_gallery_ids as $image_id): ?>
				<div class="swiper-slide">
					<img loading="lazy" src="<?= wp_get_attachment_url( $image_id, 'full' ) ?>" class="product__slider-image" width="275" height="340" alt="">
				</div>
			<?php endforeach; ?>
		</div>
		</div>
		<div class="product__slider-nav-wrapper">
		<div class="swiper product__slider-nav">
			<div class="swiper-wrapper">
				<?php foreach($attachment_gallery_ids as $image_id): ?>
					<div class="swiper-slide">
						<img loading="lazy" src="<?= wp_get_attachment_url( $image_id, 'full' ) ?>" class="product__slider-image" width="75" height="90" alt="">
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="swiper-button-prev">
			<svg width="6" height="13" viewBox="0 0 6 13" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M5.14856 0.00186539C5.34715 0.00144482 5.53961 0.0763569 5.69252 0.213599C5.77859 0.290882 5.84973 0.385796 5.90188 0.492904C5.95402 0.600011 5.98615 0.717208 5.99641 0.837783C6.00667 0.958359 5.99488 1.07994 5.96169 1.19557C5.9285 1.3112 5.87458 1.4186 5.80302 1.51163L1.99524 6.44597L5.66702 11.3895C5.73763 11.4837 5.79035 11.592 5.82216 11.7083C5.85398 11.8246 5.86426 11.9466 5.85241 12.0672C5.84056 12.1879 5.80682 12.3048 5.75313 12.4112C5.69943 12.5177 5.62684 12.6116 5.53953 12.6875C5.45159 12.7714 5.34861 12.8346 5.23704 12.8732C5.12547 12.9119 5.00773 12.9251 4.89121 12.9122C4.77469 12.8992 4.6619 12.8603 4.55992 12.7979C4.45794 12.7355 4.36898 12.6509 4.29861 12.5495L0.193353 7.02594C0.0683408 6.86122 0 6.6546 0 6.44137C0 6.22814 0.0683408 6.02152 0.193353 5.85679L4.4431 0.333277C4.52836 0.221869 4.63667 0.133802 4.75925 0.0762215C4.88182 0.0186396 5.01519 -0.00683498 5.14856 0.00186539Z" fill="#A4A4A4"/>
			</svg>

		</div>
		<div class="swiper-button-next">
			<svg width="6" height="13" viewBox="0 0 6 13" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M0.851445 0.00186539C0.652853 0.00144482 0.460393 0.0763569 0.307477 0.213599C0.221413 0.290882 0.150271 0.385796 0.0981246 0.492904C0.0459785 0.600011 0.0138536 0.717208 0.0035897 0.837783C-0.00667418 0.958359 0.00512483 1.07994 0.0383107 1.19557C0.0714965 1.3112 0.125416 1.4186 0.196984 1.51163L4.00476 6.44597L0.332976 11.3895C0.262375 11.4837 0.209651 11.592 0.177836 11.7083C0.146021 11.8246 0.135741 11.9466 0.147589 12.0672C0.159437 12.1879 0.193177 12.3048 0.246871 12.4112C0.300566 12.5177 0.373156 12.6116 0.460468 12.6875C0.548409 12.7714 0.651394 12.8346 0.76296 12.8732C0.874526 12.9119 0.992266 12.9251 1.10879 12.9122C1.22531 12.8992 1.3381 12.8603 1.44008 12.7979C1.54206 12.7355 1.63102 12.6509 1.70139 12.5495L5.80665 7.02594C5.93166 6.86122 6 6.6546 6 6.44137C6 6.22814 5.93166 6.02152 5.80665 5.85679L1.5569 0.333277C1.47164 0.221869 1.36333 0.133802 1.24075 0.0762215C1.11818 0.0186396 0.984807 -0.00683498 0.851445 0.00186539Z" fill="#A4A4A4"/>
			</svg>

		</div>
		</div>
	</div>
<?php endif; ?>