<?php
$product = wc_get_product( get_the_ID() );
$terms = get_the_terms( $product->get_id(), 'product_cat' );
$parent_term_id = $terms[0]->parent;
?>

<div class="product__header product-header">
	<div class="product-header__info">
		<a class="product-header__link" href="#">Кредит</a>
		<a class="product-header__link" href="#">Оплата и доставка</a>
	</div>
	<h1 class="catalog__title h2-title">Телефоны</h1>
	<div class="product-header__nav">
		<div class="breadcrumbs">
			<a class="breadcrumbs__item" href="/">Главная</a>
			<a class="breadcrumbs__item" href="/catalog/">Каталог товаров</a>
			<a class="breadcrumbs__item" href="<?= get_term_link($parent_term_id) ?>"><?= get_term( $parent_term_id )->name ?></a>
			<span class="breadcrumbs__item breadcrumbs__item--active"><?php the_title(); ?></span>
		</div>
	</div>
</div>