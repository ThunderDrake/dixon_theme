<?php 
/**
 * The template for displaying the delivery page.
 *
 * @package dixon_theme
 */
get_header();

$payment_methods  = get_field('payment_methods');
$delivery_methods = get_field('delivery_methods');
?>
<main class="main" style="padding-top: var(--header-height); flex: 1;">
	<section class="delivery">
		<h1 class="visually-hidden"><?php the_title(); ?></h1>
		<div class="container delivery__container">
			<?php if($payment_methods): ?>
				<h2 class="delivery__title h2-title">Способы оплаты</h2>
				<div class="delivery__text">
					Оплатить покупку в сети магазинах Dixon можно несколькими способами:
				</div>
				<?php foreach($payment_methods as $key => $method): ?>
					<div class="delivery__text <?= ($key === array_key_last($payment_methods)) ? 'delivery__text--mb-50' : '' ?>">
						<div class="delivery__small-title"><?= $method['title'] ?></div>
						<?= $method['description'] ?>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
			<?php if($delivery_methods): ?>
				<h2 class="delivery__title h2-title">Способы доставки</h2>
				<div class="delivery__variants">
				<?php foreach($delivery_methods as $method): ?>
					<div class="delivery__variants-item">
						<div class="delivery__variants-content">
							<img loading="lazy" src="<?= wp_get_attachment_url($method['image']) ?>" class="delivery__variants-image" width="110" height="55"
								alt="Логотип Почтый России">
							<div class="delivery__variants-descr"><?= $method['description'] ?></div>
						</div>
						<div class="delivery__variants-footer">
							<div class="delivery__variants-title"><?= $method['title'] ?></div>
							<a class="delivery__variants-link" href="<?= $method['link'] ?>"><?= $method['link'] ?></a>
						</div>
					</div>
				<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>