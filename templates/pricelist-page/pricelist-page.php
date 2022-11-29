<?php 
/**
 * The template for displaying the pricelist page.
 *
 * @package dixon_theme
 */
get_header();

$models_list = get_terms([
	'taxonomy' => 'model_type',
    'hide_empty' => true,
])
?>
<main class="main" style="padding-top: var(--header-height); flex: 1;">
	<section class="pricelist">
		<div class="container pricelist__container">
			<h1 class="pricelist__title h2-title">Прайс-лист на ремонт телефонов</h1>
			<div class="pricelist__tabs tabs" data-tabs="pricelist">
				<ul class="tabs__nav list-reset">
					<?php foreach($models_list as $term): ?>
						<li class="tabs__nav-item"><button class="tabs__nav-btn btn-reset" type="button"><?= $term->name ?></button></li>
					<?php endforeach; ?>
				</ul>
				<div class="tabs__content">
					<?php foreach($models_list as $term): ?>
						<?php 
						$items_list = get_posts([
							'post_type' => 'models',
							'numberposts' => -1,
							'tax_query' => array(
								array(
									'taxonomy' => 'model_type',
									'field'    => 'slug',
									'terms'    => $term->slug
								)
							)
						])	
							
						?>
					<div class="tabs__panel">
						<div class="header__search-block submenu-search tabs__search">
							<form method="get" data-term="<?= $term->slug ?>">
							<div class="submenu-search__form-wrap">
								<div class="custom-input">
								<label>
									<button class="submenu-search__button btn-reset">
									<svg class="submenu-search__icon" width="20" height="20">
										<use xlink:href="img/sprite.svg#search"></use>
									</svg>
									</button>
									<input type="search" id="submenu-search" name="s" placeholder="Поиск">
								</label>
								</div>
							</div>
							</form>
						</div>
						<div class="pricelist__grid">
							<?php foreach($items_list as $post): ?>
								<?php setup_postdata($post) ?>
								<div class="pricelist__item" data-post-id="<?= get_the_ID() ?>"><?php the_title(); ?></div>
							<?php endforeach; ?>
							<?php wp_reset_postdata() ?>
						</div>
						<button class="pricelist__show-more btn-reset">Показать ещё</button>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
			<?php 
				$models_list = get_posts([
					'post_type' => 'models',
					'numberposts' => -1,
				]);
				foreach($models_list as $post) {
					setup_postdata($post); ?>
					<div class="pricelist__works-list work-list work-list--repair" data-post-items="<?= get_the_ID() ?>">
					<?php $item_works = get_field('pricelist_item') ?>
					<?php if($item_works): ?>
						<?php foreach($item_works as $item): ?>
							<div class="work-list__item">
								<img loading="lazy" src="<?= wp_get_attachment_url($item['icon']) ?>" class="work-list__icon" width="62" height="62" alt="">
								<h3 class="work-list__title"><?= $item['name'] ?></h3>
								<div class="work-list__price"><?= $item['cost'] ?>Р.</div>
							</div>
						<?php endforeach; ?>
					<?php else: ?>
						<div class="work-list__item">
							Ничего не найдено :(
						</div>
					<?php endif; ?>
					</div>
					<?php
				}
				?>
			<div class="pricelist__button-wrapper">
				<a class="pricelist__button btn btn--main btn-reset" href="/contact-us/">Заказать услугу</a>
			</div>
		</div>
	</section>

	<?php ct()->template( '/parts/contacts-section.php' ) ?>

</main>
<?php get_footer(); ?>