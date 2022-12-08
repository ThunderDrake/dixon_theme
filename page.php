<?php
the_post();
get_header();
?>
<?php if(is_checkout() || is_account_page()): ?>
	<main class="main" style="padding-top: var(--header-height);">
		<?php the_content(); ?>
	</main>
<?php else: ?>
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
<?php endif; ?>
<?php get_footer(); ?>