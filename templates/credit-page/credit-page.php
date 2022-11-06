<?php 
/**
 * The template for displaying the credit page.
 *
 * @package dixon_theme
 */
get_header(); 
?>
<main class="main" style="padding-top: var(--header-height); flex: 1;">
	<section class="credit-page">
		<div class="container credit-page__container">
			<h1 class="credit-page__title h2-title"><?php the_title(); ?></h1>
			<div class="credit-page__content">
				<?php the_content(); ?>
			</div>
		</div>
	</section>
</main>
<?php get_footer(); ?>