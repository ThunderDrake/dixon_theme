<?php 
/**
 * The template for displaying the wishlist.
 *
 * @package dixon_theme
 */
get_header();

?>
<main class="main" style="padding-top: var(--header-height);">
	<section class="catalog wishlist">
		<div class="catalog__container container wishlist__container">
			<div class="wishlist__header catalog__header product-header">
				<div class="product-header__info">
					<a class="product-header__link" href="/oformit-v-kredit/">Кредит</a>
					<a class="product-header__link" href="/payment-methods/">Оплата и доставка</a>
				</div>
				<h1 class="catalog__title h2-title"><?= get_the_title() ?></h1>
			</div>
			<div class="wishlist__content-wrapper">
				<?php the_content(); ?>
			</div>
		</div>
	</section>

</main>
<?php
get_footer();
?>