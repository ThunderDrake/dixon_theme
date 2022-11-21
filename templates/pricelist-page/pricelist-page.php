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
			<div class="pricelist__works-list work-list">
			</div>
			<div class="pricelist__button-wrapper">
				<a class="pricelist__button btn btn--main btn-reset" href="/contact-us/">Заказать услугу</a>
			</div>
		</div>
	</section>

	<?php ct()->template( '/parts/contacts-section.php' ) ?>

</main>
<?php get_footer(); ?>