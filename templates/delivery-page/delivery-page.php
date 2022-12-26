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
			<h2 class="delivery__title h2-title">Способы оплаты</h2>
			<?php the_content() ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>